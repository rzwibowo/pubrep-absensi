<?php 

class MLogin extends CI_Model{	
	function cekLogin($where){
        $find = $this->db->get_where('sys_user_info', $where)->result();
		return $find;
	}	
}