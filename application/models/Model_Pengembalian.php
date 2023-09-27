<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Pengembalian extends CI_Model

{

    function buat_kode_no_return()
    {
        $this->db->select('RIGHT(tb_kembali.no_return,10) as kode', FALSE);
        $this->db->order_by('kode', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_kembali');
        if ($query->num_rows() <> 0) {

            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {

            $kode = 1;
        }
        // $tgl = date('Y');
        $kodemax = str_pad($kode, 10, "0", STR_PAD_LEFT);
        $kodejadi = 'IN' . $kodemax;
        return $kodejadi;
    }



    public function get_out()
    {
        $query = "SELECT * from tb_kembali order by id_retur DESC";
        return $this->db->query($query)->result_array();
    }

    public function hapusDataOut($id)
    {
        $this->db->where('id_retur', $id);
        $this->db->delete('tb_kembali');
    }





    public function delete_by_retur($id)
    {
        $this->db->where('id_retur', $id);
        $this->db->delete('tb_kembali');
    }


    public function update_data($table, $data, $id)
    {
        $this->db->where('id_item', $id);
        return $this->db->update($table, $data);
    }


    function get_data_nik($kode)
    {

        $hsl = $this->db->query("SELECT * FROM tb_employee WHERE employee_id=$kode");
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
        $this->db->where("item_code", $kode);
        $this->db->where("remark", "PINJAM");
        // $this->db->where("status", 1);
        $hsl = $this->db->get("tb_pinjam");
        if ($hsl->num_rows() > 0) {
            foreach ($hsl->result() as $data) {

                $this->db->where('item_code', $data->item_code);
                $xx = $this->db->get('tb_items');
                $row_status = '';
                $row_desc = '';



                foreach ($xx->result() as $key) {
                    $row_status .= $key->status;
                    $row_desc .= $key->item_description;
                };


                $hasil = array(
                    'item_code' => $data->item_code,
                    'item_description' => $row_desc,
                    'status' => $row_status,
                    'no_out' => $data->no_out,

                );
            }
        }
        return $hasil;
    }
}