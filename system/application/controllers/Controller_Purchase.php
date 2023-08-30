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

	public function index()
	{
		$data['title'] = 'Request Order';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/purchase/index');
		$this->load->view('template_oznet/footer');
	}

	public function request_purchase()
	{
		$data['title'] = 'Request Order';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/purchase/index');
		$this->load->view('template_oznet/footer');
	}



	public function get_data()
	{
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$this->db->order_by("id_trim", "desc");
		$query = $this->db->get("tb_trim_order");
		$data = [];
		$no = 0;

		foreach ($query->result() as $r) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $r->trim_code;
			$row[] = $r->trim_mo;
			$row[] = $r->trim_style;
			$row[] = $r->trim_destination;
			$row[] = $r->trim_date;
			$row[] = '<a class="badge badge-success">' . $r->trim_status . '</a>';

			$row[] = $r->user;

			//add html for action
			$row[] = '
			<a class="badge badge-warning" href="javascript:void(0)" title="Edit" onclick="detail_data(' . "'" . $r->trim_code . "'" . ')"><i class="fas fa-info"></i> Detail</a>
			<a class="badge badge-primary" href="javascript:void(0)" title="Edit" onclick="edit_data(' . "'" . $r->trim_code . "'" . ')"><i class="fas fa-play"></i>  Proses</a>';
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
		$data['title'] = 'Trim Order';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['item'] = $this->purchase->get_item();
		$data['size'] = $this->purchase->get_size();
		$data['color'] = $this->purchase->get_color();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/purchase/add_purchase_order', $data);
		$this->load->view('template_oznet/footer');
	}

	public function detail_trim($id)
	{
		// Datatables Variables

		$querc = $this->purchase->get_id($id);
		$data = [];
		$no = 0;

		foreach ($querc->result() as $r) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $r->item_code;
			$row[] = $r->item_remark;
			$row[] = $r->item_description;
			$row[] = $r->supplier_name;
			$row[] = $r->size_code;
			$row[] = $r->color_code;
			$row[] = $r->qty;
			$row[] = $r->remark;
			//add html for action
			$data[] = $row;
		};

		$result = array(
			"data" => $data
		);

		echo json_encode($result);
		exit();
	}




	public function create()
	{
		$this->_validate();
		$datas = [
			'trim_code' => $this->input->post('trim_code'),
			'trim_style' => $this->input->post('trim_style'),
			'trim_destination' => $this->input->post('trim_destination'),
			'trim_date' => $this->input->post('trim_date'),
			'trim_status' => $this->input->post('trim_status'),
			'remark' => $this->input->post('trim_remark'),
			'user' => $this->session->userdata('email')
		];

		// print_r($datas);
		$this->db->insert('tb_trim_order', $datas);
		for ($count = 0; $count < count($_POST['id_item']); $count++) {
			$datax = array(
				'trim_code' => $this->input->post('trim_code'),
				'id_item' => $_POST['id_item'][$count],
				'id_size' => $_POST['id_size'][$count],
				'id_color' => $_POST['id_color'][$count],
				'qty' => $_POST['qty'][$count],
				'remark' => $_POST['remark'][$count]
			);
			// print_r($datax);
			// $insert = $this->Feature_model->saves($data);
			$this->db->insert('tb_trim_detail', $datax);
		}
		$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">New data added</div>');
		redirect('controller_purchaseorder');
	}


	public function edit_trim($id)
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Edit Item';
		$data['trimx'] = $this->purchase->get_id_purchase($id);
		$data['trimdetil'] = $this->purchase->get_id_purchase_detil($id);
		$data['item'] = $this->purchase->get_item();
		$data['size'] = $this->purchase->get_size();
		$data['color'] = $this->purchase->get_color();

		$this->form_validation->set_rules('item_code', 'Item Code', 'required');
		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/trimorder/edit_trim_order', $data);
		$this->load->view('template_oznet/footer');
	}

	public function update()
	{
		$id = $this->input->post('id_item');
		$data = [
			'item_code' => $this->input->post('item_code'),
			'item_description' => $this->input->post('item_description'),
			'id_supplier' => $this->input->post('id_supplier'),
			'item_price' => $this->input->post('item_price'),
			'currency' => $this->input->post('currency'),
			'unit' => $this->input->post('unit'),
			'remark' => $this->input->post('remark')
		];

		$this->item->update_data('tb_items', $data, $id);
	}


	public function remove($id)
	{
		//delete fil
		$this->item->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('item_code') == '') {
			$data['inputerror'][] = 'item_code';
			$data['error_string'][] = 'item code name is required';
			$data['status'] = FALSE;
		}
		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
}
