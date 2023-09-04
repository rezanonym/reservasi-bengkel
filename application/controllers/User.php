<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_model', 'users');
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit_profile()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit_profile', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            // cek jika ada gambar yang akan di upload
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profil kamu sudah diperbarui!</div>');
            redirect('user');
        }
    }


    public function changePassword()
    {
        $data['title'] = 'Ganti Password';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('currentPassword', 'Password saat ini', 'required|trim');
        $this->form_validation->set_rules('newPassword1', 'Password baru', 'required|trim|min_length[6]|matches[newPassword2]');
        $this->form_validation->set_rules('newPassword2', 'Konfirmasi Password baru', 'required|trim|min_length[6]|matches[newPassword1]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('currentPassword');
            $new_password = $this->input->post('newPassword1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password yang anda masukkan tidak sama dengan di database!</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password baru tidak boleh sama dengan password saat ini!</div>');
                    redirect('user/changepassword');
                } else {
                    //password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil diubah!</div>');
                    redirect('user/changepassword');
                }
            }
        }
    }

    public function slot_bengkel()
    {

        $data['title'] = 'Ketersediaan Slot Bengkel';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        // mengambil data dari session

        // config
        $config['base_url'] = 'http://localhost/reservasi-bengkel/user/slot_bengkel';
        $config['total_rows'] = $this->users->countAllSlot();
        $config['per_page'] = 5;
        $config['num_links'] = 3;

        // styling
        $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'Awal';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Akhir';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');

        // initialize
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['getSlotBengkel'] = $this->users->getSlotBengkel($config['per_page'], $data['start']);
        $data['reservasi'] = $this->users->getReservasi();
        // $data['getBatal'] = $this->users->batalReservasiBengkel();
        $role_id = $this->session->userdata('role_id');

        if ($role_id == 2) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/slot_bengkel', $data);
            $this->load->view('templates/footer');
        } else {
            $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
            $this->form_validation->set_rules('waktu_mulai', 'Waktu Mulai', 'required');
            $this->form_validation->set_rules('waktu_selesai', 'Waktu Selesai', 'required');
            $this->form_validation->set_rules('jenis_pelayanan', 'Jenis Pelayanan', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('admin/slot_bengkel', $data);
                $this->load->view('templates/footer');
            } else {
                $data = [
                    'tanggal' => $this->input->post('tanggal'),
                    'waktu_mulai' => $this->input->post('waktu_mulai'),
                    'waktu_selesai' => $this->input->post('waktu_selesai'),
                    'jenis_pelayanan' => $this->input->post('jenis_pelayanan'),
                    'is_ready' => $this->input->post('is_ready')
                ];
                $this->db->insert('service_slot', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Slot Bengkel telah dibuat!</div>');
                redirect('user/slot_bengkel');
            }
        }
    }

    public function pesanReservasi()
    {
        $user_id = $this->session->userdata('id');

        // input data tabel reservasi
        $data = array(
            'user_id' => $user_id,
            'slot_id' => $this->input->post('slot_id')
        );
        // $this->db->insert('reservasi',);
        $this->users->pesanReservasiBengkel($id);
        $this->users->insertReservasi($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Reservasi berhasil dibuat!</div>');
        redirect('user/slot_bengkel');
    }

    public function batalkanReservasi()
    {
        $this->users->batalReservasiBengkel($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reservasi dibatalkan!</div>');
        redirect('user/slot_bengkel');
    }

    public function editSlotBengkel()
    {
        $this->users->editSlotBengkel($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Ketersediaan Slot Bengkel berhasil diubah!</div>');
        redirect('user/slot_bengkel');
    }

    public function hapusSlotBengkel($id)
    {
        $this->users->hapusDataSlotBengkel($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Slot bengkel berhasil dihapus!</div>');
        redirect('user/slot_bengkel');
    }

    public function selesaiPerbaikan()
    {
        $this->form_validation->set_rules('deskripsi_motor', 'Deskripsi Motor', 'required');
        $this->form_validation->set_rules('biaya', 'Biaya', 'required');
        $this->form_validation->set_rules('catatan', 'Catatan', 'required');

        if ($this->form_validation->run() == FALSE) {
            base_url('user/slot_bengkel');
        } else {
            $data = [
                'tanggal' => $this->input->post('tanggal'),
                'reservasi_id' => $this->input->post('reservasi_id'),
                'waktu_mulai' => $this->input->post('waktu_mulai'),
                'waktu_selesai' => $this->input->post('waktu_selesai'),
                'jenis_pelayanan' => $this->input->post('jenis_pelayanan'),
                'deskripsi_motor' => $this->input->post('deskripsi_motor'),
                'biaya' => $this->input->post('biaya'),
                'catatan' => $this->input->post('catatan')
            ];
            $this->db->insert('history_perbaikan', $data);
        }

        $this->users->selesaiServis($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Perbaikan sudah selesai!</div>');
        redirect('user/slot_bengkel');
    }

    public function history()
    {
        $data['title'] = 'Catatan Perbaikan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $role_id = $this->session->userdata('role_id');

        // config
        $config['base_url'] = 'http://localhost/reservasi-bengkel/user/history';
        $config['total_rows'] = $this->users->countAllHistory();
        $config['per_page'] = 5;
        $config['num_links'] = 3;

        // styling
        $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'Awal';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Akhir';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');

        // initialize
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['getHistoryPerbaikan'] = $this->users->getHistoryPerbaikan($config['per_page'], $data['start']);
        $data['reservasi'] = $this->users->getReservasi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/history', $data);
        $this->load->view('templates/footer');
    }
}
