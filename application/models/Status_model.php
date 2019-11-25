<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_model extends CI_Model {

	public function getStatus(){
		$resultados = $this->db->get("cat_status");
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("cat_status",$data);
	}

	public function getProveedor($id_status){
		$this->db->where("id_status", $id_status);
		$resultados = $this->db->get("cat_status");
		return $resultados->row();
	}

	public function update($id_status, $data){
		$this->db->where("id_status", $id_status);
		return $this->db->update("cat_status",$data);
	}


}