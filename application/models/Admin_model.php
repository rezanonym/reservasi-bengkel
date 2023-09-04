<?php
defined('BASEPATH')  or exit('No direct script access allowed');

class Admin_model extends CI_model
{
    public function hapusDataRole($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_role');
    }
}
