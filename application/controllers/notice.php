<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notice extends CI_Controller {
    public $action = null; 
    public $leftmenukey;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("acl_model");
        $this->load->model("notice_model");
        $this->config->load('pager_config',TRUE);
        $this->action = explode(",", $this->session->userdata("action"));
        $this->leftmenukey = '/notice/';
    }

    public function index($page = 1) {
        $perpage = 1;
        $offset = ($page - 1) * $perpage;

        $sidebar_data = $this->acl_model->GetSiderBar($this->session->userdata("masterid"));
        $sidebar_str = $this->load->view("template/sidebar", array("sidebar"=>$sidebar_data), true);

        $notice = $this->notice_model->GetNotice($offset,$perpage);
        //分页
        $total = $this->notice_model->GetNoticeCount();
        $totalpage = ceil($total / $perpage);

        $this->load->library('pagination');
        $pager_config = $this->config->item('pager_config');
        $pager_config['base_url'] = site_url("notice/index");
        $pager_config['total_rows'] = $total;//获取总数
        $pager_config['per_page'] = $perpage; //设置每页显示的条数
        $this->pagination->initialize($pager_config); 
        //END

        $this->load->view("notice", array("sidebar"=>$sidebar_str, "notice"=>$notice));
    }

    public function edit($id) {
        if( empty($id) ) show_404();
        $sidebar_data = $this->acl_model->GetSiderBar($this->session->userdata("masterid"));
        $sidebar_str = $this->load->view("template/sidebar", array("sidebar"=>$sidebar_data), true);

        $notice = $this->notice_model->GetOneNotice($id);
        if( empty($notice) ) show_404();
        $this->load->view("edit_notice", array("sidebar"=>$sidebar_str, "notice"=>$notice[0]));
    }

    public function update() {
        if(!$this->input->post()) show_404();
        $post = $this->input->post();

        $data = array(
                "title" => $post['title'],
                "content" => $post['content']
            );
        $flag = $this->notice_model->UpdateNotice($post['id'], $data);
        redirect("notice");
    }

    public function del($id) {
        if( empty($id) ) show_404();

        $flag = $this->notice_model->DelNotice($id);
        redirect("notice");
    }
}