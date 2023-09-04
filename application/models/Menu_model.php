<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getAllMenu()
    {
        return $this->db->get('user_menu')->result_array();
    }

    public function editMenu($id)
    {
        $id = $this->input->post('id');
        $menu = $this->input->post('menu');

        $data = array(
            'menu' => $menu,
        );

        $this->db->where('id', $id);
        $this->db->update('user_menu', $data);
    }

    public function hapusDataMenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_menu');
    }

    public function getAllSubMenu()
    {
        $query = "SELECT `user_menu`.`id`, `user_menu`.`menu`, `user_sub_menu`.`menu_id`
                    FROM `user_sub_menu`  JOIN `user_menu`
                    ON `user_menu`.`id` = `user_sub_menu`.`menu_id`
                    ORDER BY `menu` ASC
                    ";
        return $this->db->query($query)->result_array();
    }

    public function getSubMenu($limit, $start)
    {
        // return $this->db->get('user_sub_menu', $limit, $start)->result_array();

        $this->db->select('usm.*', 'um.id AS id_menu', 'um.menu');
        $this->db->from('user_sub_menu AS usm, user_menu AS um');
        $this->db->where('usm.menu_id = um.id');
        $this->db->order_by('menu', 'asc');
        $this->db->limit($limit, $start);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function countAllSubMenu()
    {
        return $this->db->get('user_sub_menu')->num_rows();
    }

    public function editSubMenu($id)
    {

        $id = $this->input->post('id');
        $menu_id = $this->input->post('menu_id');
        $title = $this->input->post('title');
        $url = $this->input->post('url');
        $icon = $this->input->post('icon');
        $is_active = $this->input->post('is_active');

        $data = array(
            'menu_id'   => $menu_id,
            'title'     => $title,
            'url'       => $url,
            'icon'      => $icon,
            'is_active' => $is_active
        );

        $this->db->where('id', $id);
        $this->db->update('user_sub_menu', $data);
    }

    public function hapusDataSubMenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_sub_menu');
    }
}
