<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Homepage extends CI_Controller {
    public $action = null; 

    public function __construct()
    {
        parent::__construct();
        $this->load->model("acl_model");
        $this->load->model("notice_model");
        $this->config->load('pager_config',TRUE);
        $this->action = explode(",", $this->session->userdata("action"));
    }

    public function index($page = 1) {
        $sidebar_data = $this->acl_model->GetSiderBar($this->session->userdata("masterid"));
        $sidebar_str = $this->load->view("template/sidebar", array("sidebar"=>$sidebar_data), true);
        $perpage = 5;
        $offset = ($page - 1) * $perpage;
        $notice = $this->notice_model->GetNotice($offset,$perpage);
        //分页
        $total = $this->notice_model->GetNoticeCount();
        $totalpage = ceil($total / $perpage);

        $this->load->library('pagination');
        $pager_config = $this->config->item('pager_config');
        $pager_config['base_url'] = site_url("homepage/index");
        $pager_config['total_rows'] = $total;//获取总数
        $pager_config['per_page'] = $perpage; //设置每页显示的条数
        $this->pagination->initialize($pager_config);
        //END


        $this->load->view("admin_homepage", array("sidebar"=>$sidebar_str,"notice"=>$notice));
    }

    public function pushnotice() {
        if(!$this->input->post()) show_404();
        $post = $this->input->post();

        $data = array(
                "id" => "null",
                "title" => $post['title'],
                "content" => $post['content'],
                "authorid" => $this->session->userdata("masterid"),
                "author" => $this->session->userdata("truename"),
                "time" => time()
            );
        $this->notice_model->AddNotice($data);
        redirect("homepage");
    }
}