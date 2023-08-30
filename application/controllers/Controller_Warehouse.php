<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controller_Warehouse extends CI_Controller
{
	public function __construct()
	{
		Parent::__construct();
		is_logged_in();
		$this->load->model('Model_Warehouse', 'warehouse');
	}

	public function kode_otomatis()
	{
		$data =  $this->warehouse->buat_kode();
		echo json_encode($data);
	}
	public function kode_otomatis_out()
	{
		$data =  $this->warehouse->buat_kode_out();
		echo json_encode($data);
	}

	public function kode_otomatis_no_out()
	{
		$data =  $this->warehouse->buat_kode_no_out();
		echo json_encode($data);
	}

	public function kode_otomatis_return()
	{
		$data =  $this->warehouse->buat_kode_return();
		echo json_encode($data);
	}
	public function kode_otomatis_no_return()
	{
		$data =  $this->warehouse->buat_kode_no_return();
		echo json_encode($data);
	}


	public function index()
	{
		$data['title'] = 'Material In';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/warehouse/list_material_in');
		$this->load->view('template_oznet/footer');
	}
	public function material_out()
	{
		$data['title'] = 'Peminjaman';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['pinjam'] = $this->warehouse->get_out();

		$this->load->view('template_oznet/header', $data);
		// $this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/warehouse/list_material_out', $data);
		$this->load->view('template_oznet/footer');
	}

	public function hapus_out($id)
	{
		$this->warehouse->hapusDataOut($id);
		$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">data pinjam deleted</div>');
		redirect('Controller_Warehouse/material_out');
	}



	public function material_return()
	{
		$data['title'] = 'Pengembalian';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('administrator/warehouse/list_material_return');
		$this->load->view('template_oznet/footer');
	}


	public function stok()
	{
		$data['title'] = 'Stock';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/warehouse/stock');
		$this->load->view('template_oznet/footer');
	}

	public function get_data_material_in()
	{
		// Datatables Variables

		$draw = intval($this->input->get("draw"));
		$this->db->order_by("id_in", "desc");
		$query = $this->db->get("v_material_in_list");
		$data = [];
		$no = 0;

		foreach ($query->result() as $r) {
			$this->db->where('id_in', $r->id_in);
			$s = $this->db->get('v_material_in_detail');

			$no++;
			$rows = '';

			$row = array();
			$row[] = $no;
			$row[] = $r->no_sj;
			$row[] = $r->date_in;
			$row[] = $r->po_no;
			foreach ($s->result_array() as $key) {
				$rows .= '<li>' . $key['item_description'] . '-' . $key['size'] . '</li>';
			};
			$row[] = $rows;
			// $row[] = $li;
			$row[] = '<a class="badge badge-success">' . $r->supplier_name . '</a>';
			$row[] = $r->kurir;
			$row[] = $r->ekspedisi == 'Process' ? '<a class="badge badge-warning">' . $r->ekspedisi . '</a>' : '<a class="badge badge-success">' . $r->ekspedisi . '</a>';
			$row[] = $r->remark;


			$row[] = '

			<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
			Action
			<span class="sr-only">Toggle Dropdown</span>
			</button>
			<div class="dropdown-menu" role="menu">
				<a class="dropdown-item" onclick="detail_data(' . "'" . $r->id_in . "'" . ')"><span class="fa fa-info text-primary"></span> Detail</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" onclick="edit_data(' . "'" . $r->id_in . "'" . ')"><span class="fa fa-edit text-primary"></span> Edit</a>
			<div class="dropdown-divider"></div>
			
			<a class="dropdown-item " onclick="delete_data(' . "'" . $r->id_in . "'" . ')"><span class="fa fa-trash text-danger"></span> Delete</a>
			</div>
			';
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

	public function get_data_material_in_all()
	{
		// Datatables Variables

		$draw = intval($this->input->get("draw"));
		$this->db->order_by("id_in", "desc");
		$query = $this->db->get("v_material_in");
		$data = [];
		$no = 0;

		foreach ($query->result() as $r) {
			$no++;

			$row = array();
			$row[] = $no;
			$row[] = $r->no_sj;
			$row[] = $r->date_in;
			$row[] = $r->po_no;
			$row[] =  $r->supplier_name;
			$row[] = $r->item_code;
			$row[] = $r->item_description;
			$row[] = $r->color;
			$row[] = $r->size;
			$row[] = $r->qty;


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

	public function get_data_material_out_all()
	{
		// Datatables Variables

		$draw = intval($this->input->get("draw"));
		$this->db->order_by("id_out", "desc");
		$query = $this->db->get("v_pinjam");
		$data = [];
		$no = 0;

		foreach ($query->result() as $r) {
			$no++;

			$row = array();
			$row[] = $no;
			$row[] = $r->no_out;
			$row[] = $r->date;
			$row[] = $r->employee_id;
			$row[] = $r->employee_name;
			$row[] = $r->department;
			$row[] = $r->line;
			$row[] = $r->item_code;
			$row[] = $r->item_description;


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


	public function get_data_material_return_all()
	{
		// Datatables Variables

		$draw = intval($this->input->get("draw"));
		$this->db->order_by("id_return", "desc");
		$query = $this->db->get("v_material_return_detail");
		$data = [];
		$no = 0;

		foreach ($query->result() as $r) {
			$no++;

			$row = array();
			$row[] = $no;
			$row[] = $r->no_return;
			$row[] = $r->date;
			$row[] = $r->person;
			$row[] = $r->department;
			$row[] = $r->remark;
			$row[] = $r->item_code;
			$row[] = $r->item_description;
			$row[] = $r->color;
			$row[] = $r->size;
			$row[] = $r->qty;

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

	function get_data_nik()
	{
		$kode = $this->input->post('employee_id');
		$data = $this->warehouse->get_data_nik($kode);
		echo json_encode($data);

		// if ($data) {
		// 	echo json_encode(["message" => "success"]);
		// } else {
		// 	echo json_encode(["message" => "error"]);
		// }
	}

	function get_data_kode()
	{
		$kode = $this->input->post('item_code');
		$data = $this->warehouse->get_data_kode($kode);
		echo json_encode($data);
	}


	public function get_data_material_out()
	{
		// Datatables Variables


		$draw = intval($this->input->get("draw"));
		$this->db->order_by("id_out", "desc");
		$query = $this->db->get("v_pinjam");
		$data = [];
		$no = 0;


		foreach ($query->result() as $r) {
			$no++;

			$row = array();

			$row[] = $no;

			$row[] = $r->no_out;
			$row[] = $r->date;
			$row[] = $r->employee_id;
			$row[] = $r->employee_name;
			$row[] = $r->department;
			$row[] = $r->line;
			$row[] = $r->item_code;
			$row[] = $r->item_description;


			$row[] = '

			<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
			Action
			<span class="sr-only">Toggle Dropdown</span>
			</button>
			<div class="dropdown-menu" role="menu">
					
			<div class="dropdown-divider"></div>
			
			<a class="dropdown-item " onclick="delete_data(' . $r->id_out . ')"><span class="fa fa-trash text-danger"></span> Delete</a>
			</div>
			';
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


	public function get_data_material_return()
	{
		// Datatables Variables

		$draw = intval($this->input->get("draw"));
		$this->db->order_by("id_return", "desc");
		$query = $this->db->get("v_pengembalian");
		$data = [];
		$no = 0;


		foreach ($query->result() as $r) {

			$this->db->where('id_return', $r->id_return);
			$s = $this->db->get('v_material_return_detail');

			$no++;
			$rows = '';

			$row = array();
			$row[] = $no;
			$row[] = $r->no_return;
			$row[] = $r->date;
			foreach ($s->result_array() as $key) {
				$rows .= '<li>' . $key['item_description'] . '</li>';
			};
			$row[] = $rows;

			$row[] = $r->department;
			// $row[] = $li;
			$row[] = '<a class="badge badge-success">' . $r->mo . '</a>';
			$row[] = $r->style;

			$row[] = $r->remark;


			$row[] = '

			<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
			Action
			<span class="sr-only">Toggle Dropdown</span>
			</button>
			<div class="dropdown-menu" role="menu">
				<a class="dropdown-item" onclick="detail_data_return(' . "'" . $r->id_return . "'" . ')"><span class="fa fa-info text-primary"></span> Detail</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" onclick="edit_data_return(' . "'" . $r->id_return . "'" . ')"><span class="fa fa-edit text-primary"></span> Edit</a>
			<div class="dropdown-divider"></div>
			
			<a class="dropdown-item " onclick="delete_data_return(' . "'" . $r->id_return . "'" . ')"><span class="fa fa-trash text-danger"></span> Delete</a>
			</div>
			';
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



	public function get_stock()
	{
		// Datatables Variables

		$draw = intval($this->input->get("draw"));
		$this->db->order_by("id_item", "desc");
		$this->db->where("id_item >", 0);
		$query = $this->db->get("v_stok_inout");
		$data = [];
		$no = 0;


		foreach ($query->result() as $r) {

			// $this->db->where('id_po', $r->id_po);
			// $s = $this->db->get('v_material_in');
			// $li = $s->num_rows();

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $r->item_code;
			$row[] = $r->item_description;
			$row[] = $r->color;
			$row[] = $r->size;
			$row[] = $r->unit;

			$row[] = $r->stok > 0 ? '<a class="text">' . $r->stok . '</a>' : '<a class="text-danger">' . $r->stok . '</a>';




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




	public function get_data()
	{
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$this->db->order_by("id_trim", "desc");
		$this->db->where("id_trim >", 0);
		$query = $this->db->get("tb_trim_order");
		$data = [];
		$no = 0;

		foreach ($query->result() as $r) {
			$this->db->where('id_trim', $r->id_trim);
			$s = $this->db->get('tb_trim_detail');
			$l = $s->num_rows();



			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $r->trim_code;
			$row[] = $r->trim_mo;
			$row[] = $r->trim_style;
			$row[] = $r->trim_destination;
			$row[] = $r->trim_date;
			$row[] = $r->trim_status == 'Request' ? '<a class="badge badge-warning">' . $r->trim_status . '</a>' : '<a class="badge badge-success">' . $r->trim_status . '</a>';
			$row[] = $l;
			$row[] = $r->user;


			$row[] = '

			<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
			Action
			<span class="sr-only">Toggle Dropdown</span>
			</button>
			<div class="dropdown-menu" role="menu">
				<a class="dropdown-item" onclick="detail_data(' . "'" . $r->id_trim . "'" . ')");><span class="fa fa-info text-primary"></span> Detail</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" onclick="proses_data(' . "'" . $r->id_trim . "'" . ')"  ' . $this->session->set_userdata('idx', $r->id_trim) . '><span class="fas fa-play text-primary"></span> Proses</a>
			
			';

			//add html for action
			// $row[] = '
			// <a class="badge badge-warning" href="javascript:void(0)" title="Edit" onclick="detail_data(' . "'" . $r->id_trim . "'" . ')"><i class="fas fa-info"></i> Detail</a>
			// <a class="badge badge-primary" href="javascript:void(0)" title="Edit" onclick="proses_data(' . "'" . $r->id_trim . "'" . ')"><i class="fas fa-play"></i>  Proses</a>';

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


	public function add_material_in()
	{
		$data['title'] = 'Add Material IN';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['item'] = $this->warehouse->get_item();
		$data['po'] = $this->warehouse->get_po();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/warehouse/add_material_in', $data);
		$this->load->view('template_oznet/footer');
	}

	public function add_material_out()
	{
		$data['title'] = 'Add Material OUT';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['item'] = $this->warehouse->get_item_stok();
		$data['po'] = $this->warehouse->get_po();
		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/warehouse/add_material_out', $data);
		$this->load->view('template_oznet/footer');
	}


	public function add_material_return()
	{
		$data['title'] = 'Add Material Return';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['item'] = $this->warehouse->get_item_out();
		$data['po'] = $this->warehouse->get_po();
		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/warehouse/add_material_return', $data);
		$this->load->view('template_oznet/footer');
	}


	public function detail_data($id)
	{
		$querc = $this->warehouse->get_detil_material_in($id);
		$data = [];
		$no = 0;

		foreach ($querc->result() as $r) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $r->item_code;
			$row[] = $r->item_description;

			$row[] = $r->supplier_name;
			$row[] = $r->size;
			$row[] = $r->color;
			$row[] = $r->qty;

			$data[] = $row;
		};

		$result = array(
			"data" => $data
		);

		echo json_encode($result);
		exit();
	}


	public function cari_item_po($idx)
	{

		$querc = $this->warehouse->get_item_po($idx);
		$data = [];
		$no = 0;

		foreach ($querc->result() as $r) {
			$no++;
			$row = array();
			$row[] = $r->po_no;

			$row[] = $r->item_code;
			$row[] = $r->item_description;

			$row[] = $r->supplier_name;
			$row[] = $r->size;
			$row[] = $r->color;
			$row[] = $r->qty;
			$row[] = $r->id_po;


			// $row[] = '


			// 	<a onclick="pilih_code_c2(' . "'" . $r->id_po . "'" . ')"><span class="fa fa-select text-primary"></span> pilih</a>


			// ';

			$data[] = $row;
		};

		$result = array(
			"data" => $data
		);

		echo json_encode($result);
		exit();
	}


	public function cari_item_po2($idx)
	{

		$querc = $this->warehouse->get_item_po($idx);

		echo json_encode($querc);
		exit();
	}


	public function get_code()
	{

		$querc = $this->warehouse->get_detil_material_out($id);
		$data = [];
		$no = 0;

		foreach ($querc->result() as $r) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $r->item_code;
			$row[] = $r->item_description;

			$row[] = $r->supplier_name;
			$row[] = $r->size;
			$row[] = $r->color;
			$row[] = $r->qty;

			$data[] = $row;
		};

		$result = array(
			"data" => $data
		);

		echo json_encode($result);
		exit();
	}

	public function detail_data_out($id)
	{
		$querc = $this->warehouse->get_detil_material_out($id);
		$data = [];
		$no = 0;

		foreach ($querc->result() as $r) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $r->item_code;
			$row[] = $r->item_description;

			$row[] = $r->supplier_name;
			$row[] = $r->size;
			$row[] = $r->color;
			$row[] = $r->qty;

			$data[] = $row;
		};

		$result = array(
			"data" => $data
		);

		echo json_encode($result);
		exit();
	}



	public function detail_data_return($id)
	{
		$querc = $this->warehouse->get_detil_material_return($id);
		$data = [];
		$no = 0;

		foreach ($querc->result() as $r) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $r->item_code;
			$row[] = $r->item_description;
			$row[] = $r->supplier_name;
			$row[] = $r->size;
			$row[] = $r->color;
			$row[] = $r->qty;

			$data[] = $row;
		};

		$result = array(
			"data" => $data
		);

		echo json_encode($result);
		exit();
	}








	public function get_item()
	{
		$draw = intval($this->input->get("draw"));
		// Datatables Variables
		$id = 2;
		$id_supplier = 4;

		$query =  $this->db->query('SELECT * FROM v_trimorder_detail where id_trim = ' . $id . ' && id_supplier = ' . $id_supplier . '');

		$data = [];
		$no = 0;

		foreach ($query->result() as $r) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $r->item_code;
			$row[] = $r->item_description;
			$row[] = $r->size_code;
			$row[] = $r->color;
			$row[] = $r->item_remark;
			$row[] = $r->supplier_name;
			$row[] = $r->currency;
			$row[] = $r->item_price;
			//add html for action
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


	public function create()
	{
		$this->_validate();
		$datas = [
			'id_in' => $this->input->post('id_in'),
			'no_sj' => $this->input->post('no_sj'),
			'date' => $this->input->post('date_in'),
			'kurir' => $this->input->post('kurir'),
			'ekspedisi' => $this->input->post('ekspedisi'),
			'id_po' => $this->input->post('id_po'),
			'remark' => $this->input->post('remark1'),

		];


		$this->db->insert('tb_material_in', $datas);

		$id_po = $this->input->post('id_po');
		$this->db->set('po_status', 'Recived');
		$this->db->where('id_po', $id_po);
		$this->db->update('tb_purchase_order');

		for ($count = 0; $count < count($_POST['id_item']); $count++) {
			$datax = array(
				'id_in' => $this->input->post('id_in'),
				'id_item' => $_POST['id_item'][$count],
				'color' => $_POST['color'][$count],
				'size' => $_POST['size'][$count],
				'qty' => $_POST['qty'][$count],
				'remark' => $_POST['remark'][$count],

			);
			// print_r($datax);
			// $insert = $this->Feature_model->saves($data);
			$this->db->insert('tb_material_in_detail', $datax);
		}
		$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">New data added</div>');
		redirect('Controller_Warehouse');
	}
	public function create_out()
	{

		$no_id = $this->input->post('id_out');
		$sql = $this->db->query("SELECT id_out FROM tb_pinjam where id_out = '$no_id' ");
		$cek = $sql->num_rows();


		if ($cek < 1) {


			$this->_validate_out();
			date_default_timezone_set('Asia/Jakarta');
			$datas = [

				'no_out' => $this->input->post('no_out'),
				'date' => date('d-m-Y H:i:s'),
				'employee_id' => $this->input->post('employee_id'),
				'item_code' => $this->input->post('item_code'),
				'remark' => '',

			];


			$this->db->insert('tb_pinjam', $datas);

			$this->session->set_flashdata('message', '<div class= "alert alert-success alert-sm" role="alert">New data added</div>');
			redirect('Controller_Warehouse/material_out');
		} else {
			$this->session->set_flashdata('message', '<div class= "alert alert-danger" role="alert">duplikat data</div>');
			redirect('Controller_Warehouse/material_out');
		}
	}


	public function create_out_ajax()
	{
		date_default_timezone_set('Asia/Jakarta');
		if ($this->input->post('type') == 1) {
			$no_out = $this->input->post('no_out');
			$datex = date('d-m-Y H:i:s');
			$employee_id = $this->input->post('employee_id');
			$item_code = $this->input->post('item_code');
			$remark = '';
			$this->warehouse->saverecords($no_out, $datex, $employee_id, $item_code, $remark);
			echo json_encode(array(
				"statusCode" => 200
			));
		}
	}




	public function create_return()
	{
		$this->_validate_return();
		$datas = [
			'id_return' => $this->input->post('id_return'),
			'no_return' => $this->input->post('no_return'),
			'date' => $this->input->post('date_return'),
			'person' => $this->input->post('person'),
			'department' => $this->input->post('department'),
			'mo' => $this->input->post('mo'),
			'style' => $this->input->post('style'),
			'remark' => $this->input->post('remark1'),

		];


		$this->db->insert('tb_material_return', $datas);
		for ($count = 0; $count < count($_POST['id_item']); $count++) {
			$datax = array(
				'id_return' => $this->input->post('id_return'),
				'id_item' => $_POST['id_item'][$count],
				'color' => $_POST['color'][$count],
				'size' => $_POST['size'][$count],
				'qty' => $_POST['qty'][$count],
				'remark' => $_POST['remark'][$count],

			);
			$this->db->insert('tb_material_return_detail', $datax);
		}
		$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">New data added</div>');
		redirect('Controller_Warehouse/material_return');
	}






	public function get_data_detil()
	{
		$id_po = $this->input->post('id_po');
		$this->db->where('id_po', $id_po);
		$data = $this->db->get('v_purchase_order_detail')->result();
		echo json_encode($data);
	}


	public function get_id_otomatis()
	{
		$id = $_GET['id'];

		$this->db->where('id_item', $id);
		$data = $this->db->get('v_items')->result_array();
		echo json_encode($data);
	}

	public function edit_material_in($id = null)
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Edit Material IN';
		$data['po'] = $this->warehouse->get_id_po($id);
		$data['podetil'] = $this->warehouse->get_detil_po($id);
		$data['itemtrim'] = $this->warehouse->get_item();

		// $this->form_validation->set_rules('id_trim', 'Id Trim', 'required');

		// if ($this->form_validation->run() == false) {
		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/warehouse/edit_material_in', $data);
		$this->load->view('template_oznet/footer');
		// } else {
		// 	$datas = [
		// 		'no_sj' => $this->input->post('no_sj'),
		// 		'date' => $this->input->post('date_in'),
		// 		'kurir' => $this->input->post('kurir'),
		// 		'ekspedisi' => $this->input->post('ekspedisi'),
		// 		'id_po' => $this->input->post('id_po'),
		// 		'remark' => $this->input->post('remark1'),
		// 	];


		// 	$this->db->where('id_in', $this->input->inst('id_in'));
		// 	$this->db->update('tb_material_in', $datas);
		// 	$this->deleteInvoiceItems();

		// 	for ($count = 0; $count < count($_POST['id_item']); $count++) {
		// 		$datax = array(
		// 			'id_in' => $this->input->post('id_in'),
		// 			'id_item' => $_POST['id_item'][$count],
		// 			'color' => $_POST['color'][$count],
		// 			'size' => $_POST['size'][$count],
		// 			'qty' => $_POST['qty'][$count],
		// 			'remark' => $_POST['remark'][$count],
		// 		);
		// 		$this->db->insert('tb_material_in_detail', $datax);
		// 	}
		// 	$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">data edited</div>');
		// 	redirect('Controller_Warehouse');
		// }
	}
	public function edit_material_out($id = null)
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Edit Material Out';
		$data['po'] = $this->warehouse->get_id_out($id);
		$data['podetil'] = $this->warehouse->get_detil_out($id);
		$data['itemtrim'] = $this->warehouse->get_item();


		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/warehouse/edit_material_out', $data);
		$this->load->view('template_oznet/footer');
	}



	public function edit_material_return($id = null)
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Edit Material Retun';
		$data['po'] = $this->warehouse->get_id_return($id);
		$data['podetil'] = $this->warehouse->get_detil_return($id);
		$data['itemtrim'] = $this->warehouse->get_item();


		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/warehouse/edit_material_return', $data);
		$this->load->view('template_oznet/footer');
	}


	public function deleteInvoiceItems()
	{
		$this->db->where('id_in', $this->input->post('id_in'));
		$this->db->delete('tb_material_in_detail');
	}



	public function deleteInvoiceItems_out()
	{
		$this->db->where('id_out', $this->input->post('id_out'));
		$this->db->delete('tb_material_out_detail');
	}

	public function deleteInvoiceItems_return()
	{
		$this->db->where('id_return', $this->input->post('id_return'));
		$this->db->delete('tb_material_return_detail');
	}


	public function updates()
	{
		$this->_validate();
		$datas = [
			'no_sj' => $this->input->post('no_sj'),
			'date' => $this->input->post('date_in'),
			'kurir' => $this->input->post('kurir'),
			'ekspedisi' => $this->input->post('ekspedisi'),
			'id_po' => $this->input->post('id_po'),
			'remark' => $this->input->post('remark1'),
		];


		$this->db->where('id_in', $this->input->post('id_in'));
		$this->db->update('tb_material_in', $datas);
		$this->deleteInvoiceItems();

		for ($count = 0; $count < count($_POST['id_item']); $count++) {
			$datax = array(
				'id_in' => $this->input->post('id_in'),
				'id_item' => $_POST['id_item'][$count],
				'color' => $_POST['color'][$count],
				'size' => $_POST['size'][$count],
				'qty' => $_POST['qty'][$count],
				'remark' => $_POST['remark'][$count],
			);

			$this->db->insert('tb_material_in_detail', $datax);
		}
		$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">data edited</div>');
		redirect('Controller_Warehouse');
	}



	public function updates_out()
	{
		$this->_validate_out();
		$datas = [
			'id_out' => $this->input->post('id_out'),
			'no_out' => $this->input->post('no_out'),
			'date' => $this->input->post('date_out'),
			'allocation' => $this->input->post('allocation'),
			'department' => $this->input->post('department'),
			'mo' => $this->input->post('mo'),
			'style' => $this->input->post('style'),
			'remark' => $this->input->post('remark1'),
		];


		$this->db->where('id_out', $this->input->post('id_out'));
		$this->db->update('tb_material_out', $datas);
		$this->deleteInvoiceItems_out();

		for ($count = 0; $count < count($_POST['id_item']); $count++) {
			$datax = array(
				'id_out' => $this->input->post('id_out'),
				'id_item' => $_POST['id_item'][$count],
				'color' => $_POST['color'][$count],
				'size' => $_POST['size'][$count],
				'qty' => $_POST['qty'][$count],
				'remark' => $_POST['remark'][$count],
			);

			$this->db->insert('tb_material_out_detail', $datax);
		}
		$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">data edited</div>');
		redirect('Controller_Warehouse/material_out');
	}


	public function updates_return()
	{
		$this->_validate_return();
		$datas = [
			'id_return' => $this->input->post('id_return'),
			'no_return' => $this->input->post('no_return'),
			'date' => $this->input->post('date_return'),
			'person' => $this->input->post('person'),
			'department' => $this->input->post('department'),
			'mo' => $this->input->post('mo'),
			'style' => $this->input->post('style'),
			'remark' => $this->input->post('remark1'),
		];


		$this->db->where('id_return', $this->input->post('id_return'));
		$this->db->update('tb_material_return', $datas);
		$this->deleteInvoiceItems_return();

		for ($count = 0; $count < count($_POST['id_item']); $count++) {
			$datax = array(
				'id_return' => $this->input->post('id_return'),
				'id_item' => $_POST['id_item'][$count],
				'color' => $_POST['color'][$count],
				'size' => $_POST['size'][$count],
				'qty' => $_POST['qty'][$count],
				'remark' => $_POST['remark'][$count],
			);

			$this->db->insert('tb_material_return_detail', $datax);
		}
		$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">data edited</div>');
		redirect('Controller_Warehouse/material_return');
	}




	function mutasi()
	{
		$data['title'] = 'Mutasi';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/warehouse/mutasi');
		$this->load->view('template_oznet/footer');
	}

	function material_in_report()
	{
		$data['title'] = 'Material in report';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/warehouse/material_in_rp');
		$this->load->view('template_oznet/footer');
	}


	function material_out_report()
	{
		$data['title'] = 'Material out report';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/warehouse/material_out_rp');
		$this->load->view('template_oznet/footer');
	}


	function material_return_report()
	{
		$data['title'] = 'Material Return report';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/warehouse/material_return_rp');
		$this->load->view('template_oznet/footer');
	}










	public function get_mutasi()
	{
		// Datatables Variables
		$draw = intval($this->input->get("draw"));

		$this->db->order_by('id', 'asc');
		$query = $this->db->get("v_balance_detail_sum");
		$data = [];
		$no = 0;
		foreach ($query->result() as $r) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $r->item_code;
			$row[] = $r->item_description;
			$row[] = $r->color;
			$row[] = $r->size;
			$row[] = '<div class="text text-danger">' . $r->req . '</div>';
			$row[] = $r->purc;
			$row[] = $r->mat_in;
			$row[] = $r->mat_out;
			$row[] = $r->mat_return;
			$row[] = $r->stok;



			$data[] = $row;
		};


		$result = array(
			"draw" => $draw,
			// "recordsTotal" => $query->num_rows(),
			// "recordsFiltered" => $query->num_rows(),
			"data" => $data
		);

		echo json_encode($result);
		exit();
	}









	public function remove_material_in($id)
	{
		//delete fil
		$this->warehouse->delete_by_id($id);
		$this->warehouse->delete_material_in_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function remove_material_out($id)
	{
		//delete fil
		$this->warehouse->delete_by_out($id);
		echo json_encode(array("status" => TRUE));
	}

	public function remove_material_return($id)
	{
		//delete fil
		$this->warehouse->delete_by_return($id);
		$this->warehouse->delete_material_return_id($id);
		echo json_encode(array("status" => TRUE));
	}









	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('id_po') == '') {
			$data['inputerror'][] = 'id_po';
			$data['error_string'][] = 'item code name is required';
			$data['status'] = FALSE;
		}
		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
	private function _validate_out()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('item_code') == '') {
			$data['inputerror'][] = 'item_code';
			$data['error_string'][] = 'code is required';
			$data['status'] = FALSE;
		}
		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}

	private function _validate_return()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('id_item') == '') {
			$data['inputerror'][] = 'id_item';
			$data['error_string'][] = 'code name is required';
			$data['status'] = FALSE;
		}
		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
}
