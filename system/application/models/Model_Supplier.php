<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Supplier extends CI_Model

{
    
    public function get_supplier()
    {
        $query = "SELECT * from tb_supplier";
        return $this->db->query($query)->result_array();
    }

    public function delete_by_id($id)
	{
		$this->db->where('id_supplier', $id);
		$this->db->delete('tb_supplier');
	}

    public function delete_suppliers($id)
    {
        $this->db->where('id_supplier', $id);
        $this->db->delete('tb_supplier');
    }

    public function getID($id)
    {
        return $this->db->get_where('tb_supplier',  ['id_supplier' => $id])->row_array();
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