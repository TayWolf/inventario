<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ip_model extends CI_Model {

	public function getIps(){
		$this->db->select("i.*, cs.nombre_status");
		$this->db->from("ips i");
		$this->db->join("cat_status cs","i.id_status = cs.id_status","Left");

		$resultados = $this->db->get();
		return $resultados->result();
	}
	public function getIpsReporte($estado = false,$search,$fechainicio = false, $fechafinal =false){
		$this->db->select("i.*, cs.nombre_status");
		$this->db->from("ips i");
		$this->db->join("cat_status cs","i.id_status = cs.id_status","Left");
	
		$this->db->like("CONCAT(i.id_ip)",$search);
		$resultados = $this->db->get();
		return $resultados->result();
	}
	public function getIpLibreCPU(){
		$this->db->where("id_status",3);
		$this->db->where("rango_ip",1);
		$resultados = $this->db->get("ips");
		return $resultados->result();
	}

	public function getIpLibreTel(){
		$this->db->where("id_status",3);
		$this->db->where("rango_ip",2);
		$resultados = $this->db->get("ips");
		return $resultados->result();
	}

	public function getIpLibreServ(){
		$this->db->where("id_status",3);
		$this->db->where("rango_ip",3);
		$resultados = $this->db->get("ips");
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("ips",$data);
	}

	public function getIp($id){
		$this->db->select("i.*, cs.nombre_status");
		$this->db->from("ips i");
		$this->db->join("cat_status cs","i.id_status = cs.id_status","Left");

		$this->db->where("id_ip", $id);
		$resultados = $this->db->get();
		return $resultados->row();
	}

	public function update($id,$data){
		$this->db->where("id_ip", $id);
		return $this->db->update("ips",$data);
	}

	public function delete($id){
		$this->db->where("id_ip", $id);
		return $this->db->delete("ips");
	}


}