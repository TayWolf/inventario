<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Impresoras_model extends CI_Model {

	public function getImpresoras($estado = false,$search,$fechainicio = false, $fechafinal =false){
		$this->db->select("b.*, e.elemento, a.nombre_area as area, u.usuario, per.*, tp.tipo_propiedad, status.nombre_status, m.marca, ip.direccion_ip");
		$this->db->from("bienes b");
		$this->db->join("elementos e","b.id_elemento = e.id_elemento", "Left");
		$this->db->join("personas per","b.id_persona = per.id_persona", "Left");
		$this->db->join("areas a","per.id_area = a.id_area", "Left");
		$this->db->join("ips ip","b.id_ip = ip.id_ip", "Left");
		$this->db->join("tipo_propiedades tp","b.id_tipo_propiedad = tp.id_tipo_propiedad", "Left");
		$this->db->join("cat_status status","b.id_status = status.id_status", "Left");
		$this->db->join("marcas m","b.id_marca = m.id_marca", "Left");
		$this->db->join("usuarios u","b.id_usuario = u.id_usuario", "Left");

		if ($fechainicio !== false && $fechafinal !== false) {
			$this->db->where("i.fecregistro >=", $fechainicio." "."00:00:00");
			$this->db->where("i.fecregistro <=", $fechafinal." "."23:59:59");

		}
		
		$this->db->where("b.id_elemento",6);

		$this->db->like("CONCAT(b.no_serie, '', e.elemento, '', a.nombre_area,'', per.nombres, '', u.usuario)",$search);
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function infoImpresora($id){
		$this->db->select("b.*, e.elemento, a.nombre_area as area, u.usuario, per.*, tp.tipo_propiedad, status.nombre_status, m.marca, ip.direccion_ip");
		$this->db->from("bienes b");
		$this->db->join("elementos e","b.id_elemento = e.id_elemento", "Left");
		$this->db->join("personas per","b.id_persona = per.id_persona", "Left");
		$this->db->join("areas a","per.id_area = a.id_area", "Left");
		$this->db->join("ips ip","b.id_ip = ip.id_ip", "Left");
		
		$this->db->join("tipo_propiedades tp","b.id_tipo_propiedad = tp.id_tipo_propiedad", "Left");
		$this->db->join("cat_status status","b.id_status = status.id_status", "Left");
		$this->db->join("marcas m","b.id_marca = m.id_marca", "Left");
		$this->db->join("usuarios u","b.id_usuario = u.id_usuario", "Left");
		$this->db->where("b.id_bien", $id);
		$resultados = $this->db->get();
		return $resultados->row();
	}

	public function save($data){
		return $this->db->insert("bienes",$data);
	}

	public function getImpresora($id){
		$this->db->where("id_bien", $id);
		$resultados = $this->db->get("bienes");
		return $resultados->row();
	}

	public function update($id,$data){
		$this->db->where("id_bien", $id);
		return $this->db->update("bienes",$data);
	}

	public function delete($id){
		$this->db->where("id_bien", $id);
		return $this->db->delete("bienes");
	}

	public function saveMante($data){
		return $this->db->insert("mantenimientos",$data);
	}

	public function getMantenimientos($id){
		
		$this->db->where("id_bien",$id);
		
		$resultados = $this->db->get("mantenimientos");
		return $resultados->result();
	}


}