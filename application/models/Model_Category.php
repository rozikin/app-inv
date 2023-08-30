<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Category extends CI_Model

{
    public function categoryID($id)
    {
        return $this->db->get_where('tb_category',  ['id_category' => $id])->row_array();
    }


    public function editDatacategory()
    {
        $data = [
            'code_category' => $this->input->post('code_category'),
            'name_category' => $this->input->post('name_category')
        ];

        $this->db->where('id_category', $this->input->post('id_category'));
        $this->db->update('tb_category', $data);
    }

    public function hapusDatacategory($id)
    {
        $this->db->where('id_category', $id);
        $this->db->delete('tb_category');
    }
}
