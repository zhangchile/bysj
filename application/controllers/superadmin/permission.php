<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permission extends CI_Controller {
    public $action = null;     
    public $leftmenukey;
    public function __construct()
    {
        parent::__construct();
        $this->load->model("acl_model");
        $this->action = explode(",", $this->session->userdata("action"));
        $this->leftmenukey = '/superadmin/permission/';
    }

    public function index() {
        $GroupManager = $this->acl_model->GetGroupManager();
        $sidebar_data = $this->acl_model->GetSiderBar($this->session->userdata("masterid"));
        $sidebar_str = $this->load->view("template/sidebar", array("sidebar"=>$sidebar_data), true);

        foreach ($GroupManager as $key => $value) {
            $mastergroup = $this->acl_model->GetGroupPermission($value['groupid']);
            $GroupManager[$key]["permission"] = $mastergroup;
            //获取还未有的权限
            $unget_permission = $this->acl_model->GetGroupPermission2($value['groupid']);
            $GroupManager[$key]["unget_permission"] = $unget_permission;
        }

        $this->load->view('superadmin/permission',array("group"=>$GroupManager,"sidebar"=>$sidebar_str));
    }

    public function add() {
        if(!$this->input->post()) show_404();
        $post = $this->input->post();
        // var_dump($post);exit;
        $data = array(
            "groupid" => $post['groupid'],
            "action"  => $post['action'],
            "masterid"=>$this->session->userdata('masterid'),
            "mastername" => $this->session->userdata('truename'),
            "createdate" => time()
            );
        $this->acl_model->AddActionGroup($data);
        redirect('superadmin/permission');
    }

    public function del($id) {
        $flag = $this->acl_model->DelActionGroup($id);
        redirect('superadmin/permission');
    }


    public function msg_succ()
    {
        $this->load->view('msg_succ', array("url"=>site_url('admin'),"msg"=>'添加成功！'));
    }
    public function msg_fail()
    {
        $this->load->view('msg_fail', array("url"=>site_url('admin'),"msg"=>'请勿重复添加！'));
    }
}