<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends CI_Controller {
    public $action = null;
    public $leftmenukey;
    public $_masterid;

    public function __construct()
    {
        parent::__construct();
        $this->action = explode(",", $this->session->userdata("action"));
        $this->config->load('pager_config',TRUE);
        $this->_masterid = $this->session->userdata("masterid");
        $this->leftmenukey = '/superadmin/manage/';
    }

    public function Index($page = 1)
    {
        $sidebar_data = $this->acl_model->GetSiderBar($this->_masterid);
        $sidebar_str = $this->load->view("template/sidebar", array("sidebar"=>$sidebar_data), true);

        $perpage = 5;
        $offset = ($page - 1) * $perpage;

        $data = $this->acl_model->GetAllMasterInfo($offset,$perpage);    	
// var_dump($data);
        //分页
        $total = $this->acl_model->CountAllMaster();
        $totalpage = ceil($total / $perpage);

        $this->load->library('pagination');
        $pager_config = $this->config->item('pager_config');
        $pager_config['base_url'] = site_url("superadmin/manage/index");
        $pager_config['total_rows'] = $total;//获取总数
        $pager_config['per_page'] = $perpage; //设置每页显示的条数
        $pager_config['uri_segment'] = 4;
        $this->pagination->initialize($pager_config);
        //END
		$this->load->view("superadmin/manage", array("sidebar"=>$sidebar_str,"data"=>$data));        
    }

    public function edit()
    {
        $id = $this->input->get('id');
        if(!$id) show_404();
        $sidebar_data = $this->acl_model->GetSiderBar($this->_masterid);
        $sidebar_str = $this->load->view("template/sidebar", array("sidebar"=>$sidebar_data), true);

        $data = $this->acl_model->GetMasterInfo($id);
// var_dump($data);
    	$this->load->view('superadmin/editadmininfo', array('data'=>$data,'sidebar'=>$sidebar_str));
    }

    public function update()
    {
    	$data = $this->input->post();
    	if(!$data) show_404();
    	// var_dump($data);exit;
    	$arr = array(
    			'truename' => $data['truename'],
    			'email' => $data['email'],
    			'mobile' => $data['mobile']
    		);
    	$flag = $this->acl_model->UpdateMaster($data['id'], $data);
    	redirect("superadmin/manage/index");
    }

    public function del()
    {
    	$id = $this->input->get('id');
    	if(!$id) show_404();
    	//移除群组
    	$this->acl_model->DelMasterInGroup($id);
    	//删除管理员账户
    	$this->acl_model->DelMaster($id);
    	redirect("superadmin/manage/index");
    }
}
