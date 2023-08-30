<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Purchase extends CI_Model

{
    function buat_kode()
    {
        $this->db->select('RIGHT(tb_purchase_order.id_po,10) as kode', FALSE);
        $this->db->order_by('kode', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_purchase_order');      //cek dulu apakah ada sudah ada kode di tabel.    
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
    function buat_kode_po()
    {
        $this->db->select('RIGHT(tb_purchase_order.po_no,10) as kode', FALSE);
        $this->db->order_by('kode', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_purchase_order');      //cek dulu apakah ada sudah ada kode di tabel.    
        if ($query->num_rows() <> 0) {
            //jika kode ternyata sudah ada.      
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            //jika kode belum ada      
            $kode = 1;
        }
        $tgl = date('Y');
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodejadi = 'TIMW/' . $kodemax . '/PO/' . $tgl;
        return $kodejadi;
    }

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

    public function get_item_id($id, $id_supplier)
    {

        $query =  $this->db->query('SELECT * FROM v_trimorder_detail WHERE id_trim = ' . $id . ' && id_supplier=' . $id_supplier . '');

        $hasil = $query;

        return $hasil->result_array();
    }

    public function get_item()
    {
        $query = "SELECT * from v_items";
        return $this->db->query($query)->result_array();
    }
    public function get_items()
    {
        $query = "SELECT * from v_trimorder_detail";
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
        return $this->db->get_where('v_trimorder_fix',  ['id_trim' => $id]);
    }

    public function get_detil_id($id)
    {
        return $this->db->get_where('v_trimorder_detail',  ['id_trim' => $id]);
    }

    public function get_detil_purchase($id)
    {
        return $this->db->get_where('v_purchase_order_detail',  ['id_po' => $id]);
    }
    public function get_detil_itemtrim($id)
    {
        return $this->db->get_where('v_trimorder_detail',  ['id_trim' => $id])->result_array();
    }


    public function get_detil_itemtrim_po()
    {
        return $this->db->get('v_items')->result_array();
    }
    public function get_detil_itemtrimx($id)
    {
        return $this->db->get_where('v_purchase_order_detail',  ['id_po' => $id])->result_array();
    }


    public function get_id_trim($id)
    {
        return $this->db->get_where('v_trimorder_fix',  ['id_trim' => $id])->row_array();
    }

    public function get_id_po($id)
    {
        return $this->db->get_where('v_purchase_manage',  ['id_po' => $id])->row_array();
    }

    public function get_pdf_po($id)
    {
        return $this->db->get_where('v_purchase_manage',  ['id_po' => $id])->result();
    }

    public function get_piw_po($id)
    {
        return $this->db->get_where('v_purchase_manage',  ['id_po' => $id])->row();
    }



    public function get_detil_po($id)
    {
        return $this->db->get_where('v_purchase_order_detail',  ['id_po' => $id])->result_array();
    }



    function save($table, $data)
    {
        $this->db->insert($table, $data);
    }


    public function delete_by_id($id)
    {
        $this->db->where('id_po', $id);
        $this->db->delete('tb_purchase_order');
    }
    public function delete_purchasedetil_id($id)
    {
        $this->db->where('id_po', $id);
        $this->db->delete('tb_purchase_order_detail');
    }

    public function update_data($table, $data, $id)
    {
        $this->db->where('id_item', $id);
        return $this->db->update($table, $data);
    }


    public function get_supplier($id)
    {

        $query = $this->db->query('SELECT DISTINCT id_supplier,supplier_name,supplier_address,remark_supplier from v_trimorder_fix where id_trim = ' . $id . '');
        return $query->result_array();
    }

    public function get_supplier_po()
    {

        $query = $this->db->query('SELECT * from tb_supplier ORDER BY id_supplier desc ');
        return $query->result_array();
    }

    public function get_supplierx($id)
    {

        $query = $this->db->query('SELECT DISTINCT id_supplier,supplier_name,supplier_address from v_purchase_order where id_po = ' . $id . '');
        return $query->result_array();


        // $this->db->distinct('supplier_name');
        // return $this->db->get_where('v_trimorder_fix',  ['id_trim' => $id])->result_array();
    }
}
