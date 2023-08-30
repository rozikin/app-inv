<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controller_Trimsorder extends CI_Controller
{
	public function __construct()
	{
		Parent::__construct();
		is_logged_in();
		$this->load->model('Model_Trimsorder', 'trims');
		$this->load->library('excel');
	}

	public function index()
	{
		$data['title'] = 'Trim Order';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/trimorder/index');
		$this->load->view('template_oznet/footer');
	}



	public function request_report()
	{
		$data['title'] = 'Trim Order / Request Report';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/trimorder/request_rp');
		$this->load->view('template_oznet/footer');
	}



	public function get_data2()
	{
		$category = $this->db->query("select * from tb_trim_order")->result();


		foreach ($category as $key) {
			$subcategory = $this->db->query("select * from v_trimorder_fix where id_trim = '" . $key->id_trim . "'")->get()->result();
			foreach ($subcategory as $cat) {
				$product = $this->db->query("select * from tb_product where id_trim = '" . $key->id_trim . "'")->result();
				$key->sub_category = array(
					'sub_category_name' => $cat
				);
				foreach ($product as $prod) {
					$key->product = array(
						'product' => $prod
					);
				}
			}
		}

		echo json_encode($category);
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
			$s = $this->db->get('v_trimorder_detail');
			$x = $s->result_array();
			$l = $s->num_rows();
			$no++;
			$rows = '';

			$row = array();
			$row[] = $no;
			$row[] = $r->order_no;
			$row[] = $r->trim_code;
			$row[] = $r->trim_mo;
			$row[] = $r->trim_style;
			$row[] = $r->trim_destination;
			$row[] = $r->trim_date;
			$row[] = $r->trim_status == 'Request' ? '<a class="badge badge-warning">' . $r->trim_status . '</a>' : '<a class="badge badge-success">' . $r->trim_status . '</a>';
			$row[] = $r->trim_date;
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
				<a class="dropdown-item" onclick="detail_data(' . "'" . $r->id_trim . "'" . ')"><span class="fa fa-info text-primary"></span> Detail</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" onclick="edit_data(' . "'" . $r->id_trim . "'" . ')"><span class="fa fa-edit text-primary"></span> Edit</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" onclick="view_data(' . "'" . $r->id_trim . "'" . ')"><span class="fa fa-eye text-primary"></span> View</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" onclick="deleted(' . "'" . $r->id_trim . "'" . ')"><span class="fa fa-trash text-danger"></span> Delete</a>
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



	public function get_data_report()
	{

		$draw = intval($this->input->get("draw"));
		$this->db->order_by("id_trim", "desc");
		$this->db->where("id_trim >", 0);
		$query = $this->db->get("v_trimorder_fix");
		$data = [];
		$no = 0;


		foreach ($query->result() as $r) {

			$no++;


			$row = array();
			$row[] = $no;
			$row[] = $r->order_no;
			$row[] = $r->sample_code;
			$row[] = $r->trim_code;
			$row[] = $r->trim_mo;
			$row[] = $r->trim_style;
			$row[] = $r->trim_destination;
			$row[] = $r->trim_date;
			$row[] = $r->trim_status == 'Request' ? '<a class="badge badge-warning">' . $r->trim_status . '</a>' : '<a class="badge badge-success">' . $r->trim_status . '</a>';
			$row[] = $r->item_code;
			$row[] = $r->item_description;
			$row[] = $r->color;
			$row[] = $r->size;
			$row[] = $r->qty;

			$row[] = $r->User;

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




	public function add_trim_order()
	{

		$data['title'] = 'Add Request';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['item'] = $this->trims->get_item();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/trimorder/add_trim_order', $data);
		$this->load->view('template_oznet/footer');
	}

	public function kode_otomatis()
	{
		$data =  $this->trims->buat_kode();
		echo json_encode($data);
	}

	public function kode_otomatis_id()
	{
		$data =  $this->trims->buat_kode_id();
		echo json_encode($data);
	}


	public function detail_trim($id)
	{
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$query = $this->trims->get_id($id);
		$data = [];
		$no = 0;

		foreach ($query->result() as $r) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $r->item_code;
			$row[] = $r->item_description;
			$row[] = $r->supplier_name;
			$row[] = $r->size;
			$row[] = $r->color;
			$row[] = $r->total;
			$row[] = $r->detail_remark;
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
			'id_trim' => $this->input->post('id_trim'),
			'order_no' => $this->input->post('order_no'),
			'sample_code' => $this->input->post('sample_code'),
			'trim_code' => $this->input->post('trim_code'),
			'trim_mo' => $this->input->post('trim_mo'),
			'trim_style' => $this->input->post('trim_style'),
			'trim_destination' => $this->input->post('trim_destination'),
			'trim_date' => $this->input->post('trim_date'),
			'trim_status' => $this->input->post('trim_status'),
			'remark' => $this->input->post('trim_remark'),
			'user' => $this->session->userdata('email')
		];

		$data2 = [
			'id_trim' => $this->input->post('id_trim'),

		];

		// print_r($datas);
		$this->db->insert('tb_trim_order', $datas);
		// $this->db->insert('tb_tracking', $data2);
		for ($count = 0; $count < count($_POST['id_item']); $count++) {
			$datax = array(
				'id_trim' => $this->input->post('id_trim'),
				'id_item' => $_POST['id_item'][$count],
				'color' => $_POST['color'][$count],
				'size' => $_POST['size'][$count],
				'qty' => $_POST['qty'][$count],
				'consumtion' => $_POST['consumtion'][$count],
				'allowance' => $_POST['allowance'][$count],
				'total' => $_POST['total_qty'][$count],
				'remark' => $_POST['remark'][$count]
			);
			// print_r($datax);
			// $insert = $this->Feature_model->saves($data);
			$this->db->insert('tb_trim_detail', $datax);
		}
		$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">New data added</div>');
		redirect('Controller_Trimsorder');
	}


	public function create_req()
	{
		$this->_validate();
		$datas = [
			'id_trim' => $this->input->post('id_trim'),
			'order_no' => '',
			'sample_code' => '',
			'trim_code' => $this->input->post('trim_code'),
			'trim_mo' => $this->input->post('trim_mo'),
			'trim_style' => $this->input->post('trim_style'),
			'trim_destination' => $this->input->post('trim_destination'),
			'trim_date' => $this->input->post('trim_date'),
			'trim_status' => $this->input->post('trim_status'),
			'remark' => $this->input->post('trim_remark'),
			'user' => $this->session->userdata('email')
		];


		$this->db->insert('tb_trim_order', $datas);

		for ($count = 0; $count < count($_POST['id_item']); $count++) {
			$datax = array(
				'id_trim' => $this->input->post('id_trim'),
				'id_item' => $_POST['id_item'][$count],
				'color' => $_POST['color'][$count],
				'size' => $_POST['size'][$count],
				'qty' => $_POST['qty'][$count],
				'consumtion' => $_POST['consumtion'][$count],
				'allowance' => $_POST['allowance'][$count],
				'total' => $_POST['total_qty'][$count],
				'remark' => $_POST['remark'][$count]
			);

			$this->db->insert('tb_trim_detail', $datax);
		}
		$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">New data added</div>');
		redirect('Controller_Trimsorder');
	}



	public function edit_trim($id = null)
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Edit Trim';
		$data['trimx'] = $this->trims->get_id_trims($id);
		$data['trimdetil'] = $this->trims->get_id_trims_detil($id);
		$data['item'] = $this->trims->get_item();
		$data['trimdetil'] = $this->trims->get_id_trims_detil($id);
		$data['cbddetil'] = $this->trims->get_id_cbd_detil1($id);

		$pivot = $this->trims->rekap_penjualan1($id);
		$datax  = array(
			'color'      => $this->trims->get_bulan1($id),
			'size'      => $this->trims->get_jenis1($id),
			'rekap_data' => $pivot['datax'],
		);



		$this->form_validation->set_rules('id_trim', 'Id Trim', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('template_oznet/header', $data);
			$this->load->view('template_oznet/sidebar', $data);
			$this->load->view('administrator/trimorder/edit_trim_order', $datax);
			$this->load->view('template_oznet/footer');
		} else {
			$datas = [
				'id_trim' => $this->input->post('id_trim'),
				'order_no' => $this->input->post('order_no'),
				'sample_code' => $this->input->post('sample_code'),
				'trim_code' => $this->input->post('trim_code'),
				'trim_mo' => $this->input->post('trim_mo'),
				'trim_style' => $this->input->post('trim_style'),
				'trim_destination' => $this->input->post('trim_destination'),
				'trim_date' => $this->input->post('trim_date'),
				'trim_status' => $this->input->post('trim_status'),
				'remark' => $this->input->post('trim_remark'),
				'user' => $this->session->userdata('email')
			];

			$this->db->where('id_trim', $this->input->post('id_trim'));
			$this->db->update('tb_trim_order', $datas);
			$this->deleteInvoiceItems();

			for ($count = 0; $count < count($_POST['id_item']); $count++) {
				$datax = array(
					'id_trim' => $this->input->post('id_trim'),
					'id_item' => $_POST['id_item'][$count],
					'color' => $_POST['color'][$count],
					'size' => $_POST['size'][$count],
					'qty' => $_POST['qty'][$count],
					'consumtion' => $_POST['consumtion'][$count],
					'allowance' => $_POST['allowance'][$count],
					'total' => $_POST['total_qty'][$count],
					'remark' => $_POST['remark'][$count]
				);
				// print_r($datax);
				// $insert = $this->Feature_model->saves($data);
				$this->db->insert('tb_trim_detail', $datax);
			}
			$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">data edited</div>');
			redirect('Controller_Trimsorder');
		}
	}

	public function deleteInvoiceItems()
	{
		$this->db->where('id_trim', $this->input->post('id_trim'));
		$this->db->delete('tb_trim_detail');
	}

	public function update()
	{
		$id = $this->input->post('id_item');
		$data = [
			'id_trim' => $this->input->post('id_trim'),
			'trim_code' => $this->input->post('trim_code'),
			'trim_style' => $this->input->post('trim_style'),
			'trim_destination' => $this->input->post('trim_destination'),
			'trim_date' => $this->input->post('trim_date'),
			'trim_status' => $this->input->post('trim_status'),
			'remark' => $this->input->post('trim_remark'),
			'user' => $this->session->userdata('email')
		];

		$this->item->update_data('tb_items', $data, $id);
	}


	public function view_trim($id = null)
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'View Trim Order';
		$data['trimx'] = $this->trims->get_id_trims($id);
		$data['trimdetil'] = $this->trims->get_id_trims_detil($id);
		$data['item'] = $this->trims->get_item();
		$data['size'] = $this->trims->get_size();
		$data['colors'] = $this->trims->get_color();


		$pivot = $this->trims->rekap_penjualan1($id);
		$datax  = array(
			'color'      => $this->trims->get_bulan1($id),
			'size'      => $this->trims->get_jenis1($id),
			'rekap_data' => $pivot['datax'],
		);



		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/trimorder/view_trim', $datax);
		$this->load->view('template_oznet/footer');
	}





	public function remove($id)
	{
		//delete fil
		$this->trims->delete_by_id($id);
		$this->trims->delete_detail_id($id);

		echo json_encode(array("status" => TRUE));
	}



	public function cbd()
	{
		$data['title'] = 'CBD';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['cbds'] = $this->db->get('v_cbd')->result_array();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/trimorder/cbd');
		$this->load->view('template_oznet/footer');
	}



	function import()
	{

		if (isset($_FILES["file"]["name"])) {
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);

			foreach ($object->getWorksheetIterator() as $worksheet) {
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();


				for ($row = 3; $row <= 3; $row++) {
					$order_no = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$supplier_raw_material = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
					$item = $worksheet->getCellByColumnAndRow(31, $row)->getValue();
					$sample_code = $worksheet->getCellByColumnAndRow(33, $row)->getValue();

					$data[] = array(
						'order_no'  => $order_no,
						'supplier_raw_material_code'   => $supplier_raw_material,
						'item'  => $item,
						'sample_code'  => $sample_code,

					);
				}

				for ($row = 3; $row <= $highestRow; $row++) {
					$order_nox = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$color_code = $worksheet->getCellByColumnAndRow(36, $row)->getValue();
					$color = $worksheet->getCellByColumnAndRow(37, $row)->getValue();
					$size_code = $worksheet->getCellByColumnAndRow(39, $row)->getValue();
					$size = $worksheet->getCellByColumnAndRow(40, $row)->getValue();
					$qty = $worksheet->getCellByColumnAndRow(41, $row)->getValue();

					$data2[] = array(
						'order_no'  => $order_nox,
						'color_code'   => $color_code,
						'color'  => $color,
						'size_code'  => $size_code,
						'size'  => $size,
						'qty'  => $qty,

					);
				}
			}


			$this->db->where('order_no', $order_no);
			$num = $this->db->get('tb_cbd')->num_rows();

			if ($num == 0) {
				echo  $this->trims->insert($data);
				echo $this->trims->save_detil($data2);


				$message = array(
					'message' => '<div class="alert alert-success">Import file excel berhasil disimpan di database</div>',
				);

				$this->session->set_flashdata($message);
				redirect('Controller_Trimsorder/cbd');
			} else {

				$message = array(
					'message' => '<div class="alert alert-danger">Import file excel gagal data duplikat</div>',
				);

				$this->session->set_flashdata($message);
				redirect('Controller_Trimsorder/cbd');
			}
		} else {
			$message = array(
				'message' => '<div class="alert alert-danger">Import file excel not complete</div>',
			);

			$this->session->set_flashdata($message);
			redirect('Controller_Trimsorder/cbd');
		}
	}




	public function get_cbd()
	{
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$this->db->order_by("id", "desc");
		// $this->db->where("id_trim >", 0);
		$query = $this->db->get("tb_cbd");
		$data = [];
		$no = 0;

		foreach ($query->result() as $r) {
			// $this->db->where('id_trim', $r->id_trim);
			// $s = $this->db->get('tb_trim_detail');
			// $l = $s->num_rows();
			$no++;


			$row = array();
			$row[] = $no;
			$row[] = $r->order_no;
			$row[] = $r->supplier_raw_material_code;
			$row[] = $r->item;
			$row[] = $r->sample_code;


			$row[] = '

			<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
			Action
			<span class="sr-only">Toggle Dropdown</span>
			</button>
			<div class="dropdown-menu" role="menu">
			
			<a class="dropdown-item" onclick="create_data(' . "'" . $r->order_no . "'" . ')"><span class="fa fa-edit text-primary"></span> Create Trim</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" onclick="view_data(' . "'" . $r->order_no . "'" . ')"><span class="fa fa-eye text-primary"></span> View</a>
			<div class="dropdown-divider"></div>
			
			<a class="dropdown-item" onclick="deleted(' . "'" . $r->order_no . "'" . ')"><span class="fa fa-trash text-danger"></span> Delete</a>
			</div>
			';

			//add html for action
			// $row[] = '
			// <a class="badge badge-warning" href="javascript:void(0)" title="Edit" onclick="detail_data(' . "'" . $r->id_trim . "'" . ')"><i class="fas fa-info"></i> Detail</a>
			// <a class="badge badge-primary" href="javascript:void(0)" title="Edit" onclick="edit_data(' . "'" . $r->id_trim . "'" . ')"><i class="fas fa-edit"></i> Edit</a>
			// <a class="badge badge-danger" href="javascript:void(0)" title="Hapus" onclick="deleted(' . "'" . $r->id_trim . "'" . ')"><i class="fas fa-trash"></i> Delete</a>';
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


	public function remove_cbd($id)
	{
		//delete fil
		$this->trims->delete_cbd_id($id);
		$this->trims->delete_cbddetil_id($id);

		echo json_encode(array("status" => TRUE));
	}




	public function detail_cbd($id)
	{
		// Datatables Variables
		// $data_id = $_POST["data_id"];
		$querc = $this->trims->get_cbd_id($id);
		$data = [];
		$no = 0;

		foreach ($querc->result() as $r) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $r->order_no;
			$row[] = $r->color_code;
			$row[] = $r->color;
			$row[] = $r->size_code;
			$row[] = $r->size;
			$row[] = $r->qty;
			// 	// 	//add html for action

			$data[] = $row;
		};

		$result = array(
			"data" => $data
		);

		echo json_encode($result);
		exit();
	}




	public function create_trim($id = null)
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Create Trim';
		$data['cbd'] = $this->trims->get_id_cbd($id);
		$data['item'] = $this->trims->get_item();
		$data['cbddetil'] = $this->trims->get_id_cbd_detil($id);
		$data['trimdetil'] = $this->trims->get_id_trims_detil($id);

		$pivot = $this->trims->rekap_penjualan($id);
		$datax  = array(
			'color'      => $this->trims->get_bulan($id),
			'size'      => $this->trims->get_jenis($id),
			'rekap_data' => $pivot['datax'],
		);




		$this->form_validation->set_rules('id_trim', 'Id Trim', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('template_oznet/header', $data);
			$this->load->view('template_oznet/sidebar', $data);
			$this->load->view('administrator/trimorder/create_trim_order', $datax);
			$this->load->view('template_oznet/footer');
		} else {
			$datas = [
				'id_trim' => $this->input->post('id_trim'),
				'trim_code' => $this->input->post('trim_code'),
				'trim_mo' => $this->input->post('trim_mo'),
				'trim_style' => $this->input->post('trim_style'),
				'trim_destination' => $this->input->post('trim_destination'),
				'trim_date' => $this->input->post('trim_date'),
				'trim_status' => $this->input->post('trim_status'),
				'remark' => $this->input->post('trim_remark'),
				'user' => $this->session->userdata('email')
			];

			$this->db->where('id_trim', $this->input->post('id_trim'));
			$this->db->update('tb_trim_order', $datas);
			$this->deleteInvoiceItems();

			for ($count = 0; $count < count($_POST['id_item']); $count++) {
				$datax = array(
					'id_trim' => $this->input->post('id_trim'),
					'id_item' => $_POST['id_item'][$count],
					'qty' => $_POST['qty'][$count],
					'remark' => $_POST['remark'][$count]
				);
				// print_r($datax);
				// $insert = $this->Feature_model->saves($data);
				$this->db->insert('tb_trim_detail', $datax);
			}
			$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">data edited</div>');
			redirect('Controller_Trimsorder');
		}
	}



















	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('trim_code') == '') {
			$data['inputerror'][] = 'trim_code';
			$data['error_string'][] = 'item code name is required';
			$data['status'] = FALSE;
		}
		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
}
