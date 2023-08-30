<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Tracking extends CI_Model

{

    public function get_tracking()
    {
        $query = "SELECT DISTINCT id_trim,trim_code,trim_mo,trim_date,trim_status,po_no,request_date,po_status from v_status where id_trim>0 ORDER BY id_po DESC";
        return $this->db->query($query)->result_array();
    }
    public function get_trim()
    {
        $query = "SELECT * from tb_trim_order where id_trim >0 order by id_trim asc";
        return $this->db->query($query)->result_array();
    }
    public function get_po()
    {
        $query = "SELECT DISTINCT id_po,po_no,request_date  from v_status";
        return $this->db->query($query)->result_array();
    }

    public function get_detil_status($id)
    {
        return $this->db->get_where('v_purchase_order_detail',  ['id_po' => $id]);
    }
    public function get_detil_trim($id)
    {
        return $this->db->get_where('v_trimorder_detail',  ['id_trim' => $id]);
    }


    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_status');
    }

    public function delete_statuss($id)
    {
        $this->db->where('id_status', $id);
        $this->db->delete('tb_status');
    }

    public function getID($id)
    {
        return $this->db->get_where('tb_status',  ['id_status' => $id])->row_array();
    }















    public function editDataMenu()
    {
        $data = [
            'menu' => $this->input->post('menu'),
            'icon' => $this->input->post('icon')
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_menu', $data);
    }

    public function hapusDataMenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_menu');
    }





    public function hapussubmenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_sub_menu');
    }

    public function editData()
    {
        $data = [
            'title' => $this->input->post('title'),
            'menu_id' => $this->input->post('menu_id'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => $this->input->post('is_active')
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_sub_menu', $data);
    }












    public function get_bulan1()
    {
        $this->db->select('item_description');

        $this->db->from('v_purchase_order');

        $this->db->group_by('item_description');
        $this->db->order_by('item_description', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_jenis1()
    {
        $this->db->select('trim_mo');

        $this->db->from('v_purchase_order');

        $this->db->group_by('trim_mo');
        $query = $this->db->get();
        return $query->result();
    }


    public function get_po_no()
    {
        $this->db->select('po_no');
        $this->db->from('v_purchase_order');

        $this->db->group_by('po_no');
        $query = $this->db->get();
        return $query->result();
    }

    public function rekap_penjualan1()
    {
        $this->db->distinct();
        $this->db->select('item_description, trim_mo');

        $this->db->from('v_purchase_order');

        $query = $this->db->get();
        $temp = $query->result();
        $result['datax'] = array();
        foreach ($temp as $data) {
            $data->jmlh = $this->jml_penjualan1($data->item_description, $data->trim_mo);
            $result['datax'][] = $data;
        }
        return $result;
    }

    public function jml_penjualan1($item_description, $trim_mo)
    {
        $this->db->distinct();
        $this->db->select('item_description,id_trim, trim_mo,id_po, po_no, trim_code');

        $this->db->from('v_purchase_order');
        $this->db->where('item_description', $item_description);
        $this->db->where('trim_mo', $trim_mo);
        $this->db->group_by('po_no');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }


    public function get_id_cbd_detil1()
    {

        $this->db->order_by('id_trim');
        $hasil = $this->db->get('v_purchase_order');

        return $hasil->result_array();
    }


    public function get_balance($special = false)
    {

        $query = $this->db->query("SELECT t.id, t.date, t.debit , t.credit FROM ( SELECT i.date_in AS date, i.qty AS debit, 0 AS credit, 'i' AS i_or_r , i.id_item         AS id
           FROM v_material_in i UNION ALL
         SELECT r.date_out AS dates, 0 AS debit, r.qty AS credit , 'r' AS i_or_r, r.id_item AS id
           FROM v_material_out r ) t ORDER BY t.date, t.i_or_r, t.id");

        if ($special) {
            return $query;
        }
        return $query->result_array();
    }
}
