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

		if ($this->input->post('periode') != "") {
			$data['i_periode'] = $this->input->post('periode');
			$periode = $this->input->post('periode');
			$data['ex_per'] = explode("-", $periode);
			$data['range'] = array(
				'tahun' => $data['ex_per'][0],
				'bulan' => $data['ex_per'][1],
			);
		} else {
			$data['range'] = array(
				'tahun' => $this->input->post('tahun'),
				'bulan' => $this->input->post('bulan'),
			);
		}
		$data['jenis'] = $this->input->post('jenis');

		// $data['periode'] = $this->input->post('tahun') . str_pad($this->input->post('bulan'), 2, 0, STR_PAD_LEFT);
		$data['periode'] = $data['range']['tahun'] . str_pad($data['range']['bulan'], 2, 0, STR_PAD_LEFT);

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
