<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controller_Router extends CI_Controller
{
	public function __construct()
	{
		Parent::__construct();
		is_logged_in();
		$this->load->model('Model_Router', 'routeros');
	}



	function mikrotik()
	{
		ini_set('display_errors', 0);
		// $ip = '36.95.208.99:2';
		$ip = '192.168.52.1';
		$user = 'roziapi';
		$pass = 'Semarang123';


		$mikrotik =  new RouterosAPI();
		$mikrotik->debug = false;

		if ($mikrotik->connect($ip, $user, $pass)) {
			$mikrotikOn = $mikrotik;
		} else {
			$mikrotikOn = 0;
		}
		return $mikrotikOn;
	}

	function ping($mikrotik, $ip)
	{
		$exe = $mikrotik->comm('/ping', array(
			'address' => $ip,
			'count' => 1
		));

		return $exe;
	}


	function cek()
	{
	}










	public function index()
	{

		$mikrotik  = $this->mikrotik();


		if ($mikrotik != 0) {
			$queryRouter = $this->db->get('tbl_router');
			// $queryRouter = mysqli_query($koneksi, "select * from router");
			if ($queryRouter->row() != 0) {

				foreach ($queryRouter->result_array() as $result) {
					$ping = $this->ping($mikrotik, $result['ip_router']);
					$status = ($ping[0]['received'] == 1) ? 'green' : 'red';

					$aRouter[] = array(
						'nama' => $result['nama_router'], 'ip' => $result['ip_router'], 'parent' => $result['parent_ip'], 'status' => $status
					);
					if ($status == 'red') {
						$routerLoss[] = '*' . $result['nama_router'] . '* loss';
					}
				}
			}

			$mikrotik->disconnect();
		}

		if (isset($routerLoss)) {
			$token = 'diisi dengan api tele';
		}

















		$data['title'] = 'router List';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		//konek model
		$this->load->model('router_model', 'routeros');
		$data['router'] = $this->routeros->get_all_router();
		$data['aRouter'] = $aRouter;


		$this->form_validation->set_rules('router_code', 'router Code', 'required');
		$this->form_validation->set_rules('router_description', 'router_description', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('template_oznet/header', $data);

			$this->load->view('administrator/router/index', $data);
			$this->load->view('template_oznet/footer');
		} else {
			$data = [
				'router_code' => $this->input->post('router_code'),
				'router_description' => $this->input->post('router_description')
			];
			$this->db->insert('tb_router', $data);
			$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">New router added</div>');
			redirect('Controller_router');
		}
	}



	public function edit_router($id)
	{
		$data['title'] = 'Edit';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['routers'] = $this->routeros->getID($id);
		$data['router'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('router_code', 'Code router', 'required');
		$this->form_validation->set_rules('router_description', 'router Description', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('template_oznet/header', $data);
			$this->load->view('template_oznet/sidebar', $data);

			$this->load->view('administrator/controller_router/edit_router', $data);
			$this->load->view('template_oznet/footer');
		} else {
			$this->routeros->edit_router();
			$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">router edited</div>');
			redirect('Controller_router');
		}
	}


	public function delete_router($id)
	{

		$this->routeros->delete_routers($id);
		$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">Delete router</div>');
		redirect('Controller_router');
	}
}
