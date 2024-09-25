<?php

class MUnit extends CI_Model
{
    function listAll()
    {
        $this->db->order_by('namaunit');
        return $this->db->get('hr_unit');
    }

    function get($id)
    {
        return $this->db->get_where('hr_unit', array('idunit' => $id));
    }

    function save($data)
    {
        $result = false;

        if ($data['idunit'] != '') {
            $this->db->where(array('idunit' => $data['idunit']));
            unset($data['idunit']);
            if ($this->db->update('hr_unit', $data)) {
                $result = true;
            }
        } else {
            $data['idunit'] = $this->generateId();

            if ($this->db->insert('hr_unit', $data)) {
                $result = true;
            }
        }

        return $result;
    }

    function generateId()
    {
        $this->db->select('MAX(idunit) AS latest');
        $find = $this->db->get('hr_unit');
        
        $latest_id = $find->result()[0]->latest;
        $num = (int)str_replace('a', '', $latest_id);

        $new_num = ++$num;
        $new_id = 'a'.str_pad((String)$new_num, 9, '0', STR_PAD_LEFT);

        return $new_id;
    }

    function cekNama($par)
    {
        $find = $this->db->get_where('hr_unit',array('namaunit' => $par));
        return $find;
    }

    function delete($data) {
        $result=false;
        $this->db->where($data);
        if ($this->db->delete('hr_unit')) {
            $result = true;
        }
        return $result;
    }  
}