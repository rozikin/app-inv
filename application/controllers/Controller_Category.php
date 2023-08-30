<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controller_Category extends CI_Controller
{
	public function __construct()
	{
		Parent::__construct();
		is_logged_in();
		$this->load->model('Model_Category');
	}

	public function index()
	{
		$data['title'] = 'category';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['category'] = $this->db->get('tb_category')->result_array();
		$this->form_validation->set_rules('code_category', 'Code_Category', 'required');
		if ($this->form_validation->run() == false) {
			$this->load->view('template_oznet/header', $data);
			$this->load->view('template_oznet/sidebar', $data);

			$this->load->view('administrator/category/index', $data);
			$this->load->view('template_oznet/footer');
		} else {
			$data = [
				'code_category' => $this->input->post('code_category'),
				'name_category' => $this->input->post('name_category')
			];
			$this->db->insert('tb_category', $data);

			$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">New category added</div>');
			redirect('Controller_Category');
		}
	}



	public function category_edit($id)
	{
		$data['title'] = 'Edit';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['category'] = $this->Model_Category->categoryID($id);
		$this->form_validation->set_rules('code_category', 'Code_category', 'required');
		if ($this->form_validation->run() == false) {
			$this->load->view('template_oznet/header', $data);
			$this->load->view('template_oznet/sidebar', $data);
			$this->load->view('administrator/category/category_edit', $data);
			$this->load->view('template_oznet/footer');
		} else {
			$this->Model_Category->editDatacategory();
			$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">category edited</div>');
			redirect('Controller_Category');
		}
	}

	public function hapus_category($id)
	{
		$this->Model_Category->hapusDatacategory($id);
		$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">category Deleted</div>');
		redirect('Controller_Category');
	}
}
