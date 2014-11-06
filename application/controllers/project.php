<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('lifestream');
	}


	public function index()
	{
		$data['projects'] = $this->lifestream->getProjects();
		$this->load->view('lifestream/project',$data);
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
		$this->lifestream->addStream();

		// redirect
		redirect('project','refresh');
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
		$this->lifestream->editProject();

		// redirect
		redirect('project','refresh');
	}

	function delete()
	{
		//remove pictures from directory
		$filename 	= $this->input->post('p_picture');
		$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
		$path 		= './uploads/image/'.$withoutExt;


		foreach (glob($path."*.*") as $filename) {
		    unlink($filename);
		}

		//remove from db
		$this->lifestream->deleteProject();
		redirect('project','refresh');
	}

	function delete_picture()
	{
		//remove pictures from directory
		$filename 	= $this->input->post('p_picture');
		$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
		$path 		= './uploads/image/'.$withoutExt;


		foreach (glob($path."*.*") as $filename) {
		    unlink($filename);
		}

		//remove from db
		$this->lifestream->deleteProjectPicture();
		redirect('project','refresh');
	}
}