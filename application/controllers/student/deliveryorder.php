<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DeliveryOrder extends CI_Controller {

    public $_water;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('waterorder_model');
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

        $data = $this->deliveryorder_model->getorders($offset, $perpage, $this->_sid, $status);

        foreach ($data as $wkey => $wvalue) {
            foreach ($this->_water as $key => $value) {
                if($wvalue['watertype'] == $value['id'])
                    $data[$wkey]['typename'] = $value['name'];
            }
        }

        //分页
        $total = $this->deliveryorder_model->getCount($this->_sid);

        $totalpage = ceil($total / $perpage);

        $this->load->library('pagination');
        $pager_config = $this->config->item('pager_config');
        $pager_config['base_url'] = site_url("waterservice/index/index");
        $pager_config['total_rows'] = $total;//获取总数
        $pager_config['per_page'] = $perpage; //设置每页显示的条数
        $pager_config['uri_segment'] = 4;
        $this->pagination->initialize($pager_config);
        //END
        $this->load->view('student/deliveryorder', array('data' => $data));
    }

    public function update()
    {
        $data = $this->input->get();
        if(!$data) show_404();
        $arr = array(
                'status' => 3
            );
        $flag = $this->waterorder_model->update($data['id'], $arr);
        //更新用户的剩余水量
        $waterleft = $this->dormitory_model->getWaterLeft($data['sid']);
        $this->dormitory_model->update($data['sid'], array('waterleft' => $data['number'] + $waterleft[0]['waterleft']));
        redirect('waterservice/index/');
    }
}
