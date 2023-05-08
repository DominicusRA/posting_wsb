<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Posting_controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('posting_model', 'posting_m');
	}
	public function piutang()
	{
		$data['range'] = array(
			'bulan' => $this->input->post('bulan'),
			'tahun' => $this->input->post('tahun')
		);

		$result = $this->posting_m->posting($data);
	}
}
