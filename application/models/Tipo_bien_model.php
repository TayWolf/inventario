<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipo_bien_model extends CI_Model {

	public function getTipoBienes()
	{
		$resultados = $this->db->get("tipo_bienes");
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("tipo_bienes",$data);
	}

	public function getTipoBien($id){
		$this->db->where("id_tipo_bien", $id);
		$resultados = $this->db->get("tipo_bienes");
		return $resultados->row();
	}

	public function update($id,$data){
		$this->db->where("id_tipo_bien", $id);
		return $this->db->update("tipo_bienes",$data);
	}

	public function delete($id){
		$this->db->where("id_tipo_bien", $id);
		return $this->db->delete("tipo_bienes");
	}


}