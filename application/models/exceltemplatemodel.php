<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ExceltemplateModel extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getFilter() {
        $sql = "
            select filtro1
            from template_detail 
            where client_id=" . $this->session->userdata("client_id") . "
            group by 1";
        $res["filter1"] = $this->db->query($sql)->result_array();

        $sql = "
            select filtro2
            from template_detail 
            where client_id=" . $this->session->userdata("client_id") . "
            group by 1";
        $res["filter2"] = $this->db->query($sql)->result_array();
        $sql = "
            select filtro3
            from template_detail 
            where client_id=" . $this->session->userdata("client_id") . "
            group by 1";
        $res["filter3"] = $this->db->query($sql)->result_array();
        $sql = "
            select filtro4
            from template_detail 
            where client_id=" . $this->session->userdata("client_id") . "
            group by 1";
        $res["filter4"] = $this->db->query($sql)->result_array();
        $sql = "
            select filtro5
            from template_detail 
            where client_id=" . $this->session->userdata("client_id") . "
            group by 1";
        $res["filter5"] = $this->db->query($sql)->result_array();
        $sql = "
            select filtro6
            from template_detail 
            where client_id=" . $this->session->userdata("client_id") . "
            group by 1";
        $res["filter6"] = $this->db->query($sql)->result_array();


        return $res;
    }

}
