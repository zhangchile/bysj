<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

    public $_water;
    public $action;
    public $leftmenukey;

    public function __construct()
    {
        parent::__construct();
        $this->action = explode(",", $this->session->userdata("action"));
        $this->load->model('waterorder_model');
        $this->load->model('water_model');
        $this->load->model('dormitory_model');
        $this->load->library('dormitory');
        $this->config->load('pager_config', TRUE);
        $this->_water = $this->water_model->getall();
        $this->leftmenukey = '/waterservice/';
    }

    public function index($page = 1)
    {
        $perpage = 5;
        $offset = ($page - 1) * $perpage;
        $status = 'all';
        if($this->input->get('status'))
            $status = $this->input->get('status');

        $data = $this->waterorder_model->getorders($offset, $perpage, '', $status);
        $sidebar_data = $this->acl_model->GetSiderBar($this->session->userdata("masterid"));
        foreach ($data as $wkey => $wvalue) {
            foreach ($this->_water as $key => $value) {
                if($wvalue['watertype'] == $value['id'])
                    $data[$wkey]['typename'] = $value['name'];
            }
        }

        //分页
        $total = $this->waterorder_model->getCount();

        $totalpage = ceil($total / $perpage);

        $this->load->library('pagination');
        $pager_config = $this->config->item('pager_config');
        $pager_config['base_url'] = site_url("waterservice/index/index");
        $pager_config['total_rows'] = $total;//获取总数
        $pager_config['per_page'] = $perpage; //设置每页显示的条数
        $pager_config['uri_segment'] = 4;
        $this->pagination->initialize($pager_config);
        //END
        $this->load->view('waterservice/index', array('data' => $data,'sidebar'=>$sidebar_data));
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

    public function updateprize()
    {
        $data = $this->input->post();
        if(!$data) show_404();
        $arr = array(
                'name' => $data['name'],
                'prize' => $data['prize']
            );
        $flag = $this->water_model->update($post['id'], $arr);
        redirect('waterservice/index/');
    }
}