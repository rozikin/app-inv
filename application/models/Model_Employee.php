<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Employee extends CI_Model

{

    public function get_employee()
    {
        $query = "SELECT * from tb_employee Order BY employee_id DESC";
        return $this->db->query($query)->result_array();
    }

    public function get_employee_id()
    {
        $query = "SELECT * from tb_employee Order BY linex DESC";
        return $this->db->query($query)->result_array();
    }

    public function get_employee_byid($id)
    {
        return $this->db->get_where('tb_employee',  ['linex' => $id])->result_array();
    }


    public function get_linex()
    {
        $query = "SELECT DISTINCT linex from tb_employee";
        return $this->db->query($query)->result_array();
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

    public function getID($id)
    {
        return $this->db->get_where('tb_employee',  ['id' => $id])->row_array();
    }

    function save($table, $data)
    {
        $this->db->insert($table, $data);
    }


    public function delete_by_id($id)
    {


        $datax =  $this->db->get_where('tb_employee',  ['id' => $id])->row();
        unlink('./assets/images/employee/' . $datax->remark);

        $this->db->where('id', $id);
        $this->db->delete('tb_employee');
    }



    public function update_data($table, $data, $id)
    {
        $this->db->where('employee_id', $id);
        return $this->db->update($table, $data);
    }


    public function get_supplier()
    {
        $query = "SELECT * from tb_supplier Where id_supplier >0";
        return $this->db->query($query)->result_array();
    }

    function insert($data)
    {
        $this->db->insert_batch('tb_employee', $data);
    }
}