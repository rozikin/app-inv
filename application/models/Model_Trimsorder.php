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
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodejadi = 'PR/' . $kodemax . '/' . $tgl;
        return $kodejadi;
    }

    function buat_kode_id()
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

    public function get_detil_status($id)
    {
        return $this->db->get_where('v_purchase_order_detail',  ['id_po' => $id]);
    }

    public function get_id_trims($id)
    {

        return $this->db->get_where('tb_trim_order',  ['id_trim' => $id])->row_array();
    }

    public function get_id_cbd($id)
    {

        return $this->db->get_where('tb_cbd',  ['order_no' => $id])->row_array();
    }

    public function get_id_cbd_detil($id)
    {
        $this->db->where('order_no', $id);
        $this->db->order_by('order_no');
        $hasil = $this->db->get('v_cbd');

        return $hasil->result_array();
    }

    public function get_color_detil($id)
    {
        $this->db->select('color');
        $this->db->group_by('color');
        $this->db->where('order_no', $id);
        $hasil = $this->db->get('v_cbd');

        return $hasil->result();
    }




    public function get_size_detil($id)
    {
        $this->db->select('size');
        $this->db->group_by('size');
        $this->db->where('order_no', $id);
        $hasil = $this->db->get('v_cbd');

        return $hasil->result();
    }


    public function get_colorqty_detil($id)
    {
        $this->db->select('color');
        $this->db->distinct();
        $this->db->where('order_no', $id);
        $hasil = $this->db->get('v_cbd');

        return $hasil->num_rows();
    }




    public function get_qty_detil($id)
    {
        $this->db->select('qty');
        $this->db->where('order_no', $id);
        $this->db->group_by('color');
        $hasil = $this->db->get('tb_cbd_detail');

        return $hasil->result();
    }


    public function get_bulanx($id)
    {
        $this->db->select('color');
        $this->db->group_by('color_code');
        $this->db->where('order_no', $id);
        $hasil = $this->db->get('v_cbd');

        return $hasil->result_array();
    }






    public function get_jenisx($id)
    {
        $this->db->select('size');
        $this->db->group_by('size_code');
        $this->db->where('order_no', $id);
        $hasil = $this->db->get('v_cbd');

        return $hasil->result_array();
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
        $query = "SELECT * from v_items Where id_item >0";
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
    public function get_cbd_id($id)
    {
        return $this->db->get_where('v_cbd',  ['order_no' => $id]);
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

    function insert($data)
    {
        $this->db->insert_batch('tb_cbd', $data);
    }

    function save_detil($data2)
    {
        $this->db->insert_batch('tb_cbd_detail', $data2);
    }



    public function delete_cbd_id($id)
    {
        $this->db->where('order_no', $id);
        $this->db->delete('tb_cbd');
    }
    public function delete_cbddetil_id($id)
    {
        $this->db->where('order_no', $id);
        $this->db->delete('tb_cbd_detail');
    }










    public function get_bulan($id)
    {
        $this->db->select('color');
        $this->db->where('order_no', $id);
        $this->db->from('v_cbd');

        $this->db->group_by('color');
        $this->db->order_by('color_code', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_jenis($id)
    {
        $this->db->select('size');
        $this->db->where('order_no', $id);
        $this->db->from('v_cbd');

        $this->db->group_by('size');
        $query = $this->db->get();
        return $query->result();
    }


    public function rekap_penjualan($id)
    {
        $this->db->select('color, size');
        $this->db->where('order_no', $id);
        $this->db->from('v_cbd');

        $query = $this->db->get();
        $temp = $query->result();
        $result['datax'] = array();
        foreach ($temp as $data) {
            $data->jmlh = $this->jml_penjualan($data->color, $data->size, $id);
            $result['datax'][] = $data;
        }
        return $result;
    }

    public function jml_penjualan($color, $size, $id)
    {
        $this->db->select('color, size, qty as jumlah');
        $this->db->from('v_cbd');
        $this->db->where('order_no', $id);
        $this->db->where(array('color' => $color, 'size' => $size));
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function get_bulan1($id)
    {
        $this->db->select('color');
        $this->db->where('id_trim', $id);
        $this->db->from('v_pivot_cbd');

        $this->db->group_by('color');
        $this->db->order_by('color', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_jenis1($id)
    {
        $this->db->select('size');
        $this->db->where('id_trim', $id);
        $this->db->from('v_pivot_cbd');

        $this->db->group_by('size');
        $query = $this->db->get();
        return $query->result();
    }

    public function rekap_penjualan1($id)
    {
        $this->db->select('color, size');
        $this->db->where('id_trim', $id);
        $this->db->from('v_pivot_cbd');

        $query = $this->db->get();
        $temp = $query->result();
        $result['datax'] = array();
        foreach ($temp as $data) {
            $data->jmlh = $this->jml_penjualan1($data->color, $data->size);
            $result['datax'][] = $data;
        }
        return $result;
    }

    public function jml_penjualan1($color, $size)
    {
        $this->db->select('color, size, qty as jumlah');
        $this->db->from('v_cbd');
        $this->db->where(array('color' => $color, 'size' => $size));
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }


    public function get_id_cbd_detil1($id)
    {
        $this->db->where('id_trim', $id);
        $this->db->order_by('id_trim');
        $hasil = $this->db->get('v_pivot_cbd');

        return $hasil->result_array();
    }










    // public function get_bulan($id)
    // {
    //     $this->db->select('color');
    //     $this->db->from('v_cbd');
    //     $this->db->group_by('color');
    //     $this->db->order_by('color_code', 'asc');
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    // public function get_jenis()
    // {
    //     $this->db->select('size');
    //     $this->db->from('v_cbd');
    //     $this->db->group_by('size_code');
    //     $query = $this->db->get();
    //     return $query->result();
    // }
}
