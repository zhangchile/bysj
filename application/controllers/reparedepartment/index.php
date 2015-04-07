<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

    public $_sid; 
    public $_masterid;

    public function __construct()
    {
        parent::__construct();
        $this->_sid = $this->session->userdata('sid');
        $this->_masterid = $this->session->userdata("masterid");
        $this->load->model('repareorder_model');
        $this->load->model('acl_model');
        $this->config->load('pager_config',TRUE);
    }

    public function index($page = 1)
    {
        $condition = $this->input->get();

        $type = '';
        $status = '';
        if($condition) {
            $type = $condition['type'] == 'all' ? '': $condition['type'];
            $status = $condition['status'] == 'all' ? '': $condition['status'];
        }
        $perpage = 5;
        $offset = ($page - 1) * $perpage;
        $data = $this->repareorder_model->getorders($type, $offset, $perpage, $status);
        $sidebar_data = $this->acl_model->GetSiderBar($this->session->userdata("masterid"));

// var_dump($data);
        //分页
        $total = $this->repareorder_model->getCountType($type, $status);

        $totalpage = ceil($total / $perpage);

        $this->load->library('pagination'); 
        $pager_config = $this->config->item('pager_config');
        $pager_config['base_url'] = site_url("reparedepartment/index/index");
        $pager_config['total_rows'] = $total;//获取总数
        $pager_config['per_page'] = $perpage; //设置每页显示的条数
        $pager_config['uri_segment'] = 4;
        $this->pagination->initialize($pager_config);

        //END
        $this->load->view("reparedepartment/index", array('data' => $data, 'sidebar' => $sidebar_data));
    }

    public function update()
    {
        $data = $this->input->get();
        if(!$data) show_404();
        // var_dump($data);
        $arr = array(
                'id' => $data['id'],
                'status' => $data['status']
            );
        $flag = $this->repareorder_model->updateOrder($arr['id'], $arr);
        redirect('reparedepartment/index/');
    }
}