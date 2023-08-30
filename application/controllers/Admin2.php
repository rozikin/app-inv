<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin2 extends CI_Controller
{
    public function __construct()

    {
        Parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Home';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('template_oznet/header');
        $this->load->view('template_oznet/sidebar', $data);
        $this->load->view('administrator/admin2/index');
        $this->load->view('template_oznet/footer');
    }
}
