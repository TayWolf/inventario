<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecursoRed_model extends CI_Model {

	public function getRecursoRedes($estado = false){
		if ($estado != false) {
			$this->db->where("estado",1);
		}
		$resultados = $this->db->get("recursored");
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("recursored",$data);
	}

	public function getRecursoRed($id){
		$this->db->where("id", $id);
		$resultados = $this->db->get("recursored");
		return $resultados->row();
	}

	public function update($id,$data){
		$this->db->where("id", $id);
		return $this->db->update("recursored",$data);
	}


}