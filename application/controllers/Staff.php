<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Statistik_model', 'statistik');
        $this->load->model('Dashboard_model', 'dashboard');
    }

    public function index()
    {
        $data['title'] = 'Monitoring Bengkel';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        // $data['pengguna'] = $this->statistik->hitungJumlahPengguna();

        $data['slot'] = $this->statistik->hitungJumlahSlotService();

        $data['reservasi'] = $this->statistik->hitungJumlahReservasi();

        $data['history'] = $this->statistik->hitungJumlahHistory();

        $data['allUser'] = $this->statistik->all_user();

        $data['allSlot'] = $this->statistik->all_slot();

        $data['allReservasi'] = $this->statistik->all_reservasi();

        $data['allHistory'] = $this->statistik->all_history();

        $data['totalPendapatan'] = $this->statistik->hitungTotalPendapatan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('staff/monitoring', $data);
        $this->load->view('templates/footer');
    }
}
