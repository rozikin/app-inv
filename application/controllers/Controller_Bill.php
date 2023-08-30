<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controller_Bill extends CI_Controller
{
	public function __construct()
	{
		Parent::__construct();
		is_logged_in();
		$this->load->model('Model_bill', 'bill');
	}

	public function kode_otomatis()
	{
		$data =  $this->bill->buat_kode();
		echo json_encode($data);
	}

	public function kode_otomatis_po()
	{
		$data =  $this->bill->buat_kode_po();
		echo json_encode($data);
	}


	public function index()
	{
		$data['title'] = 'bill';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/bill/index_bill');
		$this->load->view('template_oznet/footer');
	}

	public function request_bill()
	{
		$data['title'] = 'Request Order';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/bill/index');
		$this->load->view('template_oznet/footer');
	}

	public function get_data_bill()
	{
		// Datatables Variables

		$draw = intval($this->input->get("draw"));
		$this->db->order_by("id_po", "desc");
		$this->db->where("id_po >", 0);
		$this->db->where("po_status", 'Recived');
		$query = $this->db->get("v_purchase_manage");
		$data = [];
		$no = 0;


		foreach ($query->result() as $r) {

			$this->db->where('id_po', $r->id_po);
			// $this->db->where('po_status', 'Recived');
			$s = $this->db->get('tb_purchase_order_detail');
			$li = $s->num_rows();

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $r->po_no;
			$row[] = $r->request_date;
			// $row[] = $r->trim_mo;
			// $row[] = $r->trim_date;
			$row[] = $li;
			// $row[] = '<a class="badge badge-success">' . $r->trim_status . '</a>';
			$row[] = $r->supplier_name;
			$row[] = $r->po_status == 'Process' ? '<a class="badge badge-warning">' . $r->po_status . '</a>' : '<a class="badge badge-success">' . $r->po_status . '</a>';
			$row[] = $r->delivery_at;

			$row[] =  number_format($r->purchase_amount);



			//add html for action
			// $row[] = '
			// <a class="badge badge-warning" href="javascript:void(0)" title="Edit" onclick="detail_data(' . "'" . $r->id_po . "'" . ')"><i class="fas fa-info"></i> Detail</a>
			// <a class="badge badge-primary" href="javascript:void(0)" title="Edit" onclick="edit_data(' . "'" . $r->id_po . "'" . ')"><i class="fas fa-edit"></i> Edit</a>
			// <a class="badge badge-info" href="javascript:void(0)" title="Edit" onclick="view_data(' . "'" . $r->id_po . "'" . ')"><i class="fas fa-eye"></i> View</a>';
			$row[] = '

			<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
			Action
			<span class="sr-only">Toggle Dropdown</span>
			</button>
			
			<div class="dropdown-menu" role="menu">
		
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


	public function add_bill()
	{
		$data['title'] = 'bill Order';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['item'] = $this->bill->get_itemc();
		$data['size'] = $this->bill->get_size();
		$data['color'] = $this->bill->get_color();
		$data['supplier'] = $this->bill->get_supplier();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/bill/add_bill_order', $data);
		$this->load->view('template_oznet/footer');
	}

	public function detail_trim($id)
	{
		// Datatables Variables

		$querc = $this->bill->get_detil_id($id);
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
			$row[] = $r->qty;
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


	public function detail_bill($id)
	{
		// Datatables Variables

		$querc = $this->bill->get_detil_bill($id);
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
			'po_status' => 'Process',
			'sub_total' => $this->input->post('sub_total'),
			'rounding' => $this->input->post('rounding'),
			'vat' => $this->input->post('tax'),
			'vat_amount' => $this->input->post('tax_end'),
			'grand_total' => $this->input->post('grand_total_end'),
			'bill_amount' => $this->input->post('bill_amount_end'),
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
		$this->db->insert('tb_bill_order', $datas);



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
			$this->db->insert('tb_bill_order_detail', $datax);
		}
		$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">New data added</div>');
		redirect('Controller_bill');
	}

	public function proses_po($id)
	{
		$xs = $this->session->userdata('idx');


		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Add bill Order';
		$data['trimx'] = $this->bill->get_id_trim($id);
		$data['suppliers'] = $this->bill->get_supplier($id);
		$data['itemtrim'] = $this->bill->get_detil_itemtrim($id);


		$this->form_validation->set_rules('item_code', 'Item Code', 'required');
		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/bill/proses_po', $data);
		$this->load->view('template_oznet/footer');
	}


	public function add_bill_un()
	{

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Add bill Order';
		// $data['trimx'] = $this->bill->get_id_trim();
		$data['suppliers'] = $this->bill->get_supplier_po();
		$data['itemtrim'] = $this->bill->get_detil_itemtrim_po();


		$this->form_validation->set_rules('item_code', 'Item Code', 'required');
		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/bill/add_po_un', $data);
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
		$data['title'] = 'View bill Order';
		$data['po'] = $this->bill->get_id_po($id);
		$data['podetil'] = $this->bill->get_detil_po($id);

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/bill/view_po', $data);
		$this->load->view('template_oznet/footer');
	}

	public function edit_po($id = null)
	{

		$x = $this->session->userdata('ids');
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Edit bill';
		$data['po'] = $this->bill->get_id_po($id);
		$data['podetil'] = $this->bill->get_detil_po($id);
		$data['itemtrim'] = $this->bill->get_detil_itemtrim($x);
		$data['suppliers'] = $this->bill->get_supplier($x);

		$this->form_validation->set_rules('id_trim', 'Id Trim', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('template_oznet/header', $data);
			$this->load->view('template_oznet/sidebar', $data);
			$this->load->view('administrator/bill/edit_po', $data);
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
				'po_status' => 'Process',
				'sub_total' => $this->input->post('sub_total'),
				'rounding' => $this->input->post('rounding'),
				'vat' => $this->input->post('tax'),
				'vat_amount' => $this->input->post('tax_end'),
				'grand_total' => $this->input->post('grand_total_end'),
				'bill_amount' => $this->input->post('bill_amount_end'),
				'note1' => $this->input->post('note1'),
				'note2' => $this->input->post('note2'),
				'user' => $this->session->userdata('email')
			];


			$this->db->where('id_po', $this->input->post('id_po'));
			$this->db->update('tb_bill_order', $datas);
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
				$this->db->insert('tb_bill_order_detail', $datax);
			}
			$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">data edited</div>');
			redirect('Controller_bill');
		}
	}


	public function deleteInvoiceItems()
	{
		$this->db->where('id_po', $this->input->post('id_po'));
		$this->db->delete('tb_bill_order_detail');
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
			'po_status' => 'Process',
			'sub_total' => $this->input->post('sub_total'),
			'rounding' => $this->input->post('rounding'),
			'vat' => $this->input->post('tax'),
			'vat_amount' => $this->input->post('tax_end'),
			'grand_total' => $this->input->post('grand_total_end'),
			'bill_amount' => $this->input->post('bill_amount_end'),
			'note1' => $this->input->post('note1'),
			'note2' => $this->input->post('note2'),
			'user' => $this->session->userdata('email')
		];


		$this->db->where('id_po', $this->input->post('id_po'));
		$this->db->update('tb_bill_order', $datas);
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

			$this->db->insert('tb_bill_order_detail', $datax);
		}
		$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">data edited</div>');
		redirect('Controller_bill');
	}





	public function get_sup($idx)
	{
		$data = $this->bill->get_supplierx($idx);
		echo json_encode($data);



		// $querc = $this->bill->get_supplierx($idx);
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
		$this->bill->delete_by_id($id);
		$this->bill->delete_billdetil_id($id);
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

	// 	$data['piw'] = $this->bill->get_piw_po($id);
	// 	$data['pow'] = $this->bill->get_id_po($id);
	// 	$data['po'] = $this->bill->get_pdf_po($id);
	// 	$data['podetil'] = $this->bill->get_detil_po($id);

	// 	$this->load->view('administrator/bill/view_po_pdf', $data);
	// }
}
