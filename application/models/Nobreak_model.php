<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nobreak_model extends CI_Model {

	public function getNobreaks($estado = false,$search,$fechainicio = false, $fechafinal =false){
		$this->db->select("nb.*,u.nombres, a.nombre as area");
		$this->db->from("nobreak nb");
		$this->db->join("usuarios u","nb.usuario_id = u.id","Left");
		$this->db->join("areas a","nb.id_area = a.id","Left");
		if ($fechainicio !== false && $fechafinal !== false) {
			$this->db->where("nb.fecregistro >=", $fechainicio." "."00:00:00");
			$this->db->where("nb.fecregistro <=", $fechafinal." "."23:59:59");

		}
		if ($estado != false) {
			$this->db->where("nb.estado",1);
		}
		$this->db->like("CONCAT(nb.no_serie, '',nb.modelo,'',u.nombres)",$search);
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function infoNobreak($id){
		$this->db->select("nb.*, a.nombre as area");
		$this->db->from("nobreak nb");
		$this->db->join("areas a","nb.id_area = a.id","Left");
		$this->db->where("nb.id", $id);
		$resultados = $this->db->get();
		return $resultados->row();
	}

	public function save($data){
		return $this->db->insert("nobreak",$data);
	}

	public function getNobreak($id){
		$this->db->where("id", $id);
		$resultados = $this->db->get("nobreak");
		return $resultados->row();
	}

	public function update($id,$data){
		$this->db->where("id", $id);
		return $this->db->update("nobreak",$data);
	}

	public function delete($id){
		$this->db->where("id", $id);
		return $this->db->delete("nobreak");
	}

	// public function saveMante($data){
	// 	return $this->db->insert("lectores_mantenimientos",$data);
	// }

	// public function getMantenimientos($id){
		
	// 	$this->db->where("lector_id",$id);
		
	// 	$resultados = $this->db->get("lectores_mantenimientos");
	// 	return $resultados->result();
	// }


}