<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controller_Color extends CI_Controller
{
	public function __construct()
	{
		Parent::__construct();
		is_logged_in();
		$this->load->model('Model_Color','color');
	}

	public function index()
	{
		$data['title'] = 'Color List';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		//konek model
		$this->load->model('Color_model', 'color');
		$data['color'] = $this->color->get_color();


		$this->form_validation->set_rules('color_code', 'Code Color', 'required');
		$this->form_validation->set_rules('color', 'Color', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('template_oznet/header', $data);
			$this->load->view('template_oznet/sidebar', $data);

			$this->load->view('administrator/color/index', $data);
			$this->load->view('template_oznet/footer');
		} else {
			$data = [
				'color_code' => $this->input->post('color_code'),
				'color' => $this->input->post('color'),
				'remark' => $this->input->post('remark')
			];
			$this->db->insert('tb_colors', $data);
			$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">New Color added</div>');
			redirect('Controller_Color');
		}
	}




	public function edit_color($id)
	{
		$data['title'] = 'Edit';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['colors'] = $this->color->getID($id);
		$data['color'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('color_code', 'Code Color', 'required');
		$this->form_validation->set_rules('color', 'Color', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('template_oznet/header', $data);
			$this->load->view('template_oznet/sidebar', $data);

			$this->load->view('administrator//sub_edit', $data);
			$this->load->view('template_oznet/footer');
		} else {
			$this->color->edit_color();
			$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">Color edited</div>');
			redirect('Controller_Color');
		}
	}


	public function delete_color($id)
	{
		
		$this->color->delete_colors($id);
		$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">Delete Color</div>');
		redirect('Controller_Color');
	}


}