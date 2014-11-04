<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('lifestream');
	}


	public function index()
	{
		//$data['streams'] = $this->lifestream->getStreams();
		//$this->load->view('lifestream/home',$data);
		$this->load->view('lifestream/project');
	}

	function login()
	{
		$this->load->view('lifestream/login');
	}

	function post()
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

	function edit()
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
		$this->lifestream->editStream();

		// redirect
		redirect('/','refresh');
	}

	function delete()
	{
		//remove pictures from directory
		$filename 	= $this->input->post('ls_picture');
		$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
		$path 		= './uploads/image/'.$withoutExt;


		foreach (glob($path."*.*") as $filename) {
		    unlink($filename);
		}

		//remove from db
		$this->lifestream->deleteStream();
		redirect('/','refresh');
	}

	function delete_picture()
	{
		//remove pictures from directory
		$filename 	= $this->input->post('ls_picture');
		$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
		$path 		= './uploads/image/'.$withoutExt;


		foreach (glob($path."*.*") as $filename) {
		    unlink($filename);
		}

		//remove from db
		$this->lifestream->deletePicture();
		redirect('/','refresh');
	}
}