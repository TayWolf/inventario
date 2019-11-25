<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marcas_model extends CI_Model {

	public function getMarcas(){
		$resultados = $this->db->get("marcas");
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("marcas",$data);
	}

	public function getMarca($id){
		$this->db->where("id_marca", $id);
		$resultados = $this->db->get("marcas");
		return $resultados->row();
	}

	public function update($id,$data){
		$this->db->where("id_marca", $id);
		return $this->db->update("marcas",$data);
	}

	public function delete($id){
		$this->db->where("id_marca", $id);
		return $this->db->delete("marcas");
	}


}