<?php
class Posting_model extends CI_MODEL
{
    function posting($data)
    {
        print_r($data);
        if ($this->db->query('CREATE TEMPORARY TABLE t_dpiutang (refno character varying (15), bayar numeric, tf date, bulan numeric, tahun numeric)')) {
            return true;
        } else {
            return false;
        }
    }
}
