<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controller_Purchase extends CI_Controller
{
	public function __construct()
	{
		Parent::__construct();
		is_logged_in();
		$this->load->model('Model_Purchase', 'purchase');
	}

	public function kode_otomatis()
	{
		$data =  $this->purchase->buat_kode();
		echo json_encode($data);
	}

	public function kode_otomatis_po()
	{
		$data =  $this->purchase->buat_kode_po();
		echo json_encode($data);
	}


	public function index()
	{
		$data['title'] = 'Purchase Order';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/purchase/index_purchase');
		$this->load->view('template_oznet/footer');
	}


	public function purchase_report()
	{
		$data['title'] = 'Purchase Order';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/purchase/purchase_rp');
		$this->load->view('template_oznet/footer');
	}


	public function request_purchase()
	{
		$data['title'] = 'Request Report';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/purchase/index');
		$this->load->view('template_oznet/footer');
	}

	public function get_data_purchase()
	{
		// Datatables Variables

		$draw = intval($this->input->get("draw"));
		$this->db->order_by("id_po", "desc");
		$this->db->where("id_po >", 0);
		$query = $this->db->get("v_purchase_manage");
		$data = [];
		$no = 0;


		foreach ($query->result() as $r) {

			$this->db->where('id_trim', $r->id_trim);
			$xx = $this->db->get('v_trimorder_fix');

			$this->db->where('id_po', $r->id_po);
			$s = $this->db->get('v_purchase_order');

			$rows = '';
			$rowx = '';
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $r->po_no;
			$row[] = $r->request_date;
			$row[] = $r->trim_code;
			// $row[] = $r->trim_date;

			$row[] = '<a class="badge badge-success">' . $r->trim_status . '</a>';
			$row[] = $r->po_status == 'Process' ? '<a class="badge badge-warning">' . $r->po_status . '</a>' : '<a class="badge badge-success">' . $r->po_status . '</a>';
			// $row[] = $r->delivery_at;

			foreach ($xx->result_array() as $key) {
				$rowx .= '<li>' . $key['item_description'] . '-' . $key['size'] . '</li>';
			};

			$row[] = $rowx;

			foreach ($s->result_array() as $key) {
				$rows .= '<li>' . $key['item_description'] . '-' . $key['size'] . '</li>';
			};
			$row[] = $rows;

			// $row[] =  number_format($r->purchase_amount);
			$row[] = $r->supplier_name;
			$row[] = $r->user;



			$row[] = '

			<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
			Action
			<span class="sr-only">Toggle Dropdown</span>
			</button>
			<div class="dropdown-menu" role="menu">
				<a class="dropdown-item" onclick="detail_data(' . "'" . $r->id_po . "'" . ')"><span class="fa fa-info text-primary"></span> Detail</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" onclick="edit_data(' . "'" . $r->id_po . "'" . ')" ' . $this->session->set_userdata('ids', $r->id_trim) . '><span class="fa fa-edit text-primary"></span> Edit</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item " onclick="view_data(' . "'" . $r->id_po . "'" . ')"><span class="fa fa-eye text-primary"></span> View</a>
			
			<div class="dropdown-divider"></div>
			<a class="dropdown-item " onclick="delete_data(' . "'" . $r->id_po . "'" . ')"><span class="fa fa-trash text-danger"></span> Delete</a>
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


	public function get_data_purchase_report()
	{
		// Datatables Variables

		$draw = intval($this->input->get("draw"));
		$this->db->order_by("id_po", "desc");
		$this->db->where("id_po >", 0);
		$query = $this->db->get("v_purchase_order");
		$data = [];
		$no = 0;


		foreach ($query->result() as $r) {

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $r->po_no;
			$row[] = $r->trim_code;
			$row[] = $r->request_date;
			$row[] = $r->request_in_house;
			$row[] = $r->applicant;
			$row[] = '<a class="badge badge-success">' . $r->trim_status . '</a>';
			$row[] = $r->po_status == 'Process' ? '<a class="badge badge-warning">' . $r->po_status . '</a>' : '<a class="badge badge-success">' . $r->po_status . '</a>';

			$row[] = $r->item_code;
			$row[] = $r->item_description;
			$row[] = $r->color;
			$row[] = $r->size;
			$row[] = $r->qty;
			$row[] = $r->supplier_name;
			$row[] = $r->User;



			$row[] = '

			<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
			Action
			<span class="sr-only">Toggle Dropdown</span>
			</button>
			<div class="dropdown-menu" role="menu">
				<a class="dropdown-item" onclick="detail_data(' . "'" . $r->id_po . "'" . ')"><span class="fa fa-info text-primary"></span> Detail</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" onclick="edit_data(' . "'" . $r->id_po . "'" . ')" ' . $this->session->set_userdata('ids', $r->id_trim) . '><span class="fa fa-edit text-primary"></span> Edit</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item " onclick="view_data(' . "'" . $r->id_po . "'" . ')"><span class="fa fa-eye text-primary"></span> View</a>
			
			<div class="dropdown-divider"></div>
			<a class="dropdown-item " onclick="delete_data(' . "'" . $r->id_po . "'" . ')"><span class="fa fa-trash text-danger"></span> Delete</a>
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



	public function get_data()
	{
		$draw = intval($this->input->get("draw"));
		$this->db->order_by("id_trim", "desc");
		$this->db->where("id_trim >", 0);
		$query = $this->db->get("tb_trim_order");
		$data = [];
		$no = 0;


		foreach ($query->result() as $r) {
			$this->db->where('id_trim', $r->id_trim);
			$s = $this->db->get('v_trimorder_fix');
			$l = $s->num_rows();
			$rows = '';



			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $r->trim_code;
			$row[] = $r->trim_mo;
			$row[] = $r->trim_style;
			$row[] = $r->trim_destination;
			$row[] = $r->trim_date;
			$row[] = $r->trim_status == 'Request' ? '<a class="badge badge-warning">' . $r->trim_status . '</a>' : '<a class="badge badge-success">' . $r->trim_status . '</a>';
			foreach ($s->result_array() as $key) {
				$rows .= '<li>' . $key['item_description'] . '-' . $key['size'] . '</li>';
			};

			$row[] = $rows;
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


	public function add_purchase()
	{
		$data['title'] = 'Purchase Order';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['item'] = $this->purchase->get_itemc();
		$data['size'] = $this->purchase->get_size();
		$data['color'] = $this->purchase->get_color();
		$data['supplier'] = $this->purchase->get_supplier();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/purchase/add_purchase_order', $data);
		$this->load->view('template_oznet/footer');
	}

	public function detail_trim($id)
	{
		// Datatables Variables

		$querc = $this->purchase->get_detil_id($id);
		$data = [];
		$no = 0;

		foreach ($querc->result() as $r) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $r->item_code;
			$row[] = $r->item_description;
			$row[] = $r->remark_supplier;
			$row[] = $r->supplier_name;
			$row[] = $r->size;
			$row[] = $r->color;
			$row[] = $r->total;
			$row[] = $r->unit;
			//add html for action
			$data[] = $row;
		};

		$result = array(
			"data" => $data
		);

		echo json_encode($result);
		exit();
	}


	public function detail_purchase($id)
	{
		// Datatables Variables

		$querc = $this->purchase->get_detil_purchase($id);
		$data = [];
		$no = 0;

		foreach ($querc->result() as $r) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $r->item_code;
			$row[] = $r->item_description;
			$row[] = $r->remark;
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

		// $hasil = $query;

		// $this->db->order_by("id_trim", "desc");
		// $query = $this->db->get("v_trimorder_detail");
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

	// public function deleteTracking()
	// {
	// 	$this->db->where('id_trim', $this->input->post('id_trim'));
	// 	$this->db->delete('tb_tracking');
	// }



	public function create()
	{
		$this->_validate();
		$datas = [
			'id_po' => $this->input->post('id_po'),
			'po_no' => $this->input->post('po_no'),
			'id_trim' => $this->input->post('id_trim'),
			'id_supplier' => $this->input->post('id_supplier'),
			'request_date' => $this->input->post('request_date'),
			'request_in_house' => $this->input->post('request_in'),
			'delivery_at' => $this->input->post('delivery_at'),
			'allocation' => $this->input->post('allocation'),
			'applicant' => $this->input->post('applicant'),
			'approval' => $this->input->post('approval'),
			'po_status' => 'Process',
			'sub_total' => $this->input->post('sub_total'),
			'rounding' => $this->input->post('rounding'),
			'vat' => $this->input->post('tax'),
			'vat_amount' => $this->input->post('tax_end'),
			'grand_total' => $this->input->post('grand_total_end'),
			'purchase_amount' => $this->input->post('purchase_amount_end'),
			'note1' => $this->input->post('note1'),
			'note2' => $this->input->post('note2'),
			'user' => $this->session->userdata('email')
		];

		$data2 = [
			'id_trim' => $this->input->post('id_trim'),
			'id_po' => $this->input->post('id_po')

		];

		// $idtrim = $this->input->post('id_trim');

		// $this->db->where('id_trim', $idtrim);
		// $this->db->where('id_po', 0);
		// $track = $this->db->get('tb_tracking');

		// if ($track->num_rows() > 0) {
		// 	$this->deleteTracking();
		// 	$this->db->insert('tb_tracking', $data2);
		// } else {
		// 	$this->db->insert('tb_tracking', $data2);
		// }




		// print_r($datas);
		$this->db->insert('tb_purchase_order', $datas);



		$id_trimx = $this->input->post('id_trim');
		$this->db->set('trim_status', 'Approve');
		$this->db->where('id_trim', $id_trimx);
		$this->db->update('tb_trim_order');

		for ($count = 0; $count < count($_POST['id_item']); $count++) {
			$datax = array(
				'id_po' => $this->input->post('id_po'),
				'id_item' => $_POST['id_item'][$count],
				'color' => $_POST['color'][$count],
				'size' => $_POST['size'][$count],
				'qty' => $_POST['qty'][$count],
				'price' => $_POST['item_price'][$count],
				'total_price' => $_POST['total_price'][$count],
			);
			// print_r($datax);
			// $insert = $this->Feature_model->saves($data);
			$this->db->insert('tb_purchase_order_detail', $datax);
		}
		$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">New data added</div>');
		redirect('Controller_Purchase');
	}

	public function proses_po($id)
	{
		$xs = $this->session->userdata('idx');


		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Add Purchase Order';
		$data['trimx'] = $this->purchase->get_id_trim($id);
		$data['suppliers'] = $this->purchase->get_supplier($id);
		$data['itemtrim'] = $this->purchase->get_detil_itemtrim($id);


		$this->form_validation->set_rules('item_code', 'Item Code', 'required');
		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/purchase/proses_po', $data);
		$this->load->view('template_oznet/footer');
	}


	public function add_purchase_un()
	{

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Add Purchase Order';
		// $data['trimx'] = $this->purchase->get_id_trim();
		$data['suppliers'] = $this->purchase->get_supplier_po();
		$data['itemtrim'] = $this->purchase->get_detil_itemtrim_po();


		$this->form_validation->set_rules('item_code', 'Item Code', 'required');
		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/purchase/add_po_un', $data);
		$this->load->view('template_oznet/footer');
	}

	public function get_data_detil()
	{
		$id_trim = $this->input->post('id_trim');
		$sup_name = $this->input->post('supplier_name');


		$this->db->where('id_trim', $id_trim);
		$this->db->where('supplier_name', $sup_name);
		$data = $this->db->get('v_trimorder_detail')->result();
		echo json_encode($data);
	}








	public function view_po($id = null)
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'View Purchase Order';
		$data['po'] = $this->purchase->get_id_po($id);
		$data['podetil'] = $this->purchase->get_detil_po($id);

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/purchase/view_po', $data);
		$this->load->view('template_oznet/footer');
	}

	public function edit_po($id = null)
	{

		$x = $this->session->userdata('ids');
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Edit Purchase';
		$data['po'] = $this->purchase->get_id_po($id);
		$data['podetil'] = $this->purchase->get_detil_po($id);
		$data['itemtrim'] = $this->purchase->get_detil_itemtrim($x);
		$data['suppliers'] = $this->purchase->get_supplier($x);

		$this->form_validation->set_rules('id_trim', 'Id Trim', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('template_oznet/header', $data);
			$this->load->view('template_oznet/sidebar', $data);
			$this->load->view('administrator/purchase/edit_po', $data);
			$this->load->view('template_oznet/footer');
		} else {
			$datas = [
				'id_po' => $this->input->post('id_po'),
				'po_no' => $this->input->post('po_no'),
				'id_trim' => $this->input->post('id_trim'),
				'id_supplier' => $this->input->post('id_supplier'),
				'request_date' => $this->input->post('request_date'),
				'request_in_house' => $this->input->post('request_in'),
				'delivery_at' => $this->input->post('delivery_at'),
				'allocation' => $this->input->post('allocation'),
				'applicant' => $this->input->post('applicant'),
				'approval' => $this->input->post('approval'),
				'po_status' => 'Process',
				'sub_total' => $this->input->post('sub_total'),
				'rounding' => $this->input->post('rounding'),
				'vat' => $this->input->post('tax'),
				'vat_amount' => $this->input->post('tax_end'),
				'grand_total' => $this->input->post('grand_total_end'),
				'purchase_amount' => $this->input->post('purchase_amount_end'),
				'note1' => $this->input->post('note1'),
				'note2' => $this->input->post('note2'),
				'user' => $this->session->userdata('email')
			];


			$this->db->where('id_po', $this->input->post('id_po'));
			$this->db->update('tb_purchase_order', $datas);
			$this->deleteInvoiceItems();

			for ($count = 0; $count < count($_POST['id_po']); $count++) {
				$datax = array(
					'id_po' => $this->input->post('id_po'),
					'id_item' => $_POST['id_item'][$count],
					'qty' => $_POST['qty'][$count],
					'total_price' => $_POST['total_price'][$count]
				);
				// print_r($datax);
				// $insert = $this->Feature_model->saves($data);
				$this->db->insert('tb_purchase_order_detail', $datax);
			}
			$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">data edited</div>');
			redirect('Controller_Purchase');
		}
	}


	public function deleteInvoiceItems()
	{
		$this->db->where('id_po', $this->input->post('id_po'));
		$this->db->delete('tb_purchase_order_detail');
	}


	public function updates()
	{
		$this->_validate();
		$datas = [
			'id_po' => $this->input->post('id_po'),
			'po_no' => $this->input->post('po_no'),
			'id_trim' => $this->input->post('id_trim'),
			'id_supplier' => $this->input->post('id_supplier'),
			'request_date' => $this->input->post('request_date'),
			'request_in_house' => $this->input->post('request_in'),
			'delivery_at' => $this->input->post('delivery_at'),
			'allocation' => $this->input->post('allocation'),
			'applicant' => $this->input->post('applicant'),
			'approval' => $this->input->post('approval'),
			// 'po_status' => 'Process',
			'sub_total' => $this->input->post('sub_total'),
			'rounding' => $this->input->post('rounding'),
			'vat' => $this->input->post('tax'),
			'vat_amount' => $this->input->post('tax_end'),
			'grand_total' => $this->input->post('grand_total_end'),
			'purchase_amount' => $this->input->post('purchase_amount_end'),
			'note1' => $this->input->post('note1'),
			'note2' => $this->input->post('note2'),
			'user' => $this->session->userdata('email')
		];


		$this->db->where('id_po', $this->input->post('id_po'));
		$this->db->update('tb_purchase_order', $datas);
		$this->deleteInvoiceItems();

		for ($count = 0; $count < count($_POST['id_item']); $count++) {
			$datax = array(
				'id_po' => $this->input->post('id_po'),
				'id_item' => $_POST['id_item'][$count],
				'color' => $_POST['color'][$count],
				'size' => $_POST['size'][$count],
				'qty' => $_POST['qty'][$count],
				'price' => $_POST['item_price'][$count],
				'total_price' => $_POST['total_price'][$count],
			);

			$this->db->insert('tb_purchase_order_detail', $datax);
		}
		$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">data edited</div>');
		redirect('Controller_Purchase');
	}





	public function get_sup($idx)
	{
		$data = $this->purchase->get_supplierx($idx);
		echo json_encode($data);



		// $querc = $this->purchase->get_supplierx($idx);
		// $data = [];
		// $no = 0;

		// foreach ($querc->result() as $r) {
		// 	$no++;
		// 	$row = array();
		// 	$row[] = $no;
		// 	$row[] = $r->supplier_name;
		// 	$row[] = $r->supplier_address;

		// 	//add html for action
		// 	$data[] = $row;
		// };

		// $result = array(
		// 	"data" => $data
		// );

		// echo json_encode($result);
		// exit();
	}



	public function remove($id)
	{
		//delete fil
		$this->purchase->delete_by_id($id);
		$this->purchase->delete_purchasedetil_id($id);
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



	// public function print_pdf($id)
	// {

	// 	$data['piw'] = $this->purchase->get_piw_po($id);
	// 	$data['pow'] = $this->purchase->get_id_po($id);
	// 	$data['po'] = $this->purchase->get_pdf_po($id);
	// 	$data['podetil'] = $this->purchase->get_detil_po($id);

	// 	$this->load->view('administrator/purchase/view_po_pdf', $data);
	// }
}
