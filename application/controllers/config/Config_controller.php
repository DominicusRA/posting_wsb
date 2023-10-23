<?php
defined('BASEPATH') or exit('No direct script access allowed');

class config_controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('database_model', 'database_m');
	}
	public function index()
	{
		$this->load->view('config/database.php');
	}
	public function database()
	{
		$database = $this->input->post('database');
		$data = $this->database_m->get($database);
		$db['hostname'] = 'localhost';
		$db['username'] = 'new_username';
		$db['password'] = 'new_password';
		$db['database'] = $database;
		$db['dbdriver'] = 'postgre';

		$this->load->database($db);
	}
}
