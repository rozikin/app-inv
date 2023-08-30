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


    function saverecords($no_in, $datex, $employee_id, $no_pinjam, $item_code, $remark)
    {
        $query = "INSERT INTO `tb_kembali`( `no_return`,`date`,`employee_id`,`no_out`, `item_code`, `remark`) VALUES ('$no_in', '$datex', '$employee_id',$no_pinjam, '$item_code', '$remark')";
        return $this->db->query($query);
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
        $hsl = $this->db->query("SELECT * FROM tb_items WHERE item_code='$kode'");
        if ($hsl->num_rows() > 0) {
            foreach ($hsl->result() as $data) {
                $hasil = array(
                    'item_code' => $data->item_code,
                    'item_description' => $data->item_description,
                    'status' => $data->status,

                );
            }
        }
        return $hasil;
    }
}
