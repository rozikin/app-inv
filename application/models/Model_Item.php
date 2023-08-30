<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Item extends CI_Model

{

    public function get_item()
    {
        $query = "SELECT * from v_items where id_item >0 Order BY id_item DESC";
        return $this->db->query($query)->result_array();
    }


    public function get_item_id()
    {
        $query = "SELECT * from v_items where id_item >0 Order BY linex DESC";
        return $this->db->query($query)->result_array();
    }


    public function get_item_byid($id)
    {
        return $this->db->get_where('v_items',  ['linex' => $id])->result_array();
    }


    public function get_unit()
    {
        $query = "SELECT * from tb_unit Where id_unit >0";
        return $this->db->query($query)->result_array();
    }
    public function get_category()
    {
        $query = "SELECT * from tb_category Where id_category >0";
        return $this->db->query($query)->result_array();
    }

    public function get_linex()
    {
        $query = "SELECT DISTINCT linex from tb_items";
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

    function insert($data)
    {
        $this->db->insert_batch('tb_items', $data);
    }

    function get_dataAll_list($limit, $start)
    {
        $this->db->order_by('id_item', 'DESC');
        $query = $this->db->get('tb_items', $limit, $start);
        return $query;
    }


    public function delete_by_id($id)
    {


        $datax =  $this->db->get_where('tb_items',  ['id_item' => $id])->row();
        unlink('./assets/images/item/' . $datax->remark);

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
        $query = "SELECT * from tb_supplier Where id_supplier >0";
        return $this->db->query($query)->result_array();
    }
}
