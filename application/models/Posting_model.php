<?php
class Posting_model extends CI_MODEL
{
    function posting($data)
    {
        // print_r($data);
        if ($data['range']['bulan'] - 1 == 0) {
            $periode_sebelumnya = $data['range']['tahun'] - 1 . 12;
        } else {
            $periode_sebelumnya = $data['range']['tahun'] . str_pad($data['range']['bulan'] - 1, 2, 0, STR_PAD_LEFT);
        }
        $periode = $data['periode'];

        echo $periode_sebelumnya;
        // cek apakah sudah ada yang di posting
        // jika ada data yang bersangkutan dengan periode posting di hapus
        $this->db->select();
        $this->db->from('piut');
        $this->db->where('periode', $data['periode']);
        $count_periode = $this->db->count_all_results();
        // print_r($count_periode);

        if ($count_periode > 0) {
            echo "ini berjalan";
            // if ($this->db->delete('piut', array('periode' => $data['periode']))) {
            //     echo "hapus data berhasil";
            // }
        } else {
            // echo "kzsjdfn";
        }


        // STEP 1
        //ambil hasil postingan periode lalu, kemudian ubang jadi periode yang di minta STEP 1

        $query_t_piut = $this->db->query('create temporary table t_piut(
            periode character varying,
            nilai numeric,
            nojnl character varying,
            ket character varying
            )');

        //jika selesai membuat temporary table, maka di eksekusi query STEP 1
        if ($query_t_piut) {

            $insert_t_piut = $this->db->query("INSERT INTO t_piut (periode, ket, nilai, nojnl) 
            SELECT (CASE WHEN periode = '" . $periode_sebelumnya . "' then '" . $periode . "' end) AS periode, (CASE WHEN periode = '" . $periode_sebelumnya . "' then 'piut' end) AS ket, (nilai-bayar) as nilai, nojnl
            from piut
            where periode like '%" . $periode_sebelumnya . "%'
            and (nilai - bayar) != 0
            group by nojnl, periode, nilai, bayar");

            // STEP 2
            // ambil data baru dari minv
            $insert_t_piutang_minv = $this->db->query("INSERT INTO t_piut (ket, periode, nilai, nojnl)
            SELECT (CASE WHEN extract(YEAR FROM tf) = '2022' then 'minv' end) AS ket, concat(extract(YEAR FROM tf),extract(MONTH FROM tf)) AS periode, total, nf AS nojnl from minv where extract(YEAR FROM tf) = " . $data['range']['tahun'] . " and extract(MONTH FROM tf) =  " . $data['range']['bulan'] . " ");
            // STEP 3
            //ambil dp di tkpiut
            $insert_t_piutang_tkpiut = $this->db->query("INSERT INTO t_piut (ket, periode, nilai, nojnl)
            SELECT (CASE WHEN extract(YEAR FROM tgl) = '2022' then 'tkpiut' end) AS ket, concat(extract(YEAR FROM tgl),extract(MONTH FROM tgl)) AS periode, qty AS nilai, nojnl FROM tkpiut WHERE  extract(YEAR FROM tgl) = " . $data['range']['tahun'] . " and extract(MONTH FROM tgl) =  " . $data['range']['bulan'] . "");
            // STEP 4
            // ambil returan di mrj
            $insert_t_piutang_mrj = $this->db->query("INSERT INTO t_piut (ket, periode, nilai, nojnl)
            SELECT (CASE WHEN extract(YEAR FROM tf) = '2022' then 'mrj' end) as ket, concat(extract(YEAR FROM tf),extract(MONTH FROM tf)) AS periode, total AS nilai, nf AS nojnl from mrj where extract(YEAR FROM tf) = " . $data['range']['tahun'] . " and extract(MONTH FROM tf) =  " . $data['range']['bulan'] . " group by ket, periode, nilai, nojnl");
            // STEP 5
            //ambil pembayaran di dpiutang
            // $insert_t_piutang_dpiutang = $this->db->query();
        }




        if ($insert_t_piut && $insert_t_piutang_minv && $insert_t_piutang_tkpiut && $insert_t_piutang_mrj) {
            $this->db->select('*');
            $this->db->from('t_piut');
            $this->db->order_by('nojnl', 'ASC');
            // $this->db->group_by('nojnl, nilai, periode');
            $result_step_1 = $this->db->get();
            echo "<pre>";
            print_r($result_step_1->result_array());
            echo "</pre>";
        }
        echo "BATASAN TEST <br>";
        echo "BATASAN TEST <br>";
        echo "BATASAN TEST <br>";
        $this->db->select('*');
        $this->db->from('piut');
        $this->db->join('t_piut', 't_piut.nojnl = piut.nojnl', 'left');
        $this->db->where('piut.periode', $periode);
        $this->db->order_by('t_piut.ket', 'ASC');
        $result_test = $this->db->get();
        echo "<pre>";
        print_r($result_test->result_array());
        echo "</pre>";
    }
}
