<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WaterOrder extends CI_Controller {

    public $_sid;
    public $_water;
    public $_water_left;

    public function __construct()
    {
        parent::__construct();
        $this->_sid = $this->session->userdata('sid');
        $this->load->model('waterorder_model');
        $this->load->model('water_model');
        $this->load->model('dormitory_model');
        $this->config->load('pager_config', TRUE);
        $this->_water = $this->water_model->getall();
        $this->_water_left = $this->dormitory_model->getWaterLeft($this->_sid);
    }

    public function index($page = 1)
    {
        $perpage = 5;
        $offset = ($page - 1) * $perpage;
        $data = $this->waterorder_model->getorders($offset, $perpage, $this->_sid, 'all');

        foreach ($data as $wkey => $wvalue) {
            foreach ($this->_water as $key => $value) {
                if($wvalue['watertype'] == $value['id'])
                    $data[$wkey]['typename'] = $value['name'];
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
    	$this->load->view('student/waterorder', array('data' => $data,'waterleft'=>$this->_water_left));
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
                'billid'      => '',
            );
        $id = $this->waterorder_model->insertOrder($data);
        redirect("student/waterorder/pay/".$id);
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

    public function pay($id = '')
    {
        $post = $this->input->post();
        if($post) {
            $data = array(
                    'billid' => $post['billid'],
                    'status' => 2
                    );
            $flag = $this->waterorder_model->update($post['id'], $data);
            redirect('student/waterorder/');
        } else {

            if(!$id) show_404();
            $data = $this->waterorder_model->getOneOrder($id, $this->_sid);
            if(is_array($data)) {
                $water_info = $this->_getWaterType($data[0]['watertype']);
                $data[0]['typename'] = $water_info['name'];
            }
 
            $this->load->view('student/water_pay', array('data'=>$data));
            
        }
    }
}