<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Color extends CI_Model

{
    public function menuID($id)
    {
        return $this->db->get_where('user_menu',  ['id' => $id])->row_array();
    }

    public function get_color()
    {
        $query = "SELECT * from tb_colors";


        return $this->db->query($query)->result_array();
    }


    public function edit_color()
    {
        $data = [
            'color_code' => $this->input->post('color_code'),
            'color' => $this->input->post('color'),
            'remark' => $this->input->post('remark')
        ];

        $this->db->where('id_color', $this->input->post('id_color'));
        $this->db->update('tb_colors', $data);
    }

    public function delete_colors($id)
    {
        $this->db->where('id_color', $id);
        $this->db->delete('tb_colors');
    }















    public function editDataMenu()
    {
        $data = [
            'menu' => $this->input->post('menu'),
            'icon' => $this->input->post('icon')
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_menu', $data);
    }

    public function hapusDataMenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_menu');
    }



    public function getID($id)
    {
        return $this->db->get_where('user_sub_menu',  ['id' => $id])->row_array();
    }

    public function hapussubmenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_sub_menu');
    }

    public function editData()
    {
        $data = [
            'title' => $this->input->post('title'),
            'menu_id' => $this->input->post('menu_id'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => $this->input->post('is_active')
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_sub_menu', $data);
    }
}