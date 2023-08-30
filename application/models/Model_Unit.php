<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Unit extends CI_Model

{
    public function UnitID($id)
    {
        return $this->db->get_where('tb_unit',  ['id_unit' => $id])->row_array();
    }


    public function editDataUnit()
    {
        $data = [
            'code_unit' => $this->input->post('code_unit'),
            'description' => $this->input->post('description')
        ];

        $this->db->where('id_unit', $this->input->post('id_unit'));
        $this->db->update('tb_unit', $data);
    }

    public function hapusDataUnit($id)
    {
        $this->db->where('id_unit', $id);
        $this->db->delete('tb_unit');
    }
}
