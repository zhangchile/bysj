<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
    public $action = null;
    public $leftmenukey;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("acl_model");
        $this->action = explode(",", $this->session->userdata("action"));
        $this->leftmenukey = '/superadmin/admin/';
    }

    public function index() {
        // var_dump($this->action);
        $GroupManager = $this->acl_model->GetGroupManager();
        $AllMaster = $this->acl_model->GetAllMaster();
        $sidebar_data = $this->acl_model->GetSiderBar($this->session->userdata("masterid"));
        $sidebar_str = $this->load->view("template/sidebar", array("sidebar"=>$sidebar_data), true);

        foreach ($GroupManager as $key => $value) {
            $mastergroup = $this->acl_model->GetMasterGroup($value['groupid']);
            $GroupManager[$key]["master"] = $mastergroup;
        }
// var_dump($GroupManager);
        $this->load->view('superadmin/admin_index', array("group"=>$GroupManager,"AllMaster"=>$AllMaster,"sidebar"=>$sidebar_str));
    }


    public function add() {
        if(!$this->input->post()) show_404();
        $post = $this->input->post();
        $truename = $this->acl_model->GetMaster($post['masterid']);
        $data = array(
                'id' => 'null',
                "masterid" => $post['masterid'],
                "groupid"  => $post['groupid'],
                "createdate" => time(),
                "name" => $truename[0]['truename'],
                'masterid2' => 'null',
                'mastername' => 'null'
            );
        // var_dump($data);
        $flag = $this->acl_model->AddMasterGroup($data);
        if($flag) {
            redirect('superadmin/admin');
        } else {
            redirect('superadmin/admin/msg_fail');
        }
    }

    public function addmaster() {
        if(!$this->input->post()) show_404();
        $post = $this->input->post();
        $data = array(
                "id" => "null",
                "username" => $post['username'],
                "password" => md5($post['password']),
                "email" => $post["email"],
                "sex" => $post["sex"],
                "truename" => $post["truename"],
                "mobile" => $post["mobile"]
            );
        $flag = $this->acl_model->AddMaster($data);
        if($flag) {
            redirect('superadmin/admin');
        } else {
            redirect('superadmin/admin/msg_fail');
        }
    }


    public function addgroup() {
        if(!$this->input->post()) show_404();
        $post = $this->input->post();
        $data = array(
                "groupid" => null,
                "groupname" => $post['groupname'],
                "groupinfo" => $post['groupinfo'],
                "masterid"  => $this->session->userdata('masterid'),
                "mastername" => $this->session->userdata('truename'),
                "createdate" => time()
            );
        $flag = $this->acl_model->AddGroupManager($data);
        if($flag) {
            redirect('superadmin/admin');
        } else {
            redirect('superadmin/admin/msg_fail');
        }
    }

    public function del($id) {
        $flag = $this->acl_model->DelMasterGroup($id);
        if($flag) {
            redirect('superadmin/admin');
        } else {
            redirect('superadmin/admin/msg_fail');
        }
    }


    public function delgroup($id) {
        //删除用户组
        $flag = $this->acl_model->DelGroupManager($id);
        //删除用户和用户组的映射
        $this->acl_model->DelMasterGroup2($id);
        //删除权限和用户组的映射
        $this->acl_model->DelActionGroup2($id);

        if($flag) {
            redirect('superadmin/admin');
        } else {
            redirect('superadmin/admin/msg_fail');
        }
    }


    public function msg_succ()
    {
        $this->load->view('msg_succ', array("url"=>site_url('superadmin/admin'),"msg"=>'添加成功！'));
    }
    public function msg_fail()
    {
        $this->load->view('msg_fail', array("url"=>site_url('superadmin/admin'),"msg"=>'请勿重复添加！'));
    }
}