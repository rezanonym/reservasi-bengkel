<?php
defined('BASEPATH')  or exit('No direct script access allowed');

class Statistik_model extends CI_model
{
    public function hitungJumlahPengguna()
    {
        $this->db->where('role_id', 2);
        return $this->db->count_all('user');
    }

    public function hitungJumlahSlotService()
    {
        return $this->db->count_all('service_slot');
    }

    public function hitungJumlahReservasi()
    {
        return $this->db->count_all('reservasi');
    }

    public function hitungJumlahHistory()
    {
        return $this->db->count_all('history_perbaikan');
    }

    function all_user()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('role_id', 2);

        return $this->db->get()->num_rows();
    }

    function all_slot()
    {
        return $this->db->count_all('service_slot');
    }

    function all_reservasi()
    {
        return $this->db->count_all('reservasi');
    }

    function all_history()
    {
        $this->db->select('*');
        $this->db->from('history_perbaikan');

        return $this->db->get()->num_rows();
    }

    function hitungTotalPendapatan()
    {
        $query = $this->db->select_sum('biaya')->get('history_perbaikan');
        $result = $query->row();

        return $result->biaya;
    }
}
