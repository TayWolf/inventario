<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipo_propiedad_model extends CI_Model {

	public function getTipo_propiedades(){
		$this->db->select("tp.*");
		$this->db->from("tipo_propiedades tp");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("tipo_propiedades",$data);
	}

	public function getTipo_propiedad($id_tipo_propiedad){
		$this->db->where("id_tipo_propiedad", $id_tipo_propiedad);
		$resultados = $this->db->get("tipo_propiedades");
		return $resultados->row();
	}

	public function update($id_tipo_propiedad, $data){
		$this->db->where("id_tipo_propiedad", $id_tipo_propiedad);
		return $this->db->update("tipo_propiedades",$data);
	}


}