<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Peminjaman extends CI_Model

{

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
        return $this->db->query($query);
    }




    public function delete_by_out($id)
    {
        $this->db->where('id_out', $id);
        $this->db->delete('tb_pinjam');
    }


    public function update_data($table, $data, $id)
    {
        $this->db->where('id_item', $id);
        return $this->db->update($table, $data);
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
                    'status' => $data->status,

                );
            }
        }
        return $hasil;
    }
}
