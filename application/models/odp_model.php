<?php
class odp_model extends ci_model
{


    function data()
    {
        $this->db->order_by('id_odp', 'DESC');
        return $query = $this->db->get('odp');
    }


    public function ambilId($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    public function hapus_data($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return false;
    }


    public function detail_data($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function tambah_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function ubah_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }


    public function buat_kode()
    {
        $this->db->select('RIGHT(odp.id_odp,4) as kode', FALSE);
        $this->db->order_by('id_odp', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('odp');      //cek dulu apakah ada sudah ada kode di tabel.
        if ($query->num_rows() <> 0) {
            //jika kode ternyata sudah ada.
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            //jika kode belum ada
            $kode = 1;
        }
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
        $kodejadi = "SPLY-" . $kodemax;
        return $kodejadi;
    }
}
