<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Size extends CI_Model

{
    public function menuID($id)
    {
        return $this->db->get_where('user_menu',  ['id' => $id])->row_array();
    }

    public function get_size()
    {
        $query = "SELECT * from tb_size";


        return $this->db->query($query)->result_array();
    }

    public function delete_sizes($id)
    {
        $this->db->where('id_size', $id);
        $this->db->delete('tb_size');
    }







    
    public function get_supplier()
    {
        $query = "SELECT * from tb_supplier";
        return $this->db->query($query)->result_array();
    }

 
    public function getID($id)
    {
        return $this->db->get_where('tb_items',  ['id_item' => $id])->row_array();
    }


    public function edit_size()
    {
        $data = [
            'size_code' => $this->input->post('size_code'),
            'size_description' => $this->input->post('size_description')
        ];

        $this->db->where('id_size', $this->input->post('id_size'));
        $this->db->update('tb_size', $data);
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