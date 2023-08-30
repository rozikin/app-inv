<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Trimsorder extends CI_Model

{

    function buat_kode()
    {
        $this->db->select('RIGHT(tb_trim_order.id_trim,10) as kode', FALSE);
        $this->db->order_by('kode', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_trim_order');      //cek dulu apakah ada sudah ada kode di tabel.    
        if ($query->num_rows() <> 0) {
            //jika kode ternyata sudah ada.      
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            //jika kode belum ada      
            $kode = 1;
        }
        $tgl = date('Y');
        $kodemax = str_pad($kode, 0, "0", STR_PAD_LEFT);
        $kodejadi = $kodemax;
        return $kodejadi;
    }

    public function get_trim_order()
    {
        $query = "SELECT * from tb_trim_order";
        return $this->db->query($query)->result_array();
    }

    public function get_id_trims($id)
    {

        return $this->db->get_where('tb_trim_order',  ['id_trim' => $id])->row_array();
    }

    public function get_id_trims_detil($id)
    {

        $this->db->where('id_trim', $id);
        $this->db->order_by('id_trim');
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
    public function get_colorx()
    {
        $query =  $this->db->query("SELECT * FROM tb_colors");

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
        } else {
            $result = "";
            // or anything you can use as error handler
            return $result;
        }
    }

    public function get_id($id)
    {
        return $this->db->get_where('v_trimorder_detail',  ['id_trim' => $id]);
    }

    function save($table, $data)
    {
        $this->db->insert($table, $data);
    }

    public function delete_by_id($id)
    {
        $this->db->where('id_trim', $id);
        $this->db->delete('tb_trim_order');
    }

    public function delete_detail_id($id)
    {
        $this->db->where('id_trim', $id);
        $this->db->delete('tb_trim_detail');
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
