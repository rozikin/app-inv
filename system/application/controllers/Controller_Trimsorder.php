<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controller_Trimsorder extends CI_Controller
{
	public function __construct()
	{
		Parent::__construct();
		is_logged_in();
		$this->load->model('Model_Trimsorder', 'trims');
	}

	public function index()
	{
		$data['title'] = 'Manage Trim Order';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/trimorder/index');
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
			$row[] = $r->remark;
			$row[] = $r->user;

			//add html for action
			$row[] = '
			<a class="badge badge-warning" href="javascript:void(0)" title="Edit" onclick="detail_data(' . "'" . $r->id_trim . "'" . ')"><i class="fas fa-info"></i> Detail</a>
			<a class="badge badge-primary" href="javascript:void(0)" title="Edit" onclick="edit_data(' . "'" . $r->id_trim . "'" . ')"><i class="fas fa-edit"></i> Edit</a>
            <a class="badge badge-danger" href="javascript:void(0)" title="Hapus" onclick="deleted(' . "'" . $r->id_trim . "'" . ')"><i class="fas fa-trash"></i> Delete</a>';
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


		$data['title'] = 'Add Trims Order';
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

	public function detail_trim($id)
	{
		// Datatables Variables

		$querc = $this->trims->get_id($id);
		$data = [];
		$no = 0;

		foreach ($querc->result() as $r) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $r->item_code;
			$row[] = $r->item_description;
			$row[] = $r->supplier_name;
			$row[] = $r->size_code;
			$row[] = $r->color;
			$row[] = $r->qty;
			$row[] = $r->detail_remark;
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

		// print_r($datas);
		$this->db->insert('tb_trim_order', $datas);
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
		$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">New data added</div>');
		redirect('Controller_Trimsorder');
	}


	public function edit_trim($id = null)
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Edit Item';
		$data['trimx'] = $this->trims->get_id_trims($id);
		$data['trimdetil'] = $this->trims->get_id_trims_detil($id);
		$data['item'] = $this->trims->get_item();
		$data['size'] = $this->trims->get_size();
		$data['colors'] = $this->trims->get_color();

		$this->form_validation->set_rules('id_trim', 'Id Trim', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('template_oznet/header', $data);
			$this->load->view('template_oznet/sidebar', $data);
			$this->load->view('administrator/trimorder/edit_trim_order', $data);
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


	public function remove($id)
	{
		//delete fil
		$this->trims->delete_by_id($id);
		$this->trims->delete_detail_id($id);
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
