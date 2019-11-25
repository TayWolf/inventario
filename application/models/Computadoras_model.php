<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Computadoras_model extends CI_Model {

	public function getComputadoras($estado = false,$search,$fechainicio = false, $fechafinal =false, $ip = 0){
		
		$this->db->select("b.*, e.*, a.nombre_area, u.usuario, ips.direccion_ip, per.*, mar.marca, stat.nombre_status");
		$this->db->from("bienes b");
		$this->db->join("elementos e","b.id_elemento = e.id_elemento","Left");
		$this->db->join("personas per","b.id_persona = per.id_persona","Left");
		$this->db->join("marcas mar","b.id_marca = mar.id_marca","Left");
		$this->db->join("areas a","per.id_area = a.id_area","Left");
		$this->db->join("usuarios u","b.id_usuario = u.id_usuario","Left");
		$this->db->join("cat_status stat","b.id_status = stat.id_status","Left");
		$this->db->join("ips","b.id_ip = ips.id_ip","Left");
		$this->db->where("b.id_elemento =", 1);

		if ($fechainicio !== false && $fechafinal !== false) {
			$this->db->where("b.fecregistro >=", $fechainicio." "."00:00:00");
			$this->db->where("b.fecregistro <=", $fechafinal." "."23:59:59");

		}
		if ($ip == 1) {
			$this->db->where("ip.id_status",0);
		}
		if ($estado != false) {
			$this->db->where("b.id_status",5);
		}
		$this->db->like("CONCAT(b.id_bien, '', e.elemento, '', a.nombre_area,'',u.usuario,'',per.nombres,'',per.ap_paterno,'',per.ap_materno)",$search);
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function infoComputadora($id){
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

	public function save($data){
		return $this->db->insert("bienes",$data);
	}

	public function getComputadora($id_bien){
		$this->db->where("id_bien", $id_bien);
		$resultados = $this->db->get("bienes");
		return $resultados->row();
	}

	public function update($id_bien, $data){
		$this->db->where("id_bien", $id_bien);
		return $this->db->update("bienes",$data);
	}

	public function delete($id_bien){
		$this->db->where("id_bien", $id_bien);
		return $this->db->delete("bienes");
	}

	public function saveMante($data){
		return $this->db->insert("mantenimientos",$data);
	}

	/*public function savePropietario($data){
		return $this->db->insert("bienes",$data);
	}*/

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

	public function getPropietarios($id_bien){
		
		$this->db->where("id_personas",$id_bien);
		
		$resultados = $this->db->get("personas");
		return $resultados->result();
	}


}