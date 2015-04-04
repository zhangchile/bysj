<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RepareApply extends CI_Controller {

    public $_sid; 

    public function __construct()
    {
        parent::__construct();
        $this->_sid = $this->session->userdata('sid');
        $this->load->model('repareorder_model');
        $this->config->load('pager_config',TRUE);
    }

    public function index($page = 1)
    {
        $perpage = 5;
        $offset = ($page - 1) * $perpage;
        $data = $this->repareorder_model->getallorder($this->_sid, $offset, $perpage);

// var_dump($data);
        //分页
        $total = $this->repareorder_model->geCount($this->_sid);

        $totalpage = ceil($total / $perpage);

        $this->load->library('pagination');
        $pager_config = $this->config->item('pager_config');
        $pager_config['base_url'] = site_url("student/repareapply/index");
        $pager_config['total_rows'] = $total;//获取总数
        $pager_config['per_page'] = $perpage; //设置每页显示的条数
        $pager_config['uri_segment'] = 4;
        $this->pagination->initialize($pager_config);
        //END        
        $this->load->view("student/repareapply", array('data' => $data));
    }

    public function apply()
    {
        $post = $this->input->post();
        if(!$post) show_404();
        $data = array(
                'id'          => null,
                'sid'         => $this->_sid,
                'applytime'   => time(),
                'booktime'  => null,
                'description' => $post['description'],
                'type'        => $post['type'],
                'status'      => 0,
            );
        $this->repareorder_model->insertOrder($data);
        redirect("student/repareapply");
    }
}