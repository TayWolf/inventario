<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personas_model extends CI_Model {

	public function getPersonas($estado = false){
		$this->db->select("per.*, a.nombre_area, car.cargo, stat.nombre_status");
		$this->db->from("personas per");
		$this->db->join("areas a","per.id_area = a.id_area","Left");
		$this->db->join("cat_status stat","per.id_status = stat.id_status","Left");
		$this->db->join("cargos car","per.id_cargo = car.id_cargo","Left");
		$this->db->order_by("per.nombres ASC");

		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("personas",$data);
	}

	public function getPersona($id_persona){
		$this->db->select("per.*, a.nombre_area, car.cargo, stat.nombre_status");
		$this->db->from("personas per");
		$this->db->join("areas a","per.id_area = a.id_area","Left");
		$this->db->join("cat_status stat","per.id_status = stat.id_status","Left");
		$this->db->join("cargos car","per.id_cargo = car.id_cargo","Left");
		$this->db->where("id_persona", $id_persona);
		$resultados = $this->db->get();
		return $resultados->row();
	}

	public function update($id_persona, $data){
		$this->db->where("id_persona", $id_persona);
		return $this->db->update("personas",$data);
	}

	public function delete($id_persona){
		$this->db->where("id_personas", $id_persona);
		return $this->db->delete("personas");
	}


}