<?php
defined('BASEPATH')  or exit('No direct script access allowed');

class Dashboard_model extends CI_model
{
    function all_user()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('is_active', 1);

        return $this->db->get()->num_rows();
    }

    function all_history()
    {
        $this->db->select('*');
        $this->db->from('history_perbaikan');

        return $this->db->get()->num_rows();
    }
}
