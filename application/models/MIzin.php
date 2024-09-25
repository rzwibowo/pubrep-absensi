<?php

class MIzin extends CI_Model
{
    function list100()
    {
        $this->db->select('ta_daftarijin.fid, nama, namaunit, tglijin, alasan');
        $this->db->join('hr_staff_info', 'hr_staff_info.fid = ta_daftarijin.fid');
        $this->db->join('hr_unit', 'hr_unit.idunit = hr_staff_info.dept_name');
        $this->db->limit(100);
        $this->db->order_by('tglijin desc, fid asc');
        return $this->db->get('ta_daftarijin');
    }

    function search($data)
    {
        $this->db->select('ta_daftarijin.fid, nama, namaunit, tglijin, alasan');
        $this->db->join('hr_staff_info', 'hr_staff_info.fid = ta_daftarijin.fid');
        $this->db->join('hr_unit', 'hr_unit.idunit = hr_staff_info.dept_name');
        $this->db->order_by('fid, tglijin');
        $this->db->where_in('tglijin', $data['tanggals']);
        if (isset($data['nama'])) {
            $this->db->like('nama', $data['nama'], 'both');
            $this->db->or_like('namaunit', $data['nama'], 'both');
        }
        return $this->db->get('ta_daftarijin');
    }

    function sisaCutiByFid($fid)
    {
        $this->db->select('COUNT(fid) AS jumlah_cuti');
        return $this->db->get_where('ta_daftarijin', array('fid' => $fid, 'tahunijin' => date('Y')));
    }

    function save($data)
    {
        $result = false;

        if ($this->db->insert_batch('ta_daftarijin', $data)) {
            $result = true;
        }

        return $result;
    }

    function delete($data)
    {
        $result = false;

        $this->db->where($data);
        if ($this->db->delete('ta_daftarijin')) {
            $result = true;
        }

        return $result;
    }

    function laporanPerUnit($id_unit, $bulan, $tahun)
    {
        $this->db->select('ta_daftarijin.fid, tglijin');
        $this->db->from('ta_daftarijin');
        $this->db->join('hr_staff_info', 'hr_staff_info.fid = ta_daftarijin.fid');
        $this->db->join('hr_unit', 'hr_unit.idunit = hr_staff_info.dept_name');
        $this->db->where('idunit', $id_unit);
        $this->db->like('tglijin', $bulan . '/' . $tahun, 'before');
        $this->db->order_by('fid ASC, tglijin ASC');

        return $this->db->get();
    }

    function laporanPerKaryawan($fid, $bulan, $tahun)
    {
        $this->db->select('fid, tglijin');
        $this->db->from('ta_daftarijin');
        $this->db->where('fid', $fid);
        $this->db->like('tglijin', $bulan . '/' . $tahun, 'before');
        $this->db->order_by('tglijin ASC');

        return $this->db->get();
    }
}
