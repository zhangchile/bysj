<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model("acl_model");
        $this->load->model("notice_model");
    }

    public function index($page = 1)
    {
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
        $pager_config['base_url'] = site_url("superadmin/homepage/index");
        $pager_config['total_rows'] = $total;//获取总数
        $pager_config['per_page'] = $perpage; //设置每页显示的条数
        $this->pagination->initialize($pager_config);
        //END
        $this->load->view('student/index', array("sidebar"=>$sidebar_str,"notice"=>$notice));
    }
}