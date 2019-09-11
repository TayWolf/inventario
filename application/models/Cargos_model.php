<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cargos_model extends CI_Model {

	public function getCargos($estado = false){
		if ($estado != false) {
			$this->db->where("estado",1);
		}
		$resultados = $this->db->get("cargos");
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("cargos",$data);
	}

	public function getCargo($id){
		$this->db->where("id", $id);
		$resultados = $this->db->get("cargos");
		return $resultados->row();
	}

	public function update($id,$data){
		$this->db->where("id", $id);
		return $this->db->update("cargos",$data);
	}

	public function delete($id,$data){
		$this->db->where("id", $id);
		return $this->db->delete("cargos",$data);
	}


}