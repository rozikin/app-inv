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

		$x = $this->db->query('SELECT DISTINCT employee_id FROM  tb_pinjam where remark = "PINJAM" ');
		// $this->db->where('remark', 'PINJAM');
		

		$data = $x->num_rows();

		// $this->db->where('id >', 0);
		// $data = $this->db->get('tb_employee')->num_rows();

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



		$this->db->where('remark', 'PINJAM');
		$data = $this->db->get('tb_pinjam')->num_rows();

		$message = $data;

		echo json_encode(array("message" => $message));
	}

	function get_data_item_peminjaman()
	{


		$this->db->where('status', 1);
		$data = $this->db->get('tb_items')->num_rows();

		$message = $data;

		echo json_encode(array("message" => $message));
	}


	function get_data_pinjam_hari_ini()
	{


		date_default_timezone_set('Asia/Jakarta');

		$this->db->like('dates', date('Y-m-d'));
		$this->db->where('remark', 'PINJAM');
		$data = $this->db->get('tb_pinjam')->num_rows();

		$message = $data;

		echo json_encode(array("message" => $message));
	}

	function get_data_belum_kembali()
	{
        
		date_default_timezone_set('Asia/Jakarta');

		$tgl_sekarang = strtotime( date('Y-m-d'));

		$tgl_kemarin = date('Y-m-d', strtotime("-1 day", $tgl_sekarang));

		// $from_trx = $this->input->post('from_transaksi');
        // $to_trx = $this->input->post('to_transaksi');


        // $this->db->where('dates >=', $from_trx);
        // $this->db->where('dates <=', $to_trx);




		$this->db->where('remark', 'PINJAM');

		// $this->db->where('dates >=', date('Y-m-d', strtotime("-1 day", strtotime(date("Y-m-d")))));
		$this->db->where('dates >=', '2023-01-01');
		$this->db->where('dates <=', $tgl_kemarin);

		$all_data_pinjam = $this->db->get('tb_pinjam')->num_rows();




		// $this->db->like('dates', date('Y-m-d'));
		// $this->db->where('remark', 'PINJAM');
		// $data_pinjam_hari_ini = $this->db->get('tb_pinjam')->num_rows();

		// $hasil = $all_data_pinjam - $data_pinjam_hari_ini;

		$message = '<h6 class="text-danger">' . $all_data_pinjam . '</h6>';

		echo json_encode(array("message" => $message));
	}





	function get_data_kembali_hari_ini()
	{


		date_default_timezone_set('Asia/Jakarta');

		$this->db->like('dates', date('Y-m-d'));
		// $this->db->where('remark', 'PINJAM');
		$data = $this->db->get('tb_kembali')->num_rows();

		$message = $data;

		echo json_encode(array("message" => $message));
	}




	function get_ct_sweing()
	{


		date_default_timezone_set('Asia/Jakarta');

		$this->db->like('dates', date('Y-m-d'));
		$this->db->like('remark', 'PINJAM');
		$this->db->like('item_code', 'SEW');
		$data = $this->db->get('tb_pinjam')->num_rows();

		$message = '<h6>' . $data . '</h6>';

		echo json_encode(array("message" => $message));
	}

	function get_ct_qc()
	{


		date_default_timezone_set('Asia/Jakarta');

		$this->db->like('dates', date('Y-m-d'));
		$this->db->like('remark', 'PINJAM');
		$this->db->group_start()->like('item_code', 'QC')->or_group_start()->like('item_code', 'FAB')->group_end()
			->group_end();
		// $this->db->or_like('item_code', 'FAB');
		$data = $this->db->get('tb_pinjam')->num_rows();

		$message = '<h6>' . $data . '</h6>';

		echo json_encode(array("message" => $message));
	}

	function get_ct_packing()
	{

		date_default_timezone_set('Asia/Jakarta');


		$this->db->like('dates', date('Y-m-d'));
		$this->db->like('remark', 'PINJAM');
		$this->db->like('item_code', 'PACK');
		$data = $this->db->get('tb_pinjam')->num_rows();

		$messagex = '<h6>' . $data . '</h6>';

		echo json_encode(array("message" => $messagex));
	}

	function get_ct_cutting()
	{


		date_default_timezone_set('Asia/Jakarta');

		$this->db->like('dates', date('Y-m-d'));
		$this->db->like('remark', 'PINJAM');
		$this->db->like('item_code', 'CUT');
		$data = $this->db->get('tb_pinjam')->num_rows();

		$messagey = '<h6>' . $data . '</h6>';

		echo json_encode(array("message" => $messagey));
	}
	function get_ct_mekanik()
	{


		date_default_timezone_set('Asia/Jakarta');

		$this->db->like('dates', date('Y-m-d'));
		$this->db->like('remark', 'PINJAM');
		$this->db->like('item_code', 'MEK');
		$data = $this->db->get('tb_pinjam')->num_rows();

		$message = '<h6>' . $data . '</h6>';

		echo json_encode(array("message" => $message));
	}
	function get_ct_sample()
	{

		date_default_timezone_set('Asia/Jakarta');

		$this->db->like('dates', date('Y-m-d'));
		$this->db->like('remark', 'PINJAM');
		$this->db->like('item_code', 'SPL');
		$data = $this->db->get('tb_pinjam')->num_rows();

		$message = '<h6>' . $data . '</h6>';

		echo json_encode(array("message" => $message));
	}
	function get_ct_wh()
	{


		date_default_timezone_set('Asia/Jakarta');

		$this->db->like('dates', date('Y-m-d'));
		$this->db->like('remark', 'PINJAM');
		$this->db->like('item_code', 'WH');
		$data = $this->db->get('tb_pinjam')->num_rows();

		$message = '<h6>' . $data . '</h6>';

		echo json_encode(array("message" => $message));
	}

	function get_ct_folding()
	{


		date_default_timezone_set('Asia/Jakarta');

		$this->db->like('dates', date('Y-m-d'));
		$this->db->like('remark', 'PINJAM');
		$this->db->like('item_code', 'FOLD');
		// $this->db->or_like('item_code', 'TRNS');
		$data = $this->db->get('tb_pinjam')->num_rows();

		$message = '<h6>' . $data . '</h6>';

		echo json_encode(array("message" => $message));
	}

	function get_ct_print()
	{


		date_default_timezone_set('Asia/Jakarta');

		$this->db->like('dates', date('Y-m-d'));
		$this->db->like('remark', 'PINJAM');
		$this->db->like('item_code', 'PRINT');
		$data = $this->db->get('tb_pinjam')->num_rows();

		$message = '<h6>' . $data . '</h6>';

		echo json_encode(array("message" => $message));
	}

	function get_ct_iron()
	{


		date_default_timezone_set('Asia/Jakarta');

		$this->db->like('dates', date('Y-m-d'));
		$this->db->like('remark', 'PINJAM');
		$this->db->like('item_code', 'IRON');
		$data = $this->db->get('tb_pinjam')->num_rows();

		$message = '<h6>' . $data . '</h6>';

		echo json_encode(array("message" => $message));
	}

	function get_ct_other()
	{


		date_default_timezone_set('Asia/Jakarta');

		$this->db->like('dates', date('Y-m-d'));
		$this->db->like('remark', 'PINJAM');
		$this->db->not_like('item_code', 'FOLD');
		// $this->db->not_like('item_code', 'TRNS');
		$this->db->not_like('item_code', 'SEW');
		$this->db->not_like('item_code', 'WH');
		$this->db->not_like('item_code', 'CUT');
		$this->db->not_like('item_code', 'QC');
		$this->db->not_like('item_code', 'PACK');
		$this->db->not_like('item_code', 'MEK');
		$this->db->not_like('item_code', 'SPL');
		$this->db->not_like('item_code', 'FAB');
		$this->db->not_like('item_code', 'PRINT');
		$this->db->not_like('item_code', 'IRON');
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



	public function get_update() {
				    
		$token  = '6648766898:AAGpG9x6PEQBa94j_sX7xWmCutzAFeZWHJc';
		$link   = 'https://api.telegram.org:443/bot'.$token.'';
	    
		$update = file_get_contents($link.'/getUpdates');
		$response = json_decode($update, TRUE);
	    
	    $chat_id = $response['result'][0]['message']['chat']['id'];

		date_default_timezone_set('Asia/Jakarta');

		$this->db->like('dates', date('Y-m-d'));
		$this->db->where('remark', 'PINJAM');
		$all_data_pinjam = $this->db->get('tb_pinjam')->num_rows();

		$introx = "DT yang belum kembali = ";

	    $message = $introx.strval($all_data_pinjam);
	    $parameters = [
	    	'chat_id' => -4011102779, 
	    	'text'  => $message,
	    ];
	    
	    $url = $link.'/sendMessage?'.http_build_query($parameters); 
	    file_get_contents($url);
	    
	}

	public function get_update2() {
				    
		$token  = '6648766898:AAGpG9x6PEQBa94j_sX7xWmCutzAFeZWHJc';
		$link   = 'https://api.telegram.org:443/bot'.$token.'';
	    
		$update = file_get_contents($link.'/getUpdates');
		$response = json_decode($update, TRUE);
	    
	    $chat_id = $response['result'][0]['message']['chat']['id'];

		$this->db->where('remark', 'PINJAM');
		$this->db->like('dates', date('Y-m-d', strtotime("-1 day", strtotime(date("Y-m-d")))));
		$all_data_pinjam = $this->db->get('tb_pinjam')->num_rows();
		$introx = "DT yang belum kembali = ";

	    $message = $introx.strval($all_data_pinjam);
	    $parameters = [
	    	'chat_id' => -4011102779, 
	    	'text'  => $message,
	    ];
	    
	    $url = $link.'/sendMessage?'.http_build_query($parameters); 
	    file_get_contents($url);
	    
	}





	public function get_data_transaksi()
	{

		date_default_timezone_set('Asia/Jakarta');

		$draw = intval($this->input->get("draw"));

		$tgl_sekarang = strtotime( date('Y-m-d'));

		$tgl_kemarin = date('Y-m-d', strtotime("-1 day", $tgl_sekarang));


		// $this->db->where('remark', 'PINJAM'); 
		// $this->db->where('dates <', $tgl_kemarin);

		$this->db->where('dates >=', '2023-01-01 00:00:00');
		$this->db->where('dates <=', $tgl_kemarin);




		// $this->db->like('dates', date('Y-m-d', strtotime("-1 day", strtotime(date("Y-m-d")))));
		$this->db->where('remark', 'PINJAM');
		$this->db->order_by("id_out", "desc");
		$query = $this->db->get("tb_pinjam");
		$data = [];
		$no = 0;

		foreach ($query->result() as $r) {


			$this->db->where('employee_id', $r->employee_id);
			$xx = $this->db->get('tb_employee');
			$this->db->where('item_code', $r->item_code);
			$s = $this->db->get('tb_items');

			$row_item_desc = '';
			$row_name = '';
			$row_department = '';
			$row_line = '';






			$no++;

			$row = array();

			$row[] = $no;

			$row[] = $r->no_out;
			$row[] = $r->dates;
			$row[] = $r->no_return;
			$row[] = $r->date_ret;
			$row[] = $r->employee_id;
			foreach ($xx->result() as $key) {
				$row_name .= $key->employee_name;
				$row_department .= $key->department;
			};

			$row[] = $row_name;
			// $row[] = $row_department;


			$row[] = $r->item_code;
			foreach ($s->result() as $key) {
				$row_item_desc .= $key->item_description;
			};

			$row[] = $row_item_desc;

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
