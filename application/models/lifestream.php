<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lifestream extends CI_Model
{
	function addStream()
	{
		$uid 	= $this->ion_auth->users()->row()->id;
		$stream = $this->input->post('ls_lifestream');
		$cats 	= $this->input->post('ls_category');

		$img 	= $this->upload->data();
		$picture= $img['file_name'];
		$date 	= date('Y-m-d');

		$data = array(
			'fk_users_id' 	=> $uid,
			's_lifestream' 	=> $stream,
			'e_category' 	=> $cats,
			's_picture'		=> $picture,
			't_post'		=> $date
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
}