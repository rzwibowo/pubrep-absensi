<?php

class MJadwal extends CI_Model
{
    // function listAll()
    // {
    //     $this->db->select('fid, nama, nik, jabatan, namaunit, tgl_masuk');
    //     $this->db->join('hr_unit', 'hr_unit.idunit = hr_staff_info.dept_name');
    //     return $this->db->get('hr_staff_info');
    // }
    function listByUnit($id_unit, $bulan, $tahun)
    {
        $this->db->select('hr_staff_info.fid, nojadwal, nama_jadwal, tanggal, jam_masuk, jam_keluar');
        $this->db->from('ta_jadwal_staffx');
        $this->db->join('ta_timetable', 'ta_timetable.id = ta_jadwal_staffx.nojadwal');
        $this->db->join('ta_shift', 'ta_timetable.jadwal1 = ta_shift.id');
        $this->db->join('hr_staff_info', 'hr_staff_info.fid = ta_jadwal_staffx.fid');
        $this->db->like('tanggal', $bulan . '/' . $tahun, 'before');
        $this->db->where(array('dept_name' => $id_unit));
        $this->db->order_by('hr_staff_info.fid ASC, tanggal ASC');

        return $this->db->get();
    }

    function listByKaryawan($fid, $bulan, $tahun)
    {
        $this->db->select('fid, nojadwal, nama_jadwal, tanggal, jam_masuk, jam_keluar');
        $this->db->from('ta_jadwal_staffx');
        $this->db->join('ta_timetable', 'ta_timetable.id = ta_jadwal_staffx.nojadwal');
        $this->db->join('ta_shift', 'ta_timetable.jadwal1 = ta_shift.id');
        $this->db->like('tanggal', $bulan . '/' . $tahun, 'before');
        $this->db->where(array('fid' => $fid));
        $this->db->order_by('tanggal ASC');

        return $this->db->get();
    }

    function save($data)
    {
        $result = false;

        $this->db->trans_start();

        $this->db->where_in('tanggal', $data['tgl_to_delete']);
        $this->db->where_in('fid', $data['fid_to_delete']);
        $this->db->delete('ta_jadwal_staffx');

        $this->db->insert_batch('ta_jadwal_staffx', $data['jadwal_to_insert']);

        $this->db->trans_complete();

        if ($this->db->trans_status()) {
            $result = true;
        }
        
        return $result;
    }

    function laporanPerUnit($id_unit, $bulan, $tahun)
    {
        $this->db->select('fid');
        $karyawan = $this->db->get_where('hr_staff_info', array('dept_name' => $id_unit));
        $fid_dep = [];

        foreach ($karyawan->result() as $k ) {
            array_push($fid_dep, $k->fid);
        }

        $this->db->select('fid, tanggal_log, MIN(jam_log) AS jam_log');
        $this->db->from('ta_log');
        $this->db->like('tanggal_log', $bulan . '/' . $tahun, 'before');
        $this->db->where_in('fid', $fid_dep);
        $this->db->group_by('fid, tanggal_log');
        $this->db->order_by('fid ASC, tanggal_log ASC');

        return $this->db->get();
    }

    function laporanPerKaryawan($fid, $bulan, $tahun)
    {
        $this->db->select('fid, tanggal_log, MIN(jam_log) AS jam_log');
        $this->db->from('ta_log');
        $this->db->like('tanggal_log', $bulan . '/' . $tahun, 'before');
        $this->db->where('fid', $fid);
        $this->db->group_by('tanggal_log');
        $this->db->order_by('tanggal_log ASC');

        return $this->db->get();
    }
}
