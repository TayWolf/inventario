<?php
date_default_timezone_set('America/Mexico_City');
class Backend_lib
{

	public function __get($var)
    {
        return get_instance()->$var;
    }

	public function savelog($modulo, $descripcion){
		$data = array(
			"id_usuario" => $this->session->userdata("id_usuario"),
			"modulo" => $modulo,
			"fecha_logeo" => date("Y-m-d H:i:s"),
			"accion_modulo" => $descripcion,

		);

		$this->Backend_model->savelogs($data);
	}
}