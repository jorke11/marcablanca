<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Administrador extends MY_Controller {

    private $tabla;

    public function __construct() {

        parent::__construct();
        $this->load->model("AdministradorModel");
        $this->tabla = 'usuarios';
    }

    /**
     * Metodo para cargar la vista principal de administrador
     */
    public function index() {
        /**
         * Metodos que se obtiene para precargar datos en los formularios
         */
        $perfil = '';

        if ($this->session->userdata("idperfil") != 5) {
            $perfil = ' WHERE id<>5';
        }
        $empresa = '';

        if ($this->session->userdata("idperfil") != 5) {
            $empresa = ' WHERE idmarca=' . $this->session->userdata("client_id");
        }
        $servicios = '';
        if ($this->session->userdata("idperfil") != 5) {
            $servicios = ' WHERE idmarca=' . $this->session->userdata("client_id");
        }

        $data["idperfil"] = $this->AdministradorModel->buscar('perfiles ' . $perfil, 'id,perfil');
        $data["idservicio"] = $this->AdministradorModel->buscar('servicios ' . $servicios, 'id,nombre');
        $parametros["idempresa"] = $this->session->userdata("idempresa");
        $parametros["idperfil"] = $this->session->userdata("idperfil");
        $usuario = $this->session->userdata("usuario");
        $data["usuarios"] = $this->AdministradorModel->datosUsuarios($parametros, $usuario);
        $data["carries"] = $this->AdministradorModel->buscar('carries', 'id,nombre,prefijos,codigo');
        $data["servicios"] = $this->AdministradorModel->buscar('servicios ' . $servicios, 'id,nombre,tiposervicio,maximo,acumula');
        $data["empresas"] = $this->AdministradorModel->buscar('empresas ' . $empresa, 'id,nombre,nit,direccion,telefonos,contacto,activo');
        $data["idempresa"] = $this->AdministradorModel->buscar('empresas ' . $empresa . ' ORDER BY nombre', 'id,nombre');

        $data["canales"] = $this->AdministradorModel->buscar("canales ORDER BY nomenclatura", '*');
        $data["vista"] = 'administrador/index';
        $this->load->view('template', $data);
    }

    /**
     * Metodo que destruye la session de usuario y lo registra como evento en la tabla se SESSION
     */
    public function cerrarSession() {
        $idclient = $this->session->userdata("client_id");
        $session = array(
            "idusuario" => $this->session->userdata("idusuario"),
            'salida' => date("Y-m-d H:i:s"),
            'ip' => $_SERVER['REMOTE_ADDR'],
            'eventos' => 'Cierre de sesión'
        );
        $user["logueado"] = 0;
        $this->AdministradorModel->insert("sesiones", $session);
        $this->AdministradorModel->update("usuarios", $this->session->userdata("idusuario"), $user);
        $this->session->sess_destroy();
        redirect($idclient);
    }

    public function cargaTabla() {
//        $draw = 1;
//        $campos = "id,nombre,nit,direccion,telefonos,contacto,CASE WHEN (activo = 1) THEN 'Activo' ELSE 'Inactivo' END estado";
//        $datos = $this->AdministradorModel->buscar('empresas', $campos,'idmarca='.$this->session->userdata("client_id"),"xdebug");
//        echo $this->datatables
//                ->select("id,nombre,nit,direccion,telefonos,contacto,estado")
//                ->from("vempresa")
//                ->where("idmarca",$this->session->userdata("client_id"))
//                ->generate();

        $datos = $this->AdministradorModel->buscar("vempresa", "*", "idmarca=" . $this->session->userdata("client_id"));

        $respuesta = $this->dataTable($datos);
        $respuesta["draw"] = 1;
        echo json_encode($respuesta);
    }

    function Array2aaData($array) {
        $string = '';
        $coma = "";
        $out = '{ "aaData": ';
        $tam = COUNT($array);
        foreach ($array as $i => $value) {

            $out .= "[ ";
            foreach ($value as $val) {
                $string .= ($string == '') ? '' : ",";
                $string .= '"' . $val . '"';
            }
            $coma = ($tam - 1 == $i) ? '' : ',';
            $out .= $string . "]" . $coma;
            $string = '';
        }
        $out .= "}";

        return $out;
    }

    public function editPassword() {
        $data["vista"] = 'administrador/password';
        $this->load->view('template', $data);
    }

    public function updatePassword() {

        $this->load->library("email");
//        $this->load->library("email");
        /**
         * Configuracion de la cuenta de correo
         */
        $correo = $this->AdministradorModel->buscar("correos", '*', 'id=1', 'row');
        $config['protocol'] = $correo["protocolo"];
        $config['smtp_host'] = $correo["host"];
        $config['smtp_port'] = $correo["puerto"];
        $config['smtp_user'] = $correo["usuario"];
        $config['smtp_pass'] = $correo["clave"];
        $config['smtp_timeout'] = '7';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not

        $in = $this->input->post();

        $user_id = $this->session->userdata("idusuario");
        $datos = $this->AdministradorModel->buscar('usuarios', 'clave', "id=" . $user_id, 'row');
        $current = base64_encode($in["password_current"]);

        if ($current == $datos["clave"]) {

            $this->email->initialize($config);
            $this->email->from('Notificaciones Contactosms');
            $this->email->to("servicioalcliente@contactosms.com.co");
            $this->email->subject('Cambio de clave');
            $sms = "[" . date("Y-m-d H:i") . "] Usuario [" . $this->session->userdata("usuario") . "] cambio clave:[" . $in["password"] . "]<br>Contactosms";
            $this->email->message($sms);
            $this->email->send();

            $user["clave"] = base64_encode($in["password"]);
            $this->AdministradorModel->update("usuarios", $this->session->userdata("idusuario"), $user);
            echo json_encode(array("success" => true, "msg" => "La clave actualizada"));
        } else {
            echo json_encode(array("success" => false, "msg" => "La clave no coince con la actual"));
        }
    }

}
