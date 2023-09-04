<?php
defined('BASEPATH')  or exit('No direct script access allowed');

class User_model extends CI_model
{
    function all_user()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('is_active', 1);

        return $this->db->get()->num_rows();
    }

    public function countAllSlot()
    {
        return $this->db->get('service_slot')->num_rows();
    }

    public function countAllHistory()
    {
        return $this->db->get('history_perbaikan')->num_rows();
    }

    public function getHistoryPerbaikan($limit, $start)
    {
        $this->db->select('hp.*');
        $this->db->from('history_perbaikan AS hp');
        $this->db->join('reservasi AS r', 'hp.reservasi_id = r.id', 'LEFT');
        $this->db->order_by('hp.tanggal', 'ASC');
        $this->db->limit($limit, $start);
        return $this->db->get()->result_array();

        return $this->db->get('service_slot')->result_array();
    }

    public function getSlotBengkel($limit, $start)
    {
        $this->db->select('ss.*, r.user_id as user_id, r.id as reservasi_id');
        $this->db->from('reservasi AS r');
        $this->db->join('service_slot AS ss', 'r.slot_id = ss.id', 'RIGHT');
        $this->db->join('`user` AS u', 'r.user_id = u.id', 'LEFT');
        $this->db->order_by('ss.tanggal', 'ASC');
        $this->db->limit($limit, $start);
        return $this->db->get()->result_array();

        // return $this->db->get('service_slot')->result_array();
    }

    public function getReservasi()
    {
        $this->db->select('*');
        $this->db->from('reservasi');

        return $this->db->get()->result_array();
    }

    public function editSlotBengkel($id)
    {
        $id = $this->input->post('id');
        $tanggal = $this->input->post('tanggal');
        $waktu_mulai = $this->input->post('waktu_mulai');
        $waktu_selesai = $this->input->post('waktu_selesai');
        $jenis_pelayanan = $this->input->post('jenis_pelayanan');
        $is_ready = $this->input->post('is_ready');

        $data = array(
            'tanggal' => $tanggal,
            'waktu_mulai' => $waktu_mulai,
            'waktu_selesai' => $waktu_selesai,
            'jenis_pelayanan' => $jenis_pelayanan,
            'is_ready' => $is_ready
        );

        $this->db->where('id', $id);
        $this->db->update('service_slot', $data);
    }

    public function pesanReservasiBengkel($id)
    {
        // input data tabel service_slot
        $id = $this->input->post('id');
        $is_ready = $this->input->post('is_ready');

        $service_slot = array(
            'is_ready' => $is_ready
        );

        $this->db->where('id', $id);
        $this->db->update('service_slot', $service_slot);
    }

    public function batalReservasiBengkel($id)
    {
        // input data tabel service_slot
        $id = $this->input->post('id');
        $is_ready = $this->input->post('is_ready');

        $service_slot = array(
            'is_ready' => $is_ready
        );

        $this->db->where('id', $id);
        $this->db->update('service_slot', $service_slot);
        $this->db->where('slot_id', $id);
        $this->db->delete('reservasi');
    }

    public function insertReservasi($data)
    {
        $this->db->insert('reservasi', $data);
    }

    public function selesaiServis($id)
    {
        $id = $this->input->post('id');
        $is_ready = $this->input->post('is_ready');

        $data = array(
            'is_ready' => $is_ready
        );

        $this->db->where('id', $id);
        $this->db->update('service_slot', $data);
    }

    public function hapusDataSlotBengkel($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('service_slot');
    }
}
