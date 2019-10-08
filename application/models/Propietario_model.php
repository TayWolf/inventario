<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Propietario_model extends CI_Model {

	public function getPropietarios($estado = false){
		if ($estado != false) {
			$this->db->where("estado",1);
		}
		$resultados = $this->db->get("propietarios");
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("propietarios",$data);
	}

	public function getPropietario($id){
		$this->db->where("id_prop", $id);
		$resultados = $this->db->get("propietarios");
		return $resultados->row();
	}

	public function update($id,$data){
		$this->db->where("id_prop", $id);
		return $this->db->update("propietarios",$data);
	}

	public function delete($id){
		$this->db->where("id_prop", $id);
		return $this->db->delete("propietarios");
	}


}