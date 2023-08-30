<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controller_Item extends CI_Controller
{
	public function __construct()
	{
		Parent::__construct();
		is_logged_in();
		$this->load->model('Model_Item', 'item');
	}

	public function index()
	{
		$data['title'] = 'Item List';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		//konek model
		$data['item'] = $this->item->get_item();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/item/index', $data);
		$this->load->view('template_oznet/footer');
	}

	public function get_data()
	{
		// Datatables Variables
		$draw = intval($this->input->get("draw"));


		$this->db->order_by("id_item", "desc");
		$query = $this->db->get("v_items");
		$data = [];
		$no = 0;

		foreach ($query->result() as $r) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $r->item_code;
			$row[] = $r->item_description;
			$row[] = $r->supplier_name;
			$row[] = $r->color;
			$row[] = $r->size_code;
			$row[] = $r->item_price;
			$row[] = $r->currency;
			$row[] = $r->unit;
			$row[] = $r->remark;

			//add html for action
			$row[] = '<a class="badge badge-primary" href="javascript:void(0)" title="Edit" onclick="edit_data(' . "'" . $r->id_item . "'" . ')"><i class="fas fa-edit"></i> Edit</a>
            <a class="badge badge-danger" href="javascript:void(0)" title="Hapus" onclick="deleted(' . "'" . $r->id_item . "'" . ')"><i class="fas fa-trash"></i> Delete</a>';
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

	public function add_item()
	{
		$data['title'] = 'Add Item';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['supplier'] = $this->item->get_supplier();
		$data['size'] = $this->item->get_size();
		$data['color'] = $this->item->get_color();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/item/add_item', $data);
		$this->load->view('template_oznet/footer');
	}



	public function create()
	{
		$this->_validate();
		$data = [
			'item_code' => $this->input->post('item_code'),
			'item_description' => $this->input->post('item_description'),
			'id_supplier' => $this->input->post('id_supplier'),
			'id_size' => $this->input->post('id_size'),
			'id_color' => $this->input->post('id_color'),
			'item_price' => $this->input->post('item_price'),
			'currency' => $this->input->post('currency'),
			'unit' => $this->input->post('unit'),
			'remark' => $this->input->post('remark')
		];


		$this->item->save('tb_items', $data);
		echo json_encode(array("status" => TRUE));
	}



	public function edit_item($id)
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Edit Item';
		$data['items'] = $this->item->getID($id);
		$data['supplier'] = $this->item->get_supplier();
		$data['size'] = $this->item->get_size();
		$data['color'] = $this->item->get_color();

		$this->form_validation->set_rules('item_code', 'Item Code', 'required');

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/item/edit_item', $data);
		$this->load->view('template_oznet/footer');
	}

	public function update()
	{
		$id = $this->input->post('id_item');
		$data = [
			'item_code' => $this->input->post('item_code'),
			'item_description' => $this->input->post('item_description'),
			'id_supplier' => $this->input->post('id_supplier'),
			'id_size' => $this->input->post('id_size'),
			'id_color' => $this->input->post('id_color'),
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
