<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recharge extends CI_Controller {

    public $_sid; 

    public function __construct()
    {
        parent::__construct();

        $this->config->load('pager_config',TRUE);
        $this->load->model('recharge_model');
        $this->load->model('dormitory_model');
        $this->_sid = $this->session->userdata('sid');
    }

    public function index($page = 1)
    {

        $condition = $this->input->get();

        $type    = '';
        $status  = '';
        $operate = '';
        if($condition) {
            $type    = $condition['type']    == 'all' ? '': $condition['type'];
            $status  = $condition['status']  == 'all' ? '': $condition['status'];
            $operate = $condition['operate'] == 'all' ? '': $condition['operate'];
        }
        $perpage = 5;
        $offset = ($page - 1) * $perpage;
        $data = $this->recharge_model->getAll($this->_sid, $offset, $perpage, $type, $status, $operate);
        $charge_left = $this->dormitory_model->getChargeLeft($this->_sid);
        //分页
        $total = $this->recharge_model->getCount($type, $operate, $status, $this->_sid);

        $totalpage = ceil($total / $perpage);

        $this->load->library('pagination');
        $pager_config = $this->config->item('pager_config');
        $pager_config['base_url'] = site_url("student/recharge/index");
        $pager_config['total_rows'] = $total;//获取总数
        $pager_config['per_page'] = $perpage; //设置每页显示的条数
        $pager_config['uri_segment'] = 4;
        $this->pagination->initialize($pager_config);
        //END
    	$this->load->view('student/recharge', array('data'=>$data,'chargeLeft'=>$charge_left));
    }

    public function add()
    {
        $post = $this->input->post();
        if(!$post) show_404();
        
        $data = array(
                'id'      => null,
                'sid'     => $this->_sid,
                'billid'  => null,
                'type'    => $post['type'],
                'operate' => '1',
                'status'  => '1',
                'changes' => $post['changes'],
                'date'    => time(),
            );
        $id = $this->recharge_model->insertOrder($data);
        redirect('student/recharge/pay/'.$id);
    }

    public function pay($id='')
    {
        $post = $this->input->post();
        if($post) {
            $data = array(
                    'billid' => $post['billid'],
                    'status' => '2',
                    );
            $flag = $this->recharge_model->update($post['id'], $data);
            redirect('student/recharge/');
        } else {

            if(!$id) show_404();
            $data = $this->recharge_model->getOneOrder($id, $this->_sid);
 
            $this->load->view('student/recharge_pay', array('data'=>$data));
            
        }
    }
}