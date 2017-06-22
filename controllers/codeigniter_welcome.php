<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Codeigniter_welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('codeigniter_welcome');
	}
}
