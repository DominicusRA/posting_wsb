<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Posting_controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('posting_model', 'posting_m');
	}
	public function index()
	{
		$this->load->view('proses/posting/index.php');
	}
	public function piutang()
	{
		$data['i_periode'] = $this->input->post('periode');
		$data['jenis'] = $this->input->post('jenis');
		$data['range'] = array(
			'bulan' => $this->input->post('bulan'),
			'tahun' => $this->input->post('tahun')
		);
		$data['periode'] = $this->input->post('tahun') . str_pad($this->input->post('bulan'), 2, 0, STR_PAD_LEFT);

		$result = $this->posting_m->posting($data);
		// return $result;
		// echo json_encode($data);

		$response = array(
			'status' => 'success',
			'message' => 'Data berhasil diambil',
			'data' => $result
		);
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($response));
		// echo json_encode($response);
	}
}
