<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

	public function getUsuarios(){
		$this->db->select("u.*, per.*");
		$this->db->from("usuarios u");
		$this->db->join("roles r", "r.id_rol = u.id_rol","left");
		$this->db->join("personas per", "u.id_persona = per.id_persona","left");
		$this->db->order_by("id_usuario", "asc");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function getUsuario($id){
		$this->db->select("u.*, per.*");
		$this->db->from("usuarios u");
		$this->db->join("roles r", "u.id_rol = r.id_rol","left");
		$this->db->join("personas per", "u.id_persona = per.id_persona","left");
		$this->db->where("u.id_usuario", $id);
		$resultados = $this->db->get();
		return $resultados->row();
	}

	public function save($data){
		return $this->db->insert("usuarios",$data);
	}

	public function update($id,$data){
		$this->db->where("id_usuario",$id);
		return $this->db->update("usuarios",$data);
	}

	public function login($email, $password){
		$this->db->select("u.*, per.*");
		$this->db->from("usuarios u");
		$this->db->join("roles r", "r.id_rol = u.id_rol","left");
		$this->db->join("personas per", "u.id_persona = per.id_persona","left");

		$this->db->where("usuario", $email);
		$this->db->where("password_usuario", $password);
		// $this->db->where("id_status", 1);

		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->row();
		}
		else{
			return false;
		}
	}

	public function getRoles(){
		$resultados = $this->db->get("roles");
		return $resultados->result();
	}

	
}