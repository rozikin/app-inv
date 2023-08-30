<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controller_Size extends CI_Controller
{
	public function __construct()
	{
		Parent::__construct();
		is_logged_in();
		$this->load->model('Model_Size','size');
	}

	public function index()
	{
		$data['title'] = 'Size List';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		//konek model
		$this->load->model('Size_model', 'size');
		$data['size'] = $this->size->get_size();


		$this->form_validation->set_rules('size_code', 'Size Code', 'required');
		$this->form_validation->set_rules('size_description', 'Size_description', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('template_oznet/header', $data);
			$this->load->view('template_oznet/sidebar', $data);

			$this->load->view('administrator/size/index', $data);
			$this->load->view('template_oznet/footer');
		} else {
			$data = [
				'size_code' => $this->input->post('size_code'),
				'size_description' => $this->input->post('size_description')
			];
			$this->db->insert('tb_size', $data);
			$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">New size added</div>');
			redirect('Controller_Size');
		}
	}



	public function edit_size($id)
	{
		$data['title'] = 'Edit';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['sizes'] = $this->size->getID($id);
		$data['size'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('size_code', 'Code size', 'required');
		$this->form_validation->set_rules('size_description', 'size Description', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('template_oznet/header', $data);
			$this->load->view('template_oznet/sidebar', $data);

			$this->load->view('administrator/controller_size/edit_size', $data);
			$this->load->view('template_oznet/footer');
		} else {
			$this->size->edit_size();
			$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">size edited</div>');
			redirect('Controller_Size');
		}
	}


	public function delete_size($id)
	{
		
		$this->size->delete_sizes($id);
		$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">Delete size</div>');
		redirect('Controller_Size');
	}

}