<?php

class MKaryawan extends CI_Model
{
    function listAll()
    {
        $this->db->select('fid, nama, nik, jabatan, namaunit, tgl_masuk');
        $this->db->join('hr_unit', 'hr_unit.idunit = hr_staff_info.dept_name', 'left');
        return $this->db->get('hr_staff_info');
    }

    function get($fid)
    {
        return $this->db->get_where('hr_staff_info', array('fid' => $fid));
    }

    function search($data)
    {
        $this->db->select('fid, nama, namaunit');
        $this->db->join('hr_unit', 'hr_unit.idunit = hr_staff_info.dept_name', 'left');
        $this->db->like('nama', $data['cari'], 'both');
        return $this->db->get('hr_staff_info');
    }

    function listByUnit($unit_id)
    {
        return $this->db->get_where('hr_staff_info', array('dept_name' => $unit_id));
    }

    function save($data)
    {
        $result = false;

        $find = $this->get($data['fid']);

        if (sizeof($find->result()) > 0) {
            $this->db->where(array('fid' => $data['fid']));
            unset($data['fid']);
            if ($this->db->update('hr_staff_info', $data)) {
                $result = true;
            }
        } else {
            if ($this->db->insert('hr_staff_info', $data)) {
                $result = true;
            }
        }

        return $result;
    }

    function delete($data)
    {
        $result = false;
        $this->db->where($data);
        if ($this->db->delete('hr_staff_info')) {
            $result = true;
        }
        return $result;
    }
}
