<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitores_model extends CI_Model {

	public function getMonitores($estado = false,$search,$fechainicio = false, $fechafinal =false){
		$this->db->select("m.*, e.nombre as elemento, a.nombre as area, u.nombres");
		$this->db->from("monitores m");
		$this->db->join("elemento e","m.finca_id = e.id", "Left");
		$this->db->join("areas a","m.area_id = a.id", "Left");
		$this->db->join("usuarios u","m.usuario_id = u.id", "Left");
		if ($fechainicio !== false && $fechafinal !== false) {
			$this->db->where("m.fecregistro >=", $fechainicio." "."00:00:00");
			$this->db->where("m.fecregistro <=", $fechafinal." "."23:59:59");

		}
		if ($estado != false) {
			$this->db->where("m.estado",1);
		}
		$this->db->like("CONCAT(m.codigo,'',m.tamaño,'', e.nombre, '', a.nombre, '', u.nombres)",$search);
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function infoMonitor($id){
		$this->db->select("m.*, pro.nombre as proveedor, f.nombre as finca, fa.nombre as fabricante,a.nombre as area");
		$this->db->from("monitores m");
	
		$this->db->join("proveedores pro","m.proveedor_id = pro.id");
		$this->db->join("elemento f","m.finca_id = f.id");
		$this->db->join("fabricantes fa","m.fabricante_id = fa.id");

		$this->db->join("areas a","m.area_id = a.id");
		$this->db->where("m.id", $id);
		$resultados = $this->db->get();
		return $resultados->row();
	}

	public function save($data){
		return $this->db->insert("monitores",$data);
	}

	public function getMonitor($id){
		$this->db->where("id", $id);
		$resultados = $this->db->get("monitores");
		return $resultados->row();
	}

	public function update($id,$data){
		$this->db->where("id", $id);
		return $this->db->update("monitores",$data);
	}

	public function saveMante($data){
		return $this->db->insert("monitores_mantenimientos",$data);
	}

	public function getMantenimientos($id){
		
		$this->db->where("monitor_id",$id);
		
		$resultados = $this->db->get("monitores_mantenimientos");
		return $resultados->result();
	}


}