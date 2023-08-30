<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Warehouse extends CI_Model

{
    // function buat_kode()
    // {
    //     $this->db->select('RIGHT(tb_material_in.id_in,10) as kode', FALSE);
    //     $this->db->order_by('kode', 'DESC');
    //     $this->db->limit(1);
    //     $query = $this->db->get('tb_material_in');
    //     if ($query->num_rows() <> 0) {

    //         $data = $query->row();
    //         $kode = intval($data->kode) + 1;
    //     } else {

    //         $kode = 1;
    //     }
    //     $tgl = date('Y');
    //     $kodemax = str_pad($kode, 0, "0", STR_PAD_LEFT);
    //     $kodejadi = $kodemax;
    //     return $kodejadi;
    // }

    // function buat_kode_out()
    // {
    //     $this->db->select('RIGHT(tb_pinjam.id_out,10) as kode', FALSE);
    //     $this->db->order_by('kode', 'ASC');
    //     $this->db->limit(1);
    //     $query = $this->db->get('tb_pinjam');
    //     if ($query->num_rows() <> 0) {

    //         $data = $query->row();
    //         $kode = intval($data->kode) + 1;
    //     } else {

    //         $kode = 1;
    //     }
    //     $tgl = date('Y');
    //     $kodemax = str_pad($kode, 0, "0", STR_PAD_LEFT);
    //     $kodejadi = $kodemax;
    //     return $kodejadi;
    // }
    function buat_kode_no_out()
    {
        $this->db->select('RIGHT(tb_pinjam.no_out,10) as kode', FALSE);
        $this->db->order_by('kode', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_pinjam');
        if ($query->num_rows() <> 0) {

            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {

            $kode = 1;
        }
        // $tgl = date('Y');
        $kodemax = str_pad($kode, 10, "0", STR_PAD_LEFT);
        $kodejadi = 'OUT' . $kodemax;
        return $kodejadi;
    }

    function buat_kode_return()
    {
        $this->db->select('RIGHT(tb_pengembalian.id_return,10) as kode', FALSE);
        $this->db->order_by('kode', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_pengembalian');
        if ($query->num_rows() <> 0) {

            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {

            $kode = 1;
        }
        $tgl = date('Y');
        $kodemax = str_pad($kode, 0, "0", STR_PAD_LEFT);
        $kodejadi = $kodemax;
        return $kodejadi;
    }


    function buat_kode_no_return()
    {
        $this->db->select('RIGHT(tb_pengembalian.no_return,10) as kode', FALSE);
        $this->db->order_by('kode', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_pengembalian');
        if ($query->num_rows() <> 0) {

            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {

            $kode = 1;
        }
        $tgl = date('Y');
        $kodemax = str_pad($kode, 6, "0", STR_PAD_LEFT);
        $kodejadi = 'RT' . $tgl . $kodemax;
        return $kodejadi;
    }

    public function get_out()
    {
        $query = "SELECT * from v_pinjam order by id_out DESC";
        return $this->db->query($query)->result_array();
    }

    public function hapusDataOut($id)
    {
        $this->db->where('id_out', $id);
        $this->db->delete('tb_pinjam');
    }


    function saverecords($no_out, $datex, $employee_id, $item_code, $remark)
    {
        $query = "INSERT INTO `tb_pinjam`( `no_out`,`date`,`employee_id`, `item_code`, `remark`) VALUES ('$no_out', '$datex', '$employee_id', '$item_code', '$remark')";
        $this->db->query($query);
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
        $query = "SELECT * from v_purchase_order_detail";
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

    public function get_detil_material_in($id)
    {
        return $this->db->get_where('v_material_in_detail',  ['id_in' => $id]);
    }

    public function get_detil_material_out($id)
    {
        return $this->db->get_where('v_material_out_detail',  ['id_out' => $id]);
    }

    public function get_detil_material_return($id)
    {
        return $this->db->get_where('v_material_return_detail',  ['id_return' => $id]);
    }


    public function get_item_po($idx)
    {

        $this->db->where('id_po', $idx);
        $this->db->order_by('id_po');
        $hasil = $this->db->get('v_purchase_order');

        return $hasil;
    }









    public function get_detil_itemtrim($id)
    {
        return $this->db->get_where('v_trimorder_detail',  ['id_trim' => $id])->result_array();
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
        return $this->db->get_where('v_material_in',  ['id_in' => $id])->row_array();
    }


    public function get_id_out($id)
    {
        return $this->db->get_where('v_material_out',  ['id_out' => $id])->row_array();
    }


    public function get_id_return($id)
    {
        return $this->db->get_where('v_material_return_detail',  ['id_return' => $id])->row_array();
    }



    public function get_piw_po($id)
    {
        return $this->db->get_where('v_purchase_manage',  ['id_po' => $id])->row();
    }



    public function get_detil_po($id)
    {
        return $this->db->get_where('v_material_in_detail',  ['id_in' => $id])->result_array();
    }
    public function get_detil_out($id)
    {
        return $this->db->get_where('v_material_out_detail',  ['id_out' => $id])->result_array();
    }

    public function get_detil_return($id)
    {
        return $this->db->get_where('v_material_return_detail',  ['id_return' => $id])->result_array();
    }



    function save($table, $data)
    {
        $this->db->insert($table, $data);
    }


    public function delete_by_id($id)
    {
        $this->db->where('id_in', $id);
        $this->db->delete('tb_material_in');
    }
    public function delete_material_in_id($id)
    {
        $this->db->where('id_in', $id);
        $this->db->delete('tb_material_in_detail');
    }


    public function delete_by_out($id)
    {
        $this->db->where('id_out', $id);
        $this->db->delete('tb_pinjam');
    }
    public function delete_material_out_id($id)
    {
        $this->db->where('id_out', $id);
        $this->db->delete('tb_material_out_detail');
    }


    public function delete_by_return($id)
    {
        $this->db->where('id_return', $id);
        $this->db->delete('tb_material_return');
    }
    public function delete_material_return_id($id)
    {
        $this->db->where('id_return', $id);
        $this->db->delete('tb_material_return_detail');
    }



    public function update_data($table, $data, $id)
    {
        $this->db->where('id_item', $id);
        return $this->db->update($table, $data);
    }


    public function get_po()
    {

        $query = $this->db->query('SELECT DISTINCT id_po,po_no,request_date,supplier_name from v_purchase_manage');
        return $query->result_array();
    }




    function get_data_nik($kode)
    {


        $hsl = $this->db->query("SELECT * FROM tb_employee WHERE employee_id='$kode'");
        if ($hsl->num_rows() > 0) {
            foreach ($hsl->result() as $data) {
                $hasil = array(
                    'employee_id' => $data->employee_id,
                    'employee_name' => $data->employee_name,
                    'department' => $data->department,
                    'line' => $data->linex,
                );
            }
        }
        return $hasil;
    }



    function get_data_kode($kode)
    {
        $hsl = $this->db->query("SELECT * FROM tb_items WHERE item_code='$kode'");
        if ($hsl->num_rows() > 0) {
            foreach ($hsl->result() as $data) {
                $hasil = array(
                    'item_code' => $data->item_code,
                    'item_description' => $data->item_description,

                );
            }
        }
        return $hasil;
    }
}
