<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipo_claves_model extends CI_Model {

	public function getTipoClaves()
	{
		$resultados = $this->db->get(" tipo_claves");
		return $resultados->result();
	}

	public function getTipoClave($id){
		$this->db->where("id_tipo_clave", $id);
		$resultados = $this->db->get(" tipo_claves");
		return $resultados->row();
	}

	public function save($data){
		return $this->db->insert(" tipo_claves",$data);
	}

	public function update($id,$data){
		$this->db->where("id_tipo_clave", $id);
		return $this->db->update(" tipo_claves",$data);
	}

	public function delete($id)
	{
		$this->db->where("id_tipo_clave", $id);
		return $this->db->delete(" tipo_claves");
	}
}