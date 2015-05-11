<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ACL_Model extends CI_Model {

    /**
    *  根据管理员ID获取用户的用户组
    *
    */
    public function GetUserGroup($masterid) {
        $sql = "SELECT groupmanager.* FROM `mastergroup`, `master`,`groupmanager` 
                WHERE `master`.`id` = `mastergroup`.`masterid` 
                AND `groupmanager`.`groupid`= `mastergroup`.`groupid` 
                AND `master`.`id` = ?";
        $query = $this->db->query($sql, array($masterid));
        return $query->result_array();
    }

    /**
    *  根据管理员ID获取用户的权限
    *
    */
    public function GetUserPermission($masterid) {
        $sql = "SELECT DISTINCT `actionname`,`ag`.`action` FROM `action`,`actiongroup` ag
                WHERE `ag`.`groupid` IN (SELECT `groupid` FROM `mastergroup` WHERE `masterid` = ?)
                AND `action`.`action` = `ag`.`action`
                AND `action`.`viewmodel` = 1";
        $query = $this->db->query($sql, array($masterid));
        return $query->result_array();

    }

    public function GetSiderBar($masterid) {
        $sql = "SELECT DISTINCT  actioncolumnname,uri FROM `action`,`actiongroup` ag, `actioncolumn` ac
                WHERE `ag`.`groupid` IN (SELECT `groupid` FROM `mastergroup` WHERE `masterid` = ?)
                AND `action`.`action` = `ag`.`action`
                AND `action`.`viewmodel` = 1
                AND `action`.`actioncolumnid` = `ac`.`actioncolumnid`";
        $query = $this->db->query($sql, array($masterid));
        return $query->result_array();
    }

    /**
    *  根据用户组来获取权限
    *
    */
    public function GetGroupPermission($groupid) {
        $sql = "SELECT action.*,viewmodel,`actiongroup`.`id`,`actioncolumnname` FROM action,actiongroup,actioncolumn
                WHERE `action`.`action` = `actiongroup`.`action`
                AND `action`.`actioncolumnid` = `actioncolumn`.`actioncolumnid`
                AND `actiongroup`.`groupid` = ?
                AND `viewmodel` = 1
                ORDER BY `actioncolumnid` ASC";
        $query = $this->db->query($sql, array($groupid));
        return $query->result_array();   
    }
    /**
    *  根据用户组来获取未获得的权限
    *
    */
    public function GetGroupPermission2($groupid) {
        $sql = "SELECT action.*,`actioncolumnname` FROM action,actioncolumn
                WHERE `action`.`action` NOT IN (
                    SELECT action FROM actiongroup WHERE groupid = ?)
                AND viewmodel = 1
                AND `action`.`actioncolumnid` = `actioncolumn`.`actioncolumnid`
                ORDER BY `actioncolumnid` ASC";
        $query = $this->db->query($sql, array($groupid));
        return $query->result_array();          
    }


    /**
    *   获得管理员账户的信息列表
    *
    *
    *
    *
    */
    public function GetAllMasterInfo($offset, $perpage) {
        $sql = "SELECT `master`.*, `groupmanager`.`groupname`, `groupmanager`.`groupinfo` 
                FROM `master`
                LEFT JOIN `mastergroup` ON `mastergroup`.`masterid` = `master`.`id`
                LEFT JOIN `groupmanager` ON `groupmanager`.`groupid` = `mastergroup`.`groupid`
                LIMIT {$offset},{$perpage}
                ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function GetMasterInfo($id)
    {
        $sql = "SELECT `master`.*, `groupmanager`.`groupname`, `groupmanager`.`groupinfo` 
                FROM `master`
                LEFT JOIN `mastergroup` ON `mastergroup`.`masterid` = `master`.`id`
                LEFT JOIN `groupmanager` ON `groupmanager`.`groupid` = `mastergroup`.`groupid`
                WHERE `master`.`id` = $id
                ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
    * 获取管理员中的所有用户
    *
    */
    public function GetAllMaster() {
       $query = $this->db->get("master");
       return $query->result_array(); 
    }

    /**
    * 获取管理员中的所有用户
    *
    */
    public function CountAllMaster() {
       return $this->db->count_all_results('master');
    }


    /**
    * 获取管理员中的用户
    *
    */
    public function GetMaster($id) {
       $query = $this->db->get_where("master", array("id"=>$id));
       return $query->result_array(); 
    }

    /**
    * 获取管理员中的用户
    *
    */
    public function AddMaster($data) {
        $this->_InsertIgnore("master", $data);
        return $this->db->affected_rows();
    }

    /**
    * 更新管理员中的用户
    *
    */
    public function UpdateMaster($id,$data) {
        $this->db->where('id',$id);
        $query = $this->db->update('master',$data);
        return $this->db->affected_rows();
    }

    /**
    *  获取所有用户组
    *
    */
    public function GetGroupManager() {
        $query = $this->db->get('groupmanager');
        return $query->result_array();
    }


    /**
    *  获取用户组的成员
    *
    */
    public function GetMasterGroup($groupid) {
        $query = $this->db->get_where('mastergroup', array("groupid"=>$groupid));
        return $query->result_array();
    }
    /**
    *  添加新的用户组
    *
    */
    public function AddGroupManager($data) {
        $this->db->insert('groupmanager', $data);
        return $this->db->affected_rows();
    }

    /**
    *  更新一个用户组
    *
    */
    public function UpdateGroupManager($id, $data) {
        $this->db->where('groupid', $id);
        $this->db->update('groupmanager', $data); 
        return $this->db->affected_rows();
    }

    /**
    *  删除一个用户组
    *
    */
    public function DelGroupManager($id) {
        $this->db->delete('groupmanager', array('groupid' => $id)); 
        return $this->db->affected_rows();
    }


    /**
    *  添加新的权限
    *
    */
    public function AddAction($data) {
        $this->db->insert('action', $data);
        return $this->db->affected_rows();
    }

    /**
    *  更新一个权限
    *
    */
    public function UpdateAction($id, $data) {
        $this->db->where('actionid', $id);
        $this->db->update('action', $data); 
        return $this->db->affected_rows();
    }

    /**
    *  删除一个权限
    *
    */
    public function DelAction($id) {
        $this->db->delete('action', array('id' => $id)); 
        return $this->db->affected_rows();
    }

    /**
    *  添加一个用户和用户组映射
    *
    *
    */
    public function AddMasterGroup($data) {
        $this->_InsertIgnore("mastergroup", $data);
        return $this->db->affected_rows();
    }

    /**
    *  更新一个用户和用户组映射
    *
    *
    */
    public function UpdateMasterGroup($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('mastergroup', $data); 
        return $this->db->affected_rows();
    }

    /**
    *  删除一个用户和用户组映射
    *
    */
    public function DelMasterGroup($id) {
        $this->db->delete('mastergroup', array('id' => $id)); 
        return $this->db->affected_rows();
    }

    /**
    *  删除一个用户组映射
    *
    */
    public function DelMasterGroup2($groupid) {
        $this->db->delete('mastergroup', array('groupid' => $groupid)); 
        return $this->db->affected_rows();
    }    

    /**
    *  删除用户组的用户
    *
    */
    public function DelMasterInGroup($masterid) {
        $this->db->delete('mastergroup', array('masterid' => $masterid)); 
        return $this->db->affected_rows();
    }

    /**
    *  删除一个管理员账户
    *
    *
    *
    */
    public function DelMaster($masterid) {
        $this->db->delete('master', array('id' => $masterid)); 
        return $this->db->affected_rows();
    }

    /**
    *  添加一个权限和用户组映射
    *
    *
    */
    public function AddActionGroup($data) {
        $this->db->insert("actiongroup", $data);
        return $this->db->affected_rows();
    }

    /**
    *  更新一个权限和用户组映射
    *
    *
    */
    public function UpdateActionGroup($groupid, $action, $data) {
        $this->db->where('groupid', $groupid);
        $this->db->where("action", $action);
        $this->db->update('actiongroup', $data); 
        return $this->db->affected_rows();
    }

    /**
    *  删除一个权限和用户组映射
    *
    */
    public function DelActionGroup($id) {
        $flag = $this->db->delete('actiongroup', array('id' => $id)); 
        return $this->db->affected_rows();
    }

    /**
    *  删除一个用户组的权限映射
    *
    */
    public function DelActionGroup2($groupid) {
        $this->db->delete('actiongroup', array('groupid' => $groupid)); 
        return $this->db->affected_rows();
    }    

    protected function _InsertIgnore($table, $data){
        $fields = array();
        $values = array();

        foreach ($data as $key => $val)
        {
            $fields[] = $key;
            $values[] = $this->escape($val);
        }
        $sql = "INSERT IGNORE INTO ".$table." (".implode(', ', $fields).") VALUES (".implode(', ', $values).")";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }

    /**
     * "Smart" Escape String
     *
     * Escapes data based on type
     * Sets boolean and null types
     *
     * @access    public
     * @param    string
     * @return    mixed
     */
    function escape($str)
    {
        if (is_string($str))
        {
            $str = "'".$str."'";
        }
        elseif (is_bool($str))
        {
            $str = ($str === FALSE) ? 0 : 1;
        }
        elseif (is_null($str))
        {
            $str = 'NULL';
        }

        return $str;
    }
}