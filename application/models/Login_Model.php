<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_Model extends CI_Model {
    public function admin_check($uid, $pwd)//验证用户是否存在
    {
        $query = $this->db->get_where('master', array('username' => $uid, 'password' => md5($pwd)));
        return $query->result_array();
    }
}