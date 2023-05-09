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
            if ($this->db->delete('piut', array('periode' => $data['periode']))) {
                echo "hapus data berhasil";
            }
        } else {
            // echo "kzsjdfn";
        }


        // STEP 1
        //ambil hasil postingan periode lalu, kemudian ubang jadi periode yang di minta STEP 1

        $query_t_piut = $this->db->query('create temporary table t_piut(
            periode character varying,
            nilai numeric,
            nojnl character varying
            )');

        echo $query_t_piut;
        //jika selesai membuat temporary table, maka di eksekusi query STEP 1
        if ($query_t_piut) {

            $insert_t_piut = $this->db->query("INSERT INTO t_piut (periode, nilai, nojnl) 
            SELECT (CASE WHEN periode = '" . $periode_sebelumnya . "' then '" . $periode . "' end) AS periode, (nilai-bayar) as nilai, nojnl
            from piut
            where periode like '%" . $periode_sebelumnya . "%'
            and (nilai - bayar) > 0");

            // STEP 2
            // ambil data baru dari minv
            $insert_t_piutang_minv = $this->db->query("INSERT INTO t_piut (periode, nilai, nojnl)
            SELECT concat(extract(YEAR FROM tf),extract(MONTH FROM tf)) AS periode, total, nf AS nojnl from minv where extract(YEAR FROM tf) = " . $data['range']['tahun'] . " and extract(MONTH FROM tf) =  " . $data['range']['bulan'] . " ");
        }




        if ($insert_t_piut && $insert_t_piutang_minv) {
            $this->db->select('*');
            $this->db->from('t_piut');
            $result_step_1 = $this->db->get();
            echo "<pre>";
            print_r($result_step_1->result_array());
            echo "</pre>";
        }
    }
}
