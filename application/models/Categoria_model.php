<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria_model extends CI_Model {

	public function getCategorias($estado = false){
		if ($estado != false) {
			$this->db->where("estado",1);
		}
		$resultados = $this->db->get("categoria");
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("categoria",$data);
	}

	public function getCategoria($id){
		$this->db->where("id", $id);
		$resultados = $this->db->get("categoria");
		return $resultados->row();
	}

	public function update($id,$data){
		$this->db->where("id", $id);
		return $this->db->update("categoria",$data);
	}


}