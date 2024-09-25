<?php

class MShift extends CI_Model
{
    function listAll()
    {
        $this->db->select('ta_timetable.id, ta_shift.id AS id_shift, nama_jadwal, nama_shift, jam_masuk, jam_keluar');
        $this->db->join('ta_shift', 'ta_timetable.jadwal1 = ta_shift.id');
        return $this->db->get('ta_timetable');
    }

    function get($id)
    {
        $this->db->select('ta_timetable.id, ta_shift.id AS id_shift, nama_jadwal, 
            nama_shift, jam_masuk, jam_keluar, chk_besok');
        $this->db->join('ta_shift', 'ta_timetable.jadwal1 = ta_shift.id');
        return $this->db->get_where('ta_timetable', array('ta_timetable.id' => $id));
    }

    function save($data)
    {
        $result = false;

        $data_shift = array('nama_jadwal' => $data['nama_jadwal']);
        $data_jadwal = array(
            'nama_shift' => $data['nama_shift'], 
            'jam_masuk' => $data['jam_masuk'],
            'jam_keluar' => $data['jam_keluar'],
            'chk_besok' => $data['chk_besok']
        );

        $this->db->trans_start();

        if ($data['id'] != '') {
            $this->db->where(array('id' => $data['id']));
            $this->db->update('ta_timetable', $data_shift);
            
            $this->db->where(array('id' => $data['id_shift']));
            $this->db->update('ta_shift', $data_jadwal);
        } else {
            $this->db->insert('ta_shift', $data_jadwal);
            
            $data_shift['jadwal1'] = $this->db->insert_id();
            $this->db->insert('ta_timetable', $data_shift);
        }
        
        $this->db->trans_complete();

        if ($this->db->trans_status()) {
            $result = true;
        }

        return $result;
    }

    function delete($data) {
        $result=false;

        $this->db->trans_start();

        $this->db->where(array('id' => $data['id']));
        $this->db->delete('ta_timetable');

        $this->db->where(array('id' => $data['id_shift']));
        $this->db->delete('ta_shift');

        $this->db->trans_complete();

        if ($this->db->trans_status()) {
            $result = true;
        }
        
        return $result;
    } 
}
