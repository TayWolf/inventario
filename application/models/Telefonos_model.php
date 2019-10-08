<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Telefonos_model extends CI_Model {

	public function getTelefonos($estado = false,$search,$fechainicio = false, $fechafinal =false){
		$this->db->select("t.*,u.nombres, a.nombre as area, i.descripcion");
		$this->db->from("telefonos t");
		$this->db->join("areas a","t.id_area = a.id", "left");
		$this->db->join("ip i","t.id_ip = i.id", "left");
		$this->db->join("usuarios u","t.usuario_id = u.id", "left");
		if ($fechainicio !== false && $fechafinal !== false) {
			$this->db->where("t.fecregistro >=", $fechainicio." "."00:00:00");
			$this->db->where("t.fecregistro <=", $fechafinal." "."23:59:59");

		}
		if ($estado != false) {
			$this->db->where("t.estado",1);
		}
		$this->db->like("CONCAT(t.no_ext, '',t.modelo,'',u.nombres)",$search);
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function infoTelefono($id){
		$this->db->select("t.*, a.nombre as area, i.descripcion");
		$this->db->from("telefonos t");
		$this->db->join("ip i","t.id_ip = i.id");
		$this->db->join("areas a","t.id_area = a.id");
		$this->db->where("t.id", $id);
		$resultados = $this->db->get();
		return $resultados->row();
	}

	public function save($data){
		return $this->db->insert("telefonos",$data);
	}

	public function getTelefono($id){
		$this->db->where("id", $id);
		$resultados = $this->db->get("telefonos");
		return $resultados->row();
	}

	public function update($id,$data){
		$this->db->where("id", $id);
		return $this->db->update("telefonos",$data);
	}

	public function saveMante($data){
		return $this->db->insert("telefonos_mantenimientos",$data);
	}

	public function getMantenimientos($id){
		
		$this->db->where("tablet_id",$id);
		
		$resultados = $this->db->get("telefonos_mantenimientos");
		return $resultados->result();
	}


}