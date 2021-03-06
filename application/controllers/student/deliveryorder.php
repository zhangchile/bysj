<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DeliveryOrder extends CI_Controller {

    public $_water;
    public $_water_left;
    public $_sid;

    public function __construct()
    {
        parent::__construct();
        $this->_sid = $this->session->userdata('sid');
        $this->load->model('dormitory_model');
        $this->load->model('water_model');
        $this->load->model('deliveryorder_model');
        $this->load->library('dormitory');
        $this->config->load('pager_config', TRUE);
        $this->_water = $this->water_model->getall();
        $this->_water_left = $this->dormitory_model->getWaterLeft($this->_sid);
    }

    public function index($page = 1)
    {
        $perpage = 5;
        $offset = ($page - 1) * $perpage;
        $status = 'all';

        $data = $this->deliveryorder_model->getallorder($offset, $perpage, $this->_sid, $status);

        //分页
        $total = $this->deliveryorder_model->getCount($this->_sid);

        $totalpage = ceil($total / $perpage);

        $this->load->library('pagination');
        $pager_config = $this->config->item('pager_config');
        $pager_config['base_url'] = site_url("student/deliveryorder/index");
        $pager_config['total_rows'] = $total;//获取总数
        $pager_config['per_page'] = $perpage; //设置每页显示的条数
        $pager_config['uri_segment'] = 4;
        $this->pagination->initialize($pager_config);
        //END
        $this->load->view('student/deliveryorder', array('data' => $data, 'waterleft'=>$this->_water_left));
    }

    public function add()
    {
        $data = $this->input->post();
        if(!$data) show_404();
        $arr = array(
                'id'       => null,
                'sid'      => $this->_sid,
                'status'   => 1,
                'number'   => $data['number'],
                'booktime' => $data['booktime'],
                'time'     => time()
            );
        $flag = $this->deliveryorder_model->insertOrder($arr);
        redirect('student/deliveryorder/index');
    }


}
