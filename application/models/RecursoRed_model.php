<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecursoRed_model extends CI_Model 
{
	public function getRecursoRedes()
	{
		$this->db->select("ca.*, per.nombres, per.ap_paterno, per.ap_materno, tc.nombre_tipo_acceso, cs.nombre_status");
		$this->db->from("claves_accesos ca");
		$this->db->join("personas per","ca.id_persona = per.id_persona","Left");
		$this->db->join("tipo_claves tc","ca.id_tipo_clave = tc.id_tipo_clave","Left");
		$this->db->join("cat_status cs","ca.id_status = cs.id_status","Left");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function infoRecursoRed($id)
	{
		$this->db->select("ca.*,per.nombres, per.ap_paterno, per.ap_materno, tc.nombre_tipo_acceso, cs.nombre_status");
		$this->db->from("claves_accesos ca");
		$this->db->join("personas per","ca.id_persona = per.id_persona","Left");
		$this->db->join("tipo_claves tc","ca.id_tipo_clave = tc.id_tipo_clave","Left");
		$this->db->join("cat_status cs","ca.id_status = cs.id_status","Left");
		$this->db->where("ca.id_clave_acceso", $id);
		$resultados = $this->db->get();
		return $resultados->row();
	}

	public function getRecursoRed($id)
	{
		$this->db->select("ca.*, per.nombres, per.ap_paterno, per.ap_materno, tc.nombre_tipo_acceso, cs.nombre_status");
		$this->db->from("claves_accesos ca");
		$this->db->join("personas per","ca.id_persona = per.id_persona","Left");
		$this->db->join("tipo_claves tc","ca.id_tipo_clave = tc.id_tipo_clave","Left");
		$this->db->join("cat_status cs","ca.id_status = cs.id_status","Left");
		$this->db->where("id_clave_acceso", $id);
		$resultados = $this->db->get();
		return $resultados->row();
	}

	public function save($data)
	{
		return $this->db->insert("claves_accesos",$data);
	}

	public function update($id,$data)
	{
		$this->db->where("id_clave_acceso", $id);
		return $this->db->update("claves_accesos",$data);
	}

	public function delete($id)
	{
		$this->db->where("id_clave_acceso", $id);
		return $this->db->delete("claves_accesos");
	}
}