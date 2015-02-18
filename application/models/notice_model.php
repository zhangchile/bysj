<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notice_Model extends CI_Model {

    /**
    *    获取一条通知
    *
    */
    public function GetOneNotice($id) {
        $query = $this->db->get_where("notice", array("id"=>$id));
        return $query->result_array();
    }

    /**
    *    获取某一段通知数据
    *
    */
    public function GetNotice($offset, $perpage) {
        $this->db->order_by("time", "desc");
        $query = $this->db->get('notice', $perpage, $offset);
        return $query->result_array();
    }

    /**
    *   获取通知总数
    *
    */
    public function GetNoticeCount() {
       return $this->db->count_all_results("notice");
    }

    /**
    *    添加一条通知
    *
    */
    public function AddNotice($data) {
        $this->db->insert("notice", $data);
        return $this->db->affected_rows();
    }

    /**
    *    更新一条通知
    *
    */
    public function UpdateNotice($id, $data) {
        $this->db->where('id', $id);
        $this->db->update("notice", $data);
        return $this->db->affected_rows();
    }

    /**
    *    删除一条通知
    *
    */
    public function DelNotice($id) {
        $this->db->where('id', $id);
        $this->db->delete("notice");
        return $this->db->affected_rows();
    }
}