<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LapTops_model extends CI_Model 
{
	public function getLapTops($estado = false)
	{
		$this->db->select("b.*, e.*, a.nombre_area, u.usuario, ips.direccion_ip, per.*, mar.marca, stat.nombre_status, tp.tipo_propiedad");
		$this->db->from("bienes b");
		$this->db->join("personas per","b.id_persona = per.id_persona","Left");
		$this->db->join("elementos e","b.id_elemento = e.id_elemento","Left");
		$this->db->join("tipo_propiedades tp","b.id_tipo_propiedad = tp.id_tipo_propiedad","Left");
		$this->db->join("marcas mar","b.id_marca = mar.id_marca","Left");
		$this->db->join("ips","b.id_ip = ips.id_ip","Left");
		$this->db->join("areas a","per.id_area = a.id_area","Left");
		$this->db->join("usuarios u","b.id_usuario = u.id_usuario","Left");
		$this->db->join("cat_status stat","b.id_status = stat.id_status","Left");

		$this->db->where("b.id_elemento", 7);

		if ($estado != false) {
			$this->db->where("b.id_status",5);
		}
		$this->db->order_by("id_bien asc");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function infoLapTop($id)
	{
		$this->db->select("b.*, e.*, a.nombre_area, u.usuario, ips.direccion_ip, per.*, mar.marca, stat.nombre_status, tp.tipo_propiedad");
		$this->db->from("bienes b");
		$this->db->join("elementos e","b.id_elemento = e.id_elemento","Left");
		$this->db->join("personas per","b.id_persona = per.id_persona","Left");
		$this->db->join("marcas mar","b.id_marca = mar.id_marca","Left");
		$this->db->join("areas a","per.id_area = a.id_area","Left");
		$this->db->join("usuarios u","b.id_usuario = u.id_usuario","Left");
		$this->db->join("cat_status stat","b.id_status = stat.id_status","Left");
		$this->db->join("tipo_propiedades tp","b.id_tipo_propiedad = tp.id_tipo_propiedad","Left");
		$this->db->join("ips","b.id_ip = ips.id_ip","Left");
		$this->db->where("b.id_bien", $id);
		$resultados = $this->db->get();
		return $resultados->row();
	}

	public function getLapTop($id)
	{
		$this->db->where("id_bien", $id);
		$resultados = $this->db->get("bienes");
		return $resultados->row();
	}

	public function save($data)
	{
		return $this->db->insert("bienes",$data);
	}

	public function saveMante($data)
	{
		return $this->db->insert("mantenimientos",$data);
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

	public function getMantenimientos($id_bien)
	{
		$this->db->select("man.*, u.id_persona, per.*, stat.nombre_status");
		$this->db->from("mantenimientos man");
		$this->db->join("usuarios u","man.id_usuario = u.id_usuario","Left");
		$this->db->join("personas per","u.id_persona = per.id_persona","Left");
		$this->db->join("cat_status stat","man.id_status = stat.id_status","Left");
		$this->db->where("id_bien",$id_bien);
		
		$resultados = $this->db->get();
		return $resultados->result();
	}
}