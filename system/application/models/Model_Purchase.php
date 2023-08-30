<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Purchase extends CI_Model

{

    public function get_trim_order()
    {
        $query = "SELECT * from tb_trim_order";
        return $this->db->query($query)->result_array();
    }

    public function get_id_trims($id)
    {
    
        return $this->db->get_where('tb_trim_order',  ['trim_code' => $id])->row_array();
    }

    public function get_id_trims_detil($id)
    {

        $this->db->where('trim_code', $id);
		$this->db->order_by('trim_code');
		$hasil = $this->db->get('v_trimorder_detail');

		return $hasil->result_array();
    }


    public function get_item()
    {
        $query = "SELECT * from v_items";
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

    public function get_id($id)
	{
        return $this->db->get_where('v_trimorder_detail',  ['id_trim' => $id]);
	}



    function save($table,$data){
        $this->db->insert($table, $data);
    }

    
	public function delete_by_id($id)
	{
		$this->db->where('id_item', $id);
		$this->db->delete('tb_items');
	}

    public function update_data($table,$data,$id)
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