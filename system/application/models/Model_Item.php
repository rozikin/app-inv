<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Item extends CI_Model

{

    public function get_item()
    {
        $query = "SELECT * from tb_items";
        return $this->db->query($query)->result_array();
    }

    public function get_size()
    {
        $query = "SELECT * from tb_size";
        return $this->db->query($query)->result_array();
    }
    public function get_color()
    {
        $query = "SELECT * from tb_colors";
        return $this->db->query($query)->result_array();
    }

    public function getID($id)
    {
        return $this->db->get_where('v_items',  ['id_item' => $id])->row_array();
    }

    function save($table, $data)
    {
        $this->db->insert($table, $data);
    }


    public function delete_by_id($id)
    {
        $this->db->where('id_item', $id);
        $this->db->delete('tb_items');
    }

    public function update_data($table, $data, $id)
    {
        $this->db->where('id_item', $id);
        return $this->db->update($table, $data);
    }


    public function get_supplier()
    {
        $query = "SELECT * from tb_supplier";
        return $this->db->query($query)->result_array();
    }
}
