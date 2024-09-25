<?php

class MUser extends CI_Model
{
    function listAll()
    {
        $this->db->select('id, user_name, namaunit');
        $this->db->join('hr_unit', 'hr_unit.idunit = sys_user_info.deptakses', 'left');
        return $this->db->get('sys_user_info');
    }

    function get($id)
    {
        return $this->db->get_where('sys_user_info', array('id' => $id));
    }

    function save($data)
    {
        if ($data['id'] != '') {
            $this->db->where(array('id' => $data['id']));
            unset($data['id']);
            if ($this->db->update('sys_user_info', $data)) {
                $result = true;
            }
        } else {
            if ($this->db->insert('sys_user_info', $data)) {
                $result = true;
            }
        }

        return $result;
    }

    function cekNama($par)
    {
        $find = $this->db->get_where('sys_user_info',array('user_name' => $par));
        return $find;
    }

    function delete($data) {
        $result=false;
        $this->db->where($data);
        if ($this->db->delete('sys_user_info')) {
            $result = true;
        }
        return $result;
    } 
}
