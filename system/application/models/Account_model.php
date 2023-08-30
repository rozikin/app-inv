<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account_model extends CI_Model

{

    public function __construct()
    {
        Parent::__construct();
    }

    function get_id_user()
    {

        $query = $this->db->get('user');
        return $query->row();
    }



    public function edit_account($data)
    {
        $this->db->set('company', $data['company']);
        $this->db->set('provinsi', $data['provinsi']);
        $this->db->set('city', $data['city']);
        $this->db->set('addres1', $data['addres1']);
        $this->db->set('addres2', $data['addres2']);
        $this->db->set('kode_pos', $data['kode_pos']);
        $this->db->set('telp', $data['telp']);
        $this->db->set('remark', $data['remark']);

        $this->db->where('id', $data['id']);
        $this->db->update('user');
    }
    public function edit_user($data)
    {
        $this->db->set('name', $data['name']);
        $this->db->set('email', $data['email']);

        $this->db->where('id', $data['id']);
        $this->db->update('user');
    }
}
