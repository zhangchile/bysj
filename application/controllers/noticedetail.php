<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class NoticeDetail extends CI_Controller {
    public $action = null; 

    public function __construct()
    {
        parent::__construct();
        $this->load->model("acl_model");
        $this->load->model("notice_model");
        $this->config->load('pager_config',TRUE);
        $this->action = explode(",", $this->session->userdata("action"));
    }

    public function index() {
        $id = $this->input->get("id");
        if( empty($id) ) show_404();

        $page = $this->input->get("page") ? $this->input->get("page") : 1;
        // var_dump($page);
        $perpage = 5;
        $offset = ($page - 1) * $perpage;

        $data = $this->notice_model->GetOneNotice($id);
        $noticelist = $this->notice_model->GetNotice($offset, $perpage);

        $total = $this->notice_model->GetNoticeCount();
        $totalpage = ceil($total / $perpage);

        $this->load->library('pagination');
        $pager_config = $this->config->item('pager_config');
            $pager_config['page_query_string'] = TRUE;
            $pager_config['query_string_segment'] = 'page';
        $pager_config['base_url'] = site_url("noticedetail/index?id=$id");
        $pager_config['total_rows'] = $total;//获取总数
        $pager_config['per_page'] = $perpage; //设置每页显示的条数
        $this->pagination->initialize($pager_config); 

        $this->load->view("notice_detail", array("notice" => $data, "noticelist"=> $noticelist));
    }
}