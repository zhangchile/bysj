<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        // $this->load->model("acl_model");
    }

    public function index()
    {
        // var_dump($this->session->all_userdata());
        if($this->session->userdata('identity') == "superadmin") 
            redirect("superadmin/homepage");
        else if($this->session->userdata('identity') == "student") {
            redirect("building");
        } else {
            redirect("login");
        }
    }
}