<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

    public $_water;

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
    }

    public function index($page = 1)
    {
        $perpage = 5;
        $offset = ($page - 1) * $perpage;
        $status = 'all';

        if($this->input->get('status'))
            $status = $this->input->get('status');
        $data = $this->deliveryorder_model->getallorder($offset, $perpage, '', $status);
        //分页
        $total = $this->deliveryorder_model->getCount();

        $totalpage = ceil($total / $perpage);

        $this->load->library('pagination');
        $pager_config = $this->config->item('pager_config');
        $pager_config['base_url'] = site_url("deliveryservice/index/index");
        $pager_config['total_rows'] = $total;//获取总数
        $pager_config['per_page'] = $perpage; //设置每页显示的条数
        $pager_config['uri_segment'] = 4;
        $this->pagination->initialize($pager_config);
        //END
        $this->load->view('deliveryservice/index', array('data' => $data));
    }

    public function update()
    {
        $data = $this->input->get();
        if(!$data) show_404();
        $arr = array(
                'status' => 2
            );
        $flag = $this->deliveryorder_model->update($data['id'], $arr);
        //更新用户的剩余水量
        $waterleft = $this->dormitory_model->getWaterLeft($data['sid']);
        $this->dormitory_model->update($data['sid'], array('waterleft' =>$waterleft[0]['waterleft'] - $data['number']));
        redirect('deliveryservice/index/');
    }


}
