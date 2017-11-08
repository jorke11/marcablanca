<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class cronDirs extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("AdministradorModel");
    }

    public function index() {
        /**
         * trae todos los usuarios
         */
        $data["usuarios"] = $this->AdministradorModel->obtenerCampos('usuarios', '*', null);

        $hoy = date("Y-m-d");
        //$hoy = '2017-07-26';
        for($i=0;$i<sizeof($data["usuarios"]);$i++)
        {

            $dir1 = '/var/www/html/marcablanca/planos/'.$data["usuarios"][$i]["id"];
            if (!file_exists($dir1))
            {
                mkdir($dir1);
                chmod($dir1, 0777);
                echo "Se creo la ruta ".$dir1."\n";
            }
            $dir2 = '/var/www/html/marcablanca/planos.c/'.$data["usuarios"][$i]["id"];
            if (!file_exists($dir2))
            {
                mkdir($dir2);
                chmod($dir2, 0777);
                echo "Se creo la ruta ".$dir2."\n";
            }
        }//fiin for
        

    }
}
