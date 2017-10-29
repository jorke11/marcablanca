<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master extends MY_Controller {

    private $tabla;

    public function __construct() {
        parent::__construct();
        $this->load->model("AdministradorModel");
        $this->tabla = "marca";
    }

    /**
     * Metodo para cargar la vista principal de administrador
     */
    public function index() {
        /**
         * Metodos que se obtiene para precargar datos en los formularios
         */
        $data["canales"] = $this->AdministradorModel->buscar("canales ORDER BY nomenclatura", '*');

        $data["data"] = $this->AdministradorModel->buscar("marca", '*', 'id=' . $this->session->userdata("client_id"), "row");

        $data["vista"] = 'master/init';
        $this->load->view('template', $data);
    }

    public function store() {
        $data = $this->input->post();
        $datas = array();
        $canales = $data["idcanal"];
        unset($data["idcanal"]);
        unset($data["idcarries"]);
        $id = $data["id"];

        unset($data["id"]);
        $name = $_FILES["url"]["name"];
        $archivo = $_FILES["url"]["tmp_name"];

        if ($name != null) {

//            $ruta = $this->crearRutaCarpeta(FCPATH . "imagenes\\" . $this->session->userdata("client_id"));
            $ruta = $this->crearRutaCarpeta(FCPATH . "imagenes/" . $this->session->userdata("client_id"));

            $config['upload_path'] = $ruta;
            $config['allowed_types'] = '*';
            $config['file_name'] = $name;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('url')) {
                print_r($this->upload->display_errors());
            } else {
                $datas = array('upload_data' => $this->upload->data());
//                $img_full_path = "imagenes\\" . $this->session->userdata("client_id") . "\\" . $datas['upload_data']['file_name'];
                $img_full_path = "imagenes/" . $this->session->userdata("client_id") . "/" . $datas['upload_data']['file_name'];


//                $data["url"] = "imagenes/$name";
                // REDIMENSIONAMOS DE NUEVO
                $config['image_library'] = 'gd';
                $config['source_image'] = $img_full_path;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 200;
                $config['height'] = 200;
//                $config['new_image'] = "imagenes\\" . $this->session->userdata("client_id") . '\\' . $datas['upload_data']['file_name'];
                $config['new_image'] = "imagenes/" . $this->session->userdata("client_id") . '/' . $datas['upload_data']['file_name'];

                $this->load->library('image_lib');
                $this->image_lib->clear();
                $this->image_lib->initialize($config); /// <<- IMPORTANTE
                if (!$this->image_lib->resize()) {
                    @unlink($img_full_path);
                    @unlink($img_redim1);
                    echo $this->image_lib->display_errors();
                    exit();
                }

                $data["url"] = $config['new_image'];
            }
        }

        $canal = '';
        foreach ($canales as $i => $value) {
            $canal .= ($canal == '') ? '' : ',';
            $canal .= $value;
        }


        $data["preferencias"] = $canal;

        if ($data["maximo_servicio"] == '') {
            unset($data["maximo_servicio"]);
        }

        if ($id == '') {
            $id = $this->AdministradorModel->insert($this->tabla, $data);
        } else {

            $this->AdministradorModel->update($this->tabla, $id, $data);
        }

        $resp = $this->AdministradorModel->buscar($this->tabla, "*", "id=" . $id, "row");

        echo json_encode(array("success" => true, "data" => $resp));
    }

    public function ListMarcas() {
        echo $this->datatables
                ->select("*")
                ->from("marca")
                ->generate();
    }

    public function getMarca($idext = NULL) {
        $id = ($idext == NULL) ? $this->input->post("id") : $idext;
        $where = "id=" . $id;
        $datos = $this->AdministradorModel->buscar($this->tabla, "*", $where, 'row');

        $prefencias = ($datos["preferencias"] != NULL) ? explode(",", $datos["preferencias"]) : NULL;

        foreach ($prefencias as $i => $valor) {
            $prefer["canal_" . $i] = $valor;
        }

        $respuesta["datos"] = $datos;
        $respuesta["preferencia"] = $prefer;

        echo json_encode($respuesta);
    }

}
