<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WaterOrder extends CI_Controller {

    public $_sid;
    public $_water;

    public function __construct()
    {
        parent::__construct();
        $this->_sid = $this->session->userdata('sid');
        $this->load->model('waterorder_model');
        $this->load->model('water_model');
        $this->config->load('pager_config', TRUE);
        $this->_water = $this->water_model->getall();
    }

    public function index($page = 1)
    {
        $perpage = 5;
        $offset = ($page - 1) * $perpage;
        $data = $this->waterorder_model->getorders($this->_sid, $offset, $perpage);

        foreach ($data as $wkey => $wvalue) {
            foreach ($this->_water as $key => $value) {
                if($wvalue['watertype'] == $value['id'])
                    $data[$key]['typename'] = $value['name'];
            }
        }
        //分页
        $total = $this->waterorder_model->getCount($this->_sid);

        $totalpage = ceil($total / $perpage);

        $this->load->library('pagination');
        $pager_config = $this->config->item('pager_config');
        $pager_config['base_url'] = site_url("student/waterorder/index");
        $pager_config['total_rows'] = $total;//获取总数
        $pager_config['per_page'] = $perpage; //设置每页显示的条数
        $pager_config['uri_segment'] = 4;
        $this->pagination->initialize($pager_config);
        //END
    	$this->load->view('student/waterorder', array('data' => $data));
    }

    public function add()
    {
        $post = $this->input->post();
        if(!$post) show_404();
        $water_info = $this->_getWaterType($post['type']);
        $data = array(
                'id'          => null,
                'sid'         => $this->_sid,
                'time'        => time(),
                'number'      => $post['number'],
                'prize'       => $post['number'] * $water_info['prize'],
                'watertype'   => $post['type'],
                'status'      => 1,
            );
        $this->waterorder_model->insertOrder($data);
        redirect("student/waterorder/index");
    }


    public function _getWaterType($type)
    {
        $water_info = array();
        if(is_array($this->_water))
        {
            foreach ($this->_water as $key => $value) {
                if($type == $value['id'])
                    $water_info = $value;
            }
        }
        return $water_info;
    }
}