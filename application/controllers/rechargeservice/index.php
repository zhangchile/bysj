<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

    public $action; 
    public $_masterid;
    public $leftmenukey;

    public function __construct()
    {
        parent::__construct();
        $this->action = explode(",", $this->session->userdata("action"));
        $this->_masterid = $this->session->userdata("masterid");
        $this->load->model('recharge_model');
        $this->load->model('dormitory_model');
        $this->load->model('rechargeprize_model');
        $this->load->library("dormitory");
        $this->config->load('pager_config',TRUE);
        $this->leftmenukey = '/rechargeservice/';
    }

    public function index($page = 1)
    {
        $condition = $this->input->get();

        $type = '';
        $status = '';
        $operate = '';
        $sid = '';
        if($condition) {
            $type = $condition['type'] == 'all' ? '': $condition['type'];
            $status = $condition['status'] == 'all' ? '': $condition['status'];
            $operate = $condition['operate'] == 'all' ? '': $condition['operate'];
            $sid = $condition['sid'] == 'all' ? '': $condition['sid'];
        }
        $perpage = 5;
        $offset = ($page - 1) * $perpage;
        $sid = strtoupper($sid);
        $data = $this->recharge_model->getorders($offset, $perpage, $type, $status, $operate, $sid);
        $prize_data = $this->rechargeprize_model->getAll();
// var_dump($prize_data);
        $sidebar_data = $this->acl_model->GetSiderBar($this->session->userdata("masterid"));

        //分页
        $total = $this->recharge_model->getCount($type, $operate, $status, $sid);

        $totalpage = ceil($total / $perpage);

        $this->load->library('pagination');
        $pager_config = $this->config->item('pager_config');
        $pager_config['base_url'] = site_url("rechargeservice/index/index");
        $pager_config['total_rows'] = $total;//获取总数
        $pager_config['per_page'] = $perpage; //设置每页显示的条数
        $pager_config['uri_segment'] = 4;
        $this->pagination->initialize($pager_config);
        //END
        $this->load->view('rechargeservice/index', array("data"=>$data,'prize_data'=>$prize_data, 'sidebar' => $sidebar_data));
    }

    public function update()
    {
        $data = $this->input->get();
        if(!$data) show_404();
        $arr = array(
                'status' => $data['status']
            );
        $flag = $this->recharge_model->update($data['id'], $arr);
        //更新用户的余额
        $left = $this->dormitory_model->getChargeLeft($data['sid']);
        // var_dump($left);exit;
        if($data['type'] == '1') {
            //更新水费
            $this->dormitory_model->update($data['sid'], array('watercharge' => $data['changes'] + $left[0]['watercharge']));
            
        } else if($data['type'] == '2'){
            //更新电费
            $this->dormitory_model->update($data['sid'], array('electricitycharge' => $data['changes'] + $left[0]['electricitycharge']));
        }
        redirect('rechargeservice/index/');
    }

    public function editprize()
    {
        $data = $this->input->post();
        if(!$data) show_404();
        $arr = array(
                'water'=>$data['water'],
                'electricity' => $data['electricity'],
            );
        $this->rechargeprize_model->update('1',$arr);
        redirect('rechargeservice/index/');
    }
}