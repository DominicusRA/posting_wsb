<?php
class Posting_model extends CI_MODEL
{
    function posting($data)
    {
        // while(){

        // }
        if ($data['range']['bulan'] - 1 == 0) {
            $periode_sebelumnya = $data['range']['tahun'] - 1 . 12;
        } else {
            $periode_sebelumnya = $data['range']['tahun'] . str_pad($data['range']['bulan'] - 1, 2, 0, STR_PAD_LEFT);
        }
        $periode = $data['periode'];
        // cek apakah sudah ada yang di posting
        // jika ada data yang bersangkutan dengan periode posting di hapus
        $this->db->select();
        $this->db->from('piut');
        $this->db->where('periode', $data['periode']);
        $count_periode = $this->db->count_all_results();
        // print_r($count_periode);

        if ($count_periode > 0) {

            if ($this->db->delete('piut', array('periode' => $data['periode']))) {
            }
        } else {
        }


        // STEP 1
        //ambil hasil postingan periode lalu, kemudian ubang jadi periode yang di minta STEP 1

        $query_t_piut = $this->db->query('create temporary table t_piut(
            periode character varying,
            nilai numeric,
            nojnl character varying,
            ket character varying,
            kode character varying,
            tgl date,
            kodesls character varying,
            acc character varying,
            tjt date,
            type character varying, 
            fgroup character varying
            )');
        $query_t_dpiutang = $this->db->query('create temporary table t_dpiutang(
            refno character varying,
            bayar numeric
            )');

        //jika selesai membuat temporary table, maka di eksekusi query STEP 1
        if ($query_t_piut) {

            $insert_t_piut = $this->db->query("INSERT INTO t_piut (acc, kode, tgl, tjt,type,kodesls,periode, nilai, nojnl) 
            SELECT acc, kode, tgl, tjt,type,kodesls,(CASE WHEN periode = '" . $periode_sebelumnya . "' then '" . $periode . "' end) AS periode, (nilai-bayar) as nilai, nojnl
            from piut
            where periode like '%" . $periode_sebelumnya . "%'
            and (nilai - bayar) != 0
            group by acc,kode,tgl,tjt,type,kodesls,nojnl, periode, nilai, bayar");

            // STEP 2
            // ambil data baru dari minv
            $insert_t_piutang_minv = $this->db->query("INSERT INTO t_piut (acc, type, periode, nilai, nojnl, kode, tgl, tjt, kodesls )
            SELECT (CASE WHEN 0 = 0 then '114.100' end) AS acc, (CASE WHEN 0 = 0 then 'FAKTUR' end) AS type, concat(extract(YEAR FROM tf),to_char(tf,'MM')) AS periode, total as nilai , nf AS nojnl , kode, tf as tgl, tjt, slskode from minv where extract(YEAR FROM tf) = " . $data['range']['tahun'] . " and extract(MONTH FROM tf) =  " . $data['range']['bulan'] . "");
            // STEP 3
            //ambil dp di tkpiut
            $insert_t_piutang_tkpiut = $this->db->query("INSERT INTO t_piut (acc, type, periode, nilai, nojnl, kode, tgl, tjt )
            SELECT (CASE WHEN 0 = 0 then '215.210' end) AS acc, (CASE WHEN 0 = 0 then 'KOREKSI' end) AS type,concat(extract(YEAR FROM tgl),to_char(tgl,'MM')) AS periode, qty AS nilai, nojnl , kode, tgl, tgl as tjt FROM tkpiut WHERE  extract(YEAR FROM tgl) = " . $data['range']['tahun'] . " and extract(MONTH FROM tgl) =  " . $data['range']['bulan'] . "");
            // STEP 4
            // ambil returan di mrj
            $insert_t_piutang_mrj = $this->db->query("INSERT INTO t_piut (acc, type,periode, nilai, nojnl, kode, tgl, tjt)
            SELECT (CASE WHEN 0 = 0 then '114.100' end) AS acc, (CASE WHEN 0 = 0 then 'RETUR' end) AS type, concat(extract(YEAR FROM tf),to_char(tf,'MM')) AS periode, total AS nilai, nf AS nojnl, kode, tf as tgl , tjt from mrj where extract(YEAR FROM tf) = " . $data['range']['tahun'] . " and extract(MONTH FROM tf) =  " . $data['range']['bulan'] . "");
            // STEP 5
            //ambil pembayaran di dpiutang masukan ke twmporary table t_dpiutang

            $insert_t_dpiutang_dpiutang = $this->db->query("INSERT INTO t_dpiutang (refno, bayar)
            SELECT refno, sum(bayar) AS bayar FROM dpiutang WHERE extract(YEAR FROM tf) = " . $data['range']['tahun'] . " AND extract(MONTH FROM tf) =  " . $data['range']['bulan'] . " GROUP BY refno ");
        }




        // if ($insert_t_piut && $insert_t_piutang_minv && $insert_t_piutang_tkpiut && $insert_t_piutang_mrj) {
        //     $this->db->select('*');
        //     $this->db->from('t_piut');
        //     $this->db->order_by('nojnl', 'ASC');
        //     // $this->db->group_by('nojnl, nilai, periode');
        //     $result_step_1 = $this->db->get();
        //     echo "<pre>";
        //     print_r($result_step_1->result_array());
        //     echo "</pre>";
        // }
        // echo "BATASAN TEST <br>";
        // echo "BATASAN TEST <br>";
        // echo "BATASAN TEST <br>";
        // $this->db->select('*');
        // $this->db->from('piut');
        // $this->db->join('t_piut', 't_piut.nojnl = piut.nojnl', 'left');
        // $this->db->where('piut.periode', $periode);
        // $this->db->order_by('t_piut.ket', 'ASC');
        // $result_test = $this->db->get();
        // echo "<pre>";
        // print_r($result_test->result_array());
        // echo "</pre>";

        // echo "BATASAN TEST PIUTANG <br>";
        // echo "BATASAN TEST PIUTANG <br>";
        // echo "BATASAN TEST PIUTANG <br>";
        // $this->db->select('dpiutang.nf, dpiutang.refno, dpiutang.bayar, t_piut.periode, t_piut.nilai, t_piut.nojnl, t_piut.ket');
        // $this->db->from('dpiutang');
        // $this->db->join('t_piut', 't_piut.nojnl = dpiutang.refno', 'right');
        // $this->db->group_by('dpiutang.nf, dpiutang.refno, dpiutang.bayar, t_piut.periode, t_piut.nilai, t_piut.nojnl, t_piut.ket');
        // $this->db->order_by('dpiutang.nf', 'asd');
        // // $this->db->order_by('dpiutang.bayar', 'asd');
        // $result_test_1 = $this->db->get();

        // echo "<pre>";
        // print_r($result_test_1->result_array());
        // echo "</pre>";


        // $this->db->select('*');
        // $this->db->from('t_dpiutang');
        // $result_t_dpiutang = $this->db->get();
        // echo "<pre>";
        // print_r($result_t_dpiutang->result_array());
        // echo "</pre>";

        // echo "INI BATASAN UNTUK TEST";



        $this->db->select('nojnl, acc, kode, tgl, tjt, type, nilai, (CASE WHEN bayar is NULL THEN 0 ELSE bayar END) AS bayar, ket, fgroup, kodesls, periode');
        $this->db->from('t_dpiutang');
        $this->db->join('t_piut', 't_piut.nojnl = t_dpiutang.refno', 'right');
        $result_t_dpiutang = $this->db->get();
        // echo "<pre>";
        // print_r($result_t_dpiutang->result_array());
        // echo "</pre>";

        $insert_piut = $this->db->query("INSERT INTO piut (nojnl, acc, kode, tgl, tjt, type, nilai, bayar, ket, fgroup, kodesls, periode)
            SELECT nojnl, acc, kode, tgl, tjt, type, nilai, (CASE WHEN bayar is NULL THEN 0 ELSE bayar END) AS bayar, ket, fgroup, kodesls, periode 
            from t_dpiutang
            RIGHT JOIN t_piut on t_piut.nojnl = t_dpiutang.refno");

        return true;
    }
}
