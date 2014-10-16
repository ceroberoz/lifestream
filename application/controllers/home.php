<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('lifestream');
	}


	public function index()
	{
		$data['streams'] = $this->lifestream->getStreams();
		$this->load->view('minime/home',$data);
	}

	function login()
	{
		$this->load->view('minime/login');
	}

	function post_stream()
	{
		// do upload image
		$config = array(
			'upload_path' 	=> './uploads/image/',
			'allowed_types' => 'jpg|png',
			'encrypt_name'	=> TRUE,
			'max_size'		=> 2048
			);

		$this->load->library('upload');
		$this->upload->initialize($config);
		$this->upload->do_upload();

		// add text to db
		$this->load->model('lifestream');
		$this->lifestream->addStream();

		// redirect
		redirect('/','refresh');
	}
}