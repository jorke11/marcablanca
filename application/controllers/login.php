<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {

        parent::__construct();

        date_default_timezone_set("America/Bogota");
        $this->load->model("LoginModel");
    }

    /**
     * metodo principal para iniciar el controlador
     */
    public function index($id = null) {
        $id = ($id == null) ? 1 : $id;
        $where = "id=" . $id;
        $data["master"] = $this->LoginModel->Buscar('marca', '*', $where, 'row');
        

        if ($data["master"] == false) {
            $where = "id=1";
            $data["master"] = $this->LoginModel->Buscar('marca', '*', $where, 'row');
        }
        
        var_dump($data["master"]);exit;

        $data["client_id"] = $id;
        $data["master"]["mensaje"] = ($data["master"]["mensaje"] == '') ? 'PLATAFORMA DE ENVIO MASIVO SMS CONTACTO SMS' : $data["master"]["mensaje"];
        $data["master"]["url"] = (isset($data["master"]["url"]) && $data["master"]["url"] == '') ? 'imagenes/logo.png' : $data["master"]["url"];
        $data["master"]["titulologin"] = (isset($data["master"]["titulologin"]) && $data["master"]["titulologin"] == '') ? 'ContactoSMS' : $data["master"]["titulologin"];
        $data["error"] = '';
        print_r($data);
        exit;
        $this->load->view('login', $data);
    }

    public function valida() {
        $post = $this->input->post();
        /**
         * Se obtiene los datos para verficar la existencia del usuario
         */
        $add = '';
        if ($post["login"] != 'admin') {
            $add = " and usuarios.idmarca=" . $post["client_id"];
        }
        $campos = "usuarios.id,usuarios.usuario,usuarios.nombre,emp.id as idempresa,usuarios.idperfil,usuarios.concatena,usuarios.idservicio";
        $where = " usuarios.usuario = '{$post["login"]}' AND usuarios.clave='" . base64_encode($post["pass"]) . "' AND usuarios.estado=1 AND emp.activo=1 " . $add;
        $datos = $this->LoginModel->Buscar('usuarios JOIN empresas as emp ON usuarios.idempresa=emp.id', $campos, $where, 'row');

        /**
         * Se verifica que exista
         */
        if ($datos != false) {

//            if ($datos->logueado == 0) {
//                $user["logueado"] = 1;
//                $this->LoginModel->update("usuarios", $datos->id, $user);

            $marca = $this->LoginModel->buscar("marca", '*', 'id=' . $post["client_id"], "row");

            $usuario = array(
                'idusuario' => $datos["id"],
                'usuario' => $datos["usuario"],
                'nombre' => $datos["nombre"],
                'idempresa' => $datos["idempresa"],
                'idperfil' => $datos["idperfil"],
                'concatena' => $datos["concatena"],
                'idservicio' => $datos["idservicio"],
                'ip' => $_SERVER['REMOTE_ADDR'],
                'client_id' => $post["client_id"],
                'marca' => $marca
            );

            /**
             * Se agregan los datos se SESSION
             */
            $this->session->set_userdata($usuario);
            $session = array(
                "idusuario" => $datos["id"],
                'ingreso' => date("Y-m-d H:i:s"),
                'ip' => $_SERVER['REMOTE_ADDR'],
                'eventos' => 'Inicio de sesion'
            );
            /**
             * Se agrega el registro de session
             */
            $this->LoginModel->insert("sesiones", $session);
            redirect(base_url() . "inicio");
//            } else {
//                redirect("login");
//            }
        } else {
            /**
             * En caso de error redirecciona
             */
            redirect($post["client_id"]);
//            $data["error"] = 'Usuario o clave Incorrecto';
//            $this->load->view("login", $data);
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
