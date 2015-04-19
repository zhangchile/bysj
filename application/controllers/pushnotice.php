<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PushNotice extends CI_Controller {
    public $action = null; 
    public $leftmenukey;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("acl_model");
        $this->load->model("notice_model");
        $this->action = explode(",", $this->session->userdata("action"));
        $this->leftmenukey = '/pushnotice/';
    }

    public function index() {
        $sidebar_data = $this->acl_model->GetSiderBar($this->session->userdata("masterid"));
        $sidebar_str = $this->load->view("template/sidebar", array("sidebar"=>$sidebar_data), true);

        $this->load->view("pushnotice", array("sidebar"=>$sidebar_str));
    }

    public function push() {
        if(!$this->input->post()) show_404();
        $post = $this->input->post();
// var_dump($post);exit;
        $data = array(
                "id" => null,
                "title" => $post['title'],
                "content" => $post['content'],
                "authorid" => $this->session->userdata("masterid"),
                "author" => $this->session->userdata("truename"),
                "time" => time()
            );
        $this->notice_model->AddNotice($data);
        redirect("superadmin/homepage");
    }

}