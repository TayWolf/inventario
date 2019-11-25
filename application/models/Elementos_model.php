<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Elementos_model extends CI_Model {

	public function getElementos()
	{
		$this->db->select("e.*, tb.nombre_bien");
		$this->db->from("elementos e");
		$this->db->join("tipo_bienes tb","e.id_tipo_bien = tb.id_tipo_bien","Left");
		$this->db->order_by("id_tipo_bien", "ASC");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("elementos",$data);
	}

	public function getElemento($id)
	{
		$this->db->select("e.*, tb.nombre_bien");
		$this->db->from("elementos e");
		$this->db->join("tipo_bienes tb","e.id_tipo_bien = tb.id_tipo_bien","Left");
		$this->db->where("id_elemento", $id);
		$resultados = $this->db->get();
		return $resultados->row();
	}

	public function update($id,$data){
		$this->db->where("id_elemento", $id);
		return $this->db->update("elementos",$data);
	}

	public function delete($id){
		$this->db->where("id_elemento", $id);
		return $this->db->delete("elementos");
	}


}