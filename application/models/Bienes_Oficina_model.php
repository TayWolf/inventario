<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bienes_Oficina_model extends CI_Model {

	public function getNobreaks($estado = false,$search,$fechainicio = false, $fechafinal =false)
	{
		$this->db->select("b.*, e.elemento, tb.nombre_bien, cs.nombre_status, u.usuario, per.nombres, per.ap_paterno, per.ap_materno");
		$this->db->from("bienes b");
		$this->db->join("elementos e","b.id_elemento = e.id_elemento","Left");
		$this->db->join("tipo_bienes tb","e.id_tipo_bien = tb.id_tipo_bien","Left");
		$this->db->join("cat_status cs","b.id_status = cs.id_status","Left");
		$this->db->join("personas per","b.id_persona = per.id_persona","Left");
		$this->db->join("usuarios u","b.id_usuario = u.id_usuario","Left");

		if ($fechainicio !== false && $fechafinal !== false) {
			$this->db->where("b.fecregistro >=", $fechainicio." "."00:00:00");
			$this->db->where("b.fecregistro <=", $fechafinal." "."23:59:59");
		}

		$this->db->where("tb.id_tipo_bien",2);
		
		if ($estado != false) 
		{
			$this->db->where("nb.estado",1);
		}
		
		$this->db->like("CONCAT(b.no_serie, '',b.modelo, '',b.id_elemento)",$search);
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function infoNobreak($id)
	{
		$this->db->select("b.*, e.elemento, tb.nombre_bien, cs.nombre_status, u.usuario, per.nombres, per.ap_paterno, per.ap_materno");
		$this->db->from("bienes b");
		$this->db->join("elementos e","b.id_elemento = e.id_elemento","Left");
		$this->db->join("tipo_bienes tb","e.id_tipo_bien = tb.id_tipo_bien","Left");
		$this->db->join("cat_status cs","b.id_status = cs.id_status","Left");
		$this->db->join("personas per","b.id_persona = per.id_persona","Left");
		$this->db->join("usuarios u","b.id_usuario = u.id_usuario","Left");
		$this->db->where("b.id_bien", $id);
		$resultados = $this->db->get();
		return $resultados->row();
	}

	public function getNobreak($id)
	{
		$this->db->select("b.*, e.elemento, tb.nombre_bien, cs.nombre_status, u.usuario, per.nombres, per.ap_paterno, per.ap_materno");
		$this->db->from("bienes b");
		$this->db->join("elementos e","b.id_elemento = e.id_elemento","Left");
		$this->db->join("tipo_bienes tb","e.id_tipo_bien = tb.id_tipo_bien","Left");
		$this->db->join("cat_status cs","b.id_status = cs.id_status","Left");
		$this->db->join("personas per","b.id_persona = per.id_persona","Left");
		$this->db->join("usuarios u","b.id_usuario = u.id_usuario","Left");
		$this->db->where("b.id_bien", $id);
		$resultados = $this->db->get();
		return $resultados->row();
	}

	public function save($data)
	{
		return $this->db->insert("bienes",$data);
	}

	public function update($id,$data)
	{
		$this->db->where("id_bien", $id);
		return $this->db->update("bienes",$data);
	}

	public function delete($id)
	{
		$this->db->where("id_bien", $id);
		return $this->db->delete("bienes");
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