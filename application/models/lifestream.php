<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lifestream extends CI_Model
{
	// project functions
	function addProject()
	{
		$uid 	= $this->ion_auth->users()->row()->id;
		$title 	= $this->input->post('p_title');
		$desc 	= $this->input->post('p_description');
		$client = $this->input->post('p_client');
		$cats 	= $this->input->post('p_category');
		$status = $this->input->post('p_status');
		$t_start= $this->input->post('p_time_start');
		$t_end 	= $this->input->post('p_time_end');

		$img 	= $this->upload->data();
		$picture= $img['file_name'];

		$data = array(
			'fk_users_id' 	=> $uid,
			's_title' 		=> $title,
			's_description' => $desc,
			's_picture' 	=> $picture,
			's_client'		=> $client,
			'e_category'	=> $cats,
			'e_status'		=> $status,
			'b_start_date' 	=> $t_start,
			'b_end_date'	=> $t_end
			);

		$this->db->insert('project',$data);
	}

	function getProjects()
	{
		$this->db->select('*')
				 ->from('project')
				 ->join('users','users.id = project.fk_users_id')
				 ->where('b_status','1');

		$query = $this->db->get();

		if($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return array();
		}
	}

	function editProject()
	{
		$uid 	= $this->ion_auth->users()->row()->id;
		$pid 	= $this->input->post('p_id');
		$title 	= $this->input->post('p_title');
		$desc 	= $this->input->post('p_description');
		$client = $this->input->post('p_client');
		$cats 	= $this->input->post('p_category');
		$status = $this->input->post('p_status');
		$t_start= $this->input->post('p_time_start');
		$t_end 	= $this->input->post('p_time_end');

		$img 	= $this->upload->data();
		$picture= $img['file_name'];

		$data = array(
			'fk_users_id' 	=> $uid,
			's_title' 		=> $title,
			's_description' => $desc,
			's_picture' 	=> $picture,
			's_client'		=> $client,
			'e_category'	=> $cats,
			'e_status'		=> $status,
			'b_start_date' 	=> $t_start,
			'b_end_date'	=> $t_end
			);

		$this->db->where('fk_users_id',$uid)
				 ->where('pk_project_id',$pid)
				 ->update('project',$data);
	}

	function deleteProject()
	{
		$uid 	= $this->ion_auth->users()->row()->id;
		$pid 	= $this->input->post('p_id');

		$this->db->where('fk_users_id',$uid)
				 ->where('pk_project_id',$pid)
				 ->delete('project');
	}

	function deleteProjectPicture()
	{
		$uid 	= $this->ion_auth->users()->row()->id;
		$pid 	= $this->uri->segment(3);

		$data	= array(
			's_picture' => ''
			);

		$this->db->where('fk_users_id',$uid)
				 ->where('pk_project_id',$pid)
				 ->update('project',$data);
	}

	// stream functions
	function addStream()
	{
		$uid 	= $this->ion_auth->users()->row()->id;
		$stream = $this->input->post('ls_lifestream');
		$cats 	= $this->input->post('ls_category');
		$title 	= $this->input->post('ls_title');

		$img 	= $this->upload->data();
		$picture= $img['file_name'];

		$data = array(
			'fk_users_id' 	=> $uid,
			's_lifestream' 	=> $stream,
			'e_category' 	=> $cats,
			's_picture'		=> $picture,
			's_title'		=> $title
			);

		$this->db->insert('lifestream',$data);
	}

	function getStreams()
	{
		$this->db->select('*')
				 ->from('lifestream')
				 ->join('users','users.id = lifestream.fk_users_id')
				 ->where('b_status','1');

		$query = $this->db->get();

		if($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return array();
		}
	}

	function editStream()
	{
		$uid 	= $this->ion_auth->users()->row()->id;
		$sid 	= $this->input->post('sid');
		$stream = $this->input->post('ls_lifestream');
		$cats 	= $this->input->post('ls_category');
		$title 	= $this->input->post('ls_title');

		$img 	= $this->upload->data();
		$picture= $img['file_name'];

		$data = array(
			's_lifestream' 	=> $stream,
			'e_category' 	=> $cats,
			's_picture'		=> $picture,
			's_title'		=> $title
			);

		$this->db->where('fk_users_id',$uid)
				 ->where('pk_stream_id',$sid)
				 ->update('lifestream',$data);
	}

	function deleteStream()
	{
		$uid 	= $this->ion_auth->users()->row()->id;
		$sid 	= $this->input->post('sid');

		$this->db->where('fk_users_id',$uid)
				 ->where('pk_stream_id',$sid)
				 ->delete('lifestream');
	}

	function deletePicture()
	{
		$uid 	= $this->ion_auth->users()->row()->id;
		$sid 	= $this->uri->segment(3);

		$data	= array(
			's_picture' => ''
			);

		$this->db->where('fk_users_id',$uid)
				 ->where('pk_stream_id',$sid)
				 ->update('lifestream',$data);
	}
}