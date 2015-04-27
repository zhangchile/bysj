<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model("acl_model");
        $this->load->model('notice_model');
        $this->config->load('pager_config',TRUE);
        $this->load->model("login_model");
        $this->load->library('dormitory');
    }

    public function index($page = 1)
    {
        if($this->session->userdata('is_login') == true) {
            //跳转
            redirect('index');
        }
        $error = $this->input->get("error") ? true : false;
        $perpage = 5;
        $offset = ($page - 1) * $perpage;        
        $notice = $this->notice_model->GetNotice($offset,$perpage);
        //分页
        $total = $this->notice_model->GetNoticeCount();
        $totalpage = ceil($total / $perpage);

        $this->load->library('pagination');
        $pager_config = $this->config->item('pager_config');
        $pager_config['base_url'] = site_url("login/index");
        $pager_config['total_rows'] = $total;//获取总数
        $pager_config['per_page'] = $perpage; //设置每页显示的条数
        $this->pagination->initialize($pager_config); 
        //END
        $this->load->view('login', array('error' => $error,"notice"=>$notice));
    }

    public function check($page = 1)
    {
        if(!$this->input->post()) show_404();
        $uid = $this->input->post('uid');
        $pwd = $this->input->post('pwd');
        $is_admin = $this->input->post('type');
        //管理员验证
        if($is_admin == "admin") {
            $flag = $this->login_model->admin_check($uid, $pwd);
            if(is_array($flag) && !empty($flag))
            {
                //获取用户组
                $group = $this->acl_model->GetUserGroup($flag[0]['id']);
                //获取用户的权限
                $action = $this->acl_model->GetUserPermission($flag[0]['id']);
                $action_arr = array();
                foreach ($action as $key => $value) {
                    array_push($action_arr, $value['action']);
                }
                $arr = array(
                    'masterid'  => $flag[0]['id'],
                    'truename'  => $flag[0]['truename'],
                    'is_login'  => true,
                    'identity'  => "superadmin",
                    'groupid'   => empty($group[0]['groupid']) ? null : $group[0]['groupid'],
                    'groupname' => empty($group[0]['groupname']) ? null : $group[0]['groupname'],
                    'action'    => implode(",", $action_arr)
                    );
                $this->session->set_userdata($arr);//设置session
                redirect('index');
            }  else {
                redirect("login/index/1?error=true");
            }
        } else {
            //学生登录
            $flag = $this->login_model->student_check($uid, $pwd);
            if(is_array($flag) && !empty($flag))
            {
                $arr = array(
                        'id'         => $flag[0]['id'],
                        'sid'        => $flag[0]['sid'],
                        'truename'   => $this->dormitory->TransformID($flag[0]['sid']),
                        'type'       => $flag[0]['type'],
                        'department' => $flag[0]['department'],
                        'identity'  => 'student',
                        'is_login'   => true,
                    );
                $this->session->set_userdata($arr);//设置session
                redirect('student/index');
            } else {
                redirect("login/index/1?error=true");
            }

        }

    }
    
    public function logout()
    {
        if($this->session->userdata('masterid'))
        {
            $array_items = array(
                        'masterid'  => '', 
                        'truename'  => '', 
                        'is_login'  => '',
                        'identity'  => '',
                        'groupid'   => '',
                        'groupname' => ''
                    );
            $this->session->unset_userdata($array_items);
            redirect('login');
        } else {
            $arr = array(
                    'id'         => '',
                    'sid'        => '',
                    'truename'   => '',
                    'type'       => '',
                    'department' => '',
                    'is_login'   => '',
                );
            $this->session->unset_userdata($array_items);
            redirect('login');
        }
    }
}