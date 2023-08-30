<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controller_Unit extends CI_Controller
{
	public function __construct()
	{
		Parent::__construct();
		is_logged_in();
		$this->load->model('Model_Unit');
	}

	public function index()
	{
		$data['title'] = 'Unit';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['unit'] = $this->db->get('tb_unit')->result_array();
		$this->form_validation->set_rules('code_unit', 'Code_Unit', 'required');
		if ($this->form_validation->run() == false) {
			$this->load->view('template_oznet/header', $data);
			$this->load->view('template_oznet/sidebar', $data);

			$this->load->view('administrator/unit/index', $data);
			$this->load->view('template_oznet/footer');
		} else {
			$data = [
				'code_unit' => $this->input->post('code_unit'),
				'description' => $this->input->post('description')
			];
			$this->db->insert('tb_unit', $data);

			$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">New Unit added</div>');
			redirect('Controller_Unit');
		}
	}



	public function unit_edit($id)
	{
		$data['title'] = 'Edit';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['Unit'] = $this->Model_Unit->UnitID($id);
		$this->form_validation->set_rules('code_unit', 'Code_Unit', 'required');
		if ($this->form_validation->run() == false) {
			$this->load->view('template_oznet/header', $data);
			$this->load->view('template_oznet/sidebar', $data);
			$this->load->view('administrator/unit/Unit_edit', $data);
			$this->load->view('template_oznet/footer');
		} else {
			$this->Model_Unit->editDataUnit();
			$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">Unit edited</div>');
			redirect('Controller_Unit');
		}
	}

	public function hapus_Unit($id)
	{
		$this->Model_Unit->hapusDataUnit($id);
		$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">Unit Deleted</div>');
		redirect('Controller_Unit');
	}
}
