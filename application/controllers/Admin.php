<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()

	{
		Parent::__construct();
		is_logged_in();
	}

	//menampilkan halaman utama
	public function index()
	{
		$data['title'] = 'index';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/admin/index');
		$this->load->view('template_oznet/footer');
	}


	public function dashboard()
	{
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/admin/dashboard');
		$this->load->view('template_oznet/footer');
	}

	function get_data_employee()
	{

		$this->db->where('id >', 0);
		$data = $this->db->get('tb_employee')->num_rows();

		$message = $data;

		echo json_encode(array("message" => $message));
	}


	function get_data_item()
	{


		$data = $this->db->get('tb_items')->num_rows();

		$message = $data;

		echo json_encode(array("message" => $message));
	}

	function get_data_peminjaman()
	{


		// date_default_timezone_set('Asia/Jakarta');

		// $this->db->where('date >', date('d-m-Y 00:00:00'));
		// $this->db->where('date <', date('d-m-Y 24:00:00'));
		$this->db->where('remark', 'PINJAM');
		$data = $this->db->get('tb_pinjam')->num_rows();

		$message = $data;

		echo json_encode(array("message" => $message));
	}

	function get_data_item_peminjaman()
	{


		// date_default_timezone_set('Asia/Jakarta');

		// $this->db->where('date >', date('d-m-Y 00:00:00'));
		// $this->db->where('date <', date('d-m-Y 24:00:00'));
		$this->db->where('status', 1);
		$data = $this->db->get('tb_items')->num_rows();

		$message = $data;

		echo json_encode(array("message" => $message));
	}


	function get_data_pinjam_hari_ini()
	{


		date_default_timezone_set('Asia/Jakarta');

		$this->db->where('date >', date('d-m-Y 00:00:00'));
		$this->db->where('date <', date('d-m-Y 24:00:00'));
		$this->db->where('remark', 'PINJAM');
		$data = $this->db->get('tb_pinjam')->num_rows();

		$message = $data;

		echo json_encode(array("message" => $message));
	}


	function get_data_kembali_hari_ini()
	{


		date_default_timezone_set('Asia/Jakarta');

		$this->db->where('date >', date('d-m-Y 00:00:00'));
		$this->db->where('date <', date('d-m-Y 24:00:00'));
		// $this->db->where('remark', 'PINJAM');
		$data = $this->db->get('tb_kembali')->num_rows();

		$message = $data;

		echo json_encode(array("message" => $message));
	}





	function get_ct_sweing()
	{


		date_default_timezone_set('Asia/Jakarta');

		$this->db->where('date >', date('d-m-Y 00:00:00'));
		$this->db->where('date <', date('d-m-Y 24:00:00'));
		$this->db->like('remark', 'PINJAM');
		$this->db->like('item_code', 'SEW');
		$data = $this->db->get('tb_pinjam')->num_rows();

		$message = '<h6>' . $data . '</h6>';

		echo json_encode(array("message" => $message));
	}

	function get_ct_qc()
	{


		date_default_timezone_set('Asia/Jakarta');

		$this->db->where('date >', date('d-m-Y 00:00:00'));
		$this->db->where('date <', date('d-m-Y 24:00:00'));
		$this->db->like('remark', 'PINJAM');
		$this->db->like('item_code', 'QC');
		$data = $this->db->get('tb_pinjam')->num_rows();

		$message = '<h6>' . $data . '</h6>';

		echo json_encode(array("message" => $message));
	}

	function get_ct_packing()
	{


		date_default_timezone_set('Asia/Jakarta');

		$this->db->where('date >', date('d-m-Y 00:00:00'));
		$this->db->where('date <', date('d-m-Y 24:00:00'));
		$this->db->like('remark', 'PINJAM');
		$this->db->like('item_code', 'PACK');
		$data = $this->db->get('tb_pinjam')->num_rows();

		$messagex = '<h6>' . $data . '</h6>';

		echo json_encode(array("message" => $messagex));
	}

	function get_ct_cutting()
	{


		date_default_timezone_set('Asia/Jakarta');

		$this->db->where('date >', date('d-m-Y 00:00:00'));
		$this->db->where('date <', date('d-m-Y 24:00:00'));
		$this->db->like('remark', 'PINJAM');
		$this->db->like('item_code', 'CUT');
		$data = $this->db->get('tb_pinjam')->num_rows();

		$messagey = '<h6>' . $data . '</h6>';

		echo json_encode(array("message" => $messagey));
	}
	function get_ct_mekanik()
	{


		date_default_timezone_set('Asia/Jakarta');

		$this->db->where('date >', date('d-m-Y 00:00:00'));
		$this->db->where('date <', date('d-m-Y 24:00:00'));
		$this->db->like('remark', 'PINJAM');
		$this->db->like('item_code', 'MEK');
		$data = $this->db->get('tb_pinjam')->num_rows();

		$message = '<h6>' . $data . '</h6>';

		echo json_encode(array("message" => $message));
	}
	function get_ct_sample()
	{


		date_default_timezone_set('Asia/Jakarta');

		$this->db->where('date >', date('d-m-Y 00:00:00'));
		$this->db->where('date <', date('d-m-Y 24:00:00'));
		$this->db->like('remark', 'PINJAM');
		$this->db->like('item_code', 'SPL');
		$data = $this->db->get('tb_pinjam')->num_rows();

		$message = '<h6>' . $data . '</h6>';

		echo json_encode(array("message" => $message));
	}
	function get_ct_wh()
	{


		date_default_timezone_set('Asia/Jakarta');

		$this->db->where('date >', date('d-m-Y 00:00:00'));
		$this->db->where('date <', date('d-m-Y 24:00:00'));
		$this->db->like('remark', 'PINJAM');
		$this->db->like('item_code', 'WH');
		$data = $this->db->get('tb_pinjam')->num_rows();

		$message = '<h6>' . $data . '</h6>';

		echo json_encode(array("message" => $message));
	}


















	public function role()
	{
		$data['title'] = 'Role';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['role'] = $this->db->get('user_role')->result_array();
		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/admin/role', $data);
		$this->load->view('template_oznet/footer');
	}

	public function roleAdd()
	{
		$data['title'] = 'Role';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['role'] = $this->db->get('user_role')->result_array();
		$this->form_validation->set_rules('role', 'Role', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('template_oznet/header', $data);
			$this->load->view('template_oznet/sidebar', $data);

			$this->load->view('administrator/admin/role', $data);
			$this->load->view('template_oznet/footer');
		} else {
			$this->db->insert('user_role', ['role' => $this->input->post('role')]);
			$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">New Menu added</div>');
			redirect('admin/role');
		}
	}


	public function roleedit()
	{

		$data['title'] = 'Role';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['role'] = $this->db->get('user_role')->result_array();
		$this->form_validation->set_rules('role', 'Role', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('template_oznet/header', $data);
			$this->load->view('template_oznet/sidebar', $data);

			$this->load->view('administrator/admin/role', $data);
			$this->load->view('template_oznet/footer');
		} else {
			$data = ['role' => $this->input->post('role')];
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('user_role', $data);
			$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">Role edited</div>');
			redirect('admin/role');
		}
	}

	public function hapus_role($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('user_role');
		$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">Menu Deleted</div>');
		redirect('admin/role');
	}

	public function roleaccess($role_id)
	{
		$data['title'] = 'Role Access';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
		$this->db->where('id !=', 1);
		$data['menu'] = $this->db->get('user_menu')->result_array();
		$data['acess_menu'] = $this->db->get('user_access_menu')->result_array();
		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/admin/role_access', $data);
		$this->load->view('template_oznet/footer');
	}


	public function changeaccess()
	{
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');
		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id,
		];
		$result = $this->db->get_where('user_access_menu', $data);
		if ($result->num_rows() < 1) {
			$this->db->insert('user_access_menu', $data);
		} else {
			$this->db->delete('user_access_menu', $data);
		}
		$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">Access Changed</div>');
	}

	public function view_web()
	{
		redirect('client');
	}


	public function get_data_transaksi()
	{

		date_default_timezone_set('Asia/Jakarta');

		$draw = intval($this->input->get("draw"));

		$this->db->where('date >', date('d-m-Y 00:00:00'));
		$this->db->where('date <', date('d-m-Y 24:00:00'));
		$this->db->where('remark', 'PINJAM');
		$this->db->order_by("id_out", "desc");
		$query = $this->db->get("tb_pinjam");
		$data = [];
		$no = 0;

		foreach ($query->result() as $r) {
			$no++;

			$row = array();

			$row[] = $no;

			$row[] = $r->no_out;
			$row[] = $r->date;
			$row[] = $r->no_return;
			$row[] = $r->date_ret;
			$row[] = $r->employee_id;
			// $row[] = $r->employee_name;
			// $row[] = $r->department;
			// $row[] = $r->line;
			$row[] = $r->item_code;
			// $row[] = $r->item_description;
			$row[] = $r->remark == 'PINJAM' ? '<a class="badge badge-danger">' . $r->remark . '</a>' : '<a class="badge badge-success">' . $r->remark . '</a>';
			$data[] = $row;
		};

		$result = array(
			"draw" => $draw,
			"recordsTotal" => $query->num_rows(),
			"recordsFiltered" => $query->num_rows(),
			"data" => $data
		);

		echo json_encode($result);
		exit();
	}
}
