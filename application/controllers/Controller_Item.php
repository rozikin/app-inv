<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controller_Item extends CI_Controller
{
	public function __construct()
	{

		Parent::__construct();

		is_logged_in();
		$this->load->model('Model_Item', 'item');
		$this->load->library('excel');
		$this->load->library('pagination');
		$this->load->helper('url');
	}




	public function index()
	{
		$data['title'] = 'Item';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		//konek model

		$data['item'] = $this->item->get_item();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/item/index', $data);
		$this->load->view('template_oznet/footer');
	}


	public function Import_Item()
	{
		$data['title'] = 'Item';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		//konek model

		$data['item'] = $this->item->get_item();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/item/index_import', $data);
		$this->load->view('template_oznet/footer');
	}


	public function get_data_index()
	{
		// Datatables Variables
		$draw = intval($this->input->get("draw"));

		$this->db->order_by("id_item", "desc");
		$this->db->where("id_item >", 0);
		$query = $this->db->get("tb_items");
		$data = [];
		$no = 0;

		foreach ($query->result() as $r) {

			$this->db->where('id_category', $r->id_category);
			$xx = $this->db->get('tb_category');
			$this->db->where('id_unit', $r->id_unit);
			$s = $this->db->get('tb_unit');

			$row_category = '';
			$row_unit = '';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $r->item_code;
			$row[] = $r->item_description;
			foreach ($xx->result() as $key) {
				$row_category .= $key->name_category;
			};

			$row[] = $row_category;
			foreach ($s->result() as $key) {
				$row_unit .= $key->code_unit;
			};
			$row[] = $row_unit;
			$row[] = $r->linex;
			if ($r->remark)
				$row[] = '<a href="' . base_url('./assets/images/item/' . $r->remark) . '" target="_blank"><img src="' . base_url('./assets/images/item/' . $r->remark) . '"/></a>';
			else
				$row[] = '(No barcode)';

			$row[] = '
			<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
			Action
	  		<span class="sr-only">Toggle Dropdown</span>
			</button>

			<div class="dropdown-menu" role="menu">
	  		<a class="dropdown-item" onclick="edit_data(' . "'" . $r->id_item . "'" . ')"><span class="fa fa-edit text-primary"></span> Edit</a>
	  		<div class="dropdown-divider"></div>
	  	
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

		$this->db->order_by("id_item", "desc");
		$this->db->where("id_item >", 0);
		$query = $this->db->get("tb_items");
		$data = [];
		$no = 0;

		foreach ($query->result() as $r) {
			$this->db->where('id_category', $r->id_category);
			$xx = $this->db->get('tb_category');
			$this->db->where('id_unit', $r->id_unit);
			$s = $this->db->get('tb_unit');

			$row_category = '';
			$row_unit = '';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $r->item_code;
			$row[] = $r->item_description;
			foreach ($xx->result() as $key) {
				$row_category .= $key->name_category;
			};

			$row[] = $row_category;
			foreach ($s->result() as $key) {
				$row_unit .= $key->code_unit;
			};
			$row[] = $row_unit;
			$row[] = $r->linex;
			$row[] = $r->status;
			// if ($r->remark)
			// 	$row[] = '<a href="' . base_url('./assets/images/item/' . $r->remark) . '" target="_blank"><img src="' . base_url('./assets/images/item/' . $r->remark) . '"/></a>';
			// else
			// 	$row[] = '(No barcode)';

			$row[] = '
			<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
			Action
	  		<span class="sr-only">Toggle Dropdown</span>
			</button>

			<div class="dropdown-menu" role="menu">
	  		<a class="dropdown-item" onclick="edit_data(' . "'" . $r->id_item . "'" . ')"><span class="fa fa-edit text-primary"></span> Edit</a>
	  		<div class="dropdown-divider"></div>
	  		<a class="dropdown-item" onclick="deleted(' . "'" . $r->id_item . "'" . ')"><span class="fa fa-trash text-danger"></span> Delete</a>
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

	public function add_item()
	{
		$data['title'] = 'Add Item';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['supplier'] = $this->item->get_supplier();
		$data['unit'] = $this->item->get_unit();
		$data['category'] = $this->item->get_category();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/item/add_item', $data);
		$this->load->view('template_oznet/footer');
	}



	public function create()
	{

		$no_id = $this->input->post('item_code');
		$sql = $this->db->query("SELECT item_code FROM tb_items where item_code = '$no_id' ");
		$cek = $sql->num_rows();


		if ($cek < 1) {
			$this->_validate();

			$this->load->library('ciqrcode'); //pemanggilan library QR CODE
			$config['cacheable']    = true; //boolean, the default is true
			$config['cachedir']     = './assets/'; //string, the default is application/cache/
			$config['errorlog']     = './assets/'; //string, the default is application/logs/
			$config['imagedir']     = './assets/images/item/'; //direktori penyimpanan qr code
			$config['quality']      = true; //boolean, the default is true
			$config['size']         = '1024'; //interger, the default is 1024
			$config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
			$config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
			$this->ciqrcode->initialize($config);
			$nim = $this->input->post('item_code');
			$image_name = $nim . '.png'; //buat name dari qr code sesuai dengan nim

			$params['data'] = $nim; //data yang akan di jadikan QR CODE
			$params['level'] = 'H'; //H=High
			$params['size'] = 4;
			$params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
			$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

			$data = [
				'item_code' => $this->input->post('item_code'),
				'item_description' => $this->input->post('item_description'),
				'id_supplier' => 0,
				'id_category' => $this->input->post('id_category'),
				'id_unit' => $this->input->post('id_unit'),
				'remark' => $image_name,
				'linex' => $this->input->post('linex')
			];

			$this->item->save('tb_items', $data);
			$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">New data added</div>');
			redirect('Controller_Item');
		} else {
			$this->session->set_flashdata('message', '<div class= "alert alert-danger" role="alert">duplikat</div>');
			redirect('Controller_Item');
		}
	}



	public function print()
	{

		$data['title'] = 'Print Barcode Item';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['linex'] = $this->item->get_linex();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/item/print', $data);
		$this->load->view('template_oznet/footer');
	}


	public function cari_line()
	{

		$id = $this->input->post('linex');

		$data['title'] = 'View Barcode Item';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['data'] = $this->item->get_item_byid($id);

		$this->load->view('administrator/item/view_barcode_line', $data);
	}



	function import()
	{

		if (isset($_FILES["file"]["name"])) {
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);

			foreach ($object->getWorksheetIterator() as $worksheet) {
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();


				for ($row = 2; $row <= $highestRow; $row++) {
					$kode = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$description = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$linex = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$category = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$unit = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					// $item = $worksheet->getCellByColumnAndRow(31, $row)->getValue();
					// $sample_code = $worksheet->getCellByColumnAndRow(33, $row)->getValue();

					$this->load->library('ciqrcode'); //pemanggilan library QR CODE
					$config['cacheable']    = true; //boolean, the default is true
					$config['cachedir']     = './assets/'; //string, the default is application/cache/
					$config['errorlog']     = './assets/'; //string, the default is application/logs/
					$config['imagedir']     = './assets/images/item/'; //direktori penyimpanan qr code
					$config['quality']      = true; //boolean, the default is true
					$config['size']         = '1024'; //interger, the default is 1024
					$config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
					$config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
					$this->ciqrcode->initialize($config);
					$nim = $kode;
					$image_name = $nim . '.png'; //buat name dari qr code sesuai dengan nim

					$params['data'] = $nim; //data yang akan di jadikan QR CODE
					$params['level'] = 'H'; //H=High
					$params['size'] = 4;
					$params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
					$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE


					$data[] = array(
						'item_code'  => $kode,
						'item_description'   => $description,
						'id_category'  => $category,
						'id_supplier'  => 0,
						'id_unit'  => $unit,
						'remark'  => $image_name,
						'linex'   => $linex,

					);
				}
			}


			$this->db->where('item_code', $kode);
			$num = $this->db->get('tb_items')->num_rows();

			if ($num == 0) {
				echo  $this->item->insert($data);
				// echo $this->trims->save_detil($data2);

				$message = array(
					'message' => '<div class="alert alert-success">Import file excel berhasil disimpan di database</div>',
				);

				$this->session->set_flashdata($message);
				redirect('Controller_Item');
			} else {

				$message = array(
					'message' => '<div class="alert alert-danger">Import file excel gagal data duplikat</div>',
				);

				$this->session->set_flashdata($message);
				redirect('Controller_Item');
			}
		} else {
			$message = array(
				'message' => '<div class="alert alert-danger">Import file excel not complete</div>',
			);

			$this->session->set_flashdata($message);
			redirect('Controller_Item');
		}
	}

	public function edit_item($id)
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Edit Item';
		$data['items'] = $this->item->getID($id);
		$data['supplier'] = $this->item->get_supplier();
		$data['unit'] = $this->item->get_unit();
		$data['category'] = $this->item->get_category();

		// $this->form_validation->set_rules('item_code', 'Item Code', 'required');

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/item/edit_item', $data);
		$this->load->view('template_oznet/footer');
	}

	public function update()
	{

		$id = $this->input->post('id_item');

		$datax =  $this->db->get_where('tb_items',  ['id_item' => $id])->row_array();
		if ($datax > 0) {
			unlink('./assets/images/item/' . $datax['remark']);
		}

		$this->load->library('ciqrcode'); //pemanggilan library QR CODE
		$config['cacheable']    = true; //boolean, the default is true
		$config['cachedir']     = './assets/'; //string, the default is application/cache/
		$config['errorlog']     = './assets/'; //string, the default is application/logs/
		$config['imagedir']     = './assets/images/item/'; //direktori penyimpanan qr code
		$config['quality']      = true; //boolean, the default is true
		$config['size']         = '1024'; //interger, the default is 1024
		$config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
		$config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config);
		$nim = $this->input->post('item_code');
		$image_name = $nim . '.png'; //buat name dari qr code sesuai dengan nim

		$params['data'] = $nim; //data yang akan di jadikan QR CODE
		$params['level'] = 'H'; //H=High
		$params['size'] = 4;
		$params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
		$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

		$data = [
			'item_code' => $this->input->post('item_code'),
			'item_description' => $this->input->post('item_description'),
			'id_supplier' => 0,
			'id_category' => $this->input->post('id_category'),
			'id_unit' => $this->input->post('id_unit'),
			'remark' => $image_name,
			'linex' => $this->input->post('linex'),
			'status' => $this->input->post('status')
		];

		$this->item->update_data('tb_items', $data, $id);
	}



	public function remove($id)
	{
		$this->item->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function hapus_barcode($id)
	{
		$datax =  $this->db->get_where('v_items',  ['id_item' => $id])->row_array();
		unlink('./assets/images/item/' . $datax['remark']);
	}






	public function all_data()
	{
		$data['title'] = 'Sketch All';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		//konek model
		//konfigurasi pagination
		$config['base_url'] = site_url('skatch/all_data'); //site url
		$config['total_rows'] = $this->db->count_all('skatch'); //total row
		$config['per_page'] = 9;  //show record per halaman
		$config["uri_segment"] = 3;  // uri parameter
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = 3;

		// Membuat Style pagination untuk BootStrap v4
		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';

		$this->pagination->initialize($config);
		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		//panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
		$data['data'] = $this->Skatch_model->get_dataAll_list($config['per_page'], $data['page']);
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('skatch/all_data', $data);
		$this->load->view('templates/footer');
	}



	public function view_barcode()
	{
		$data['title'] = 'View Barcode';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


		$data['data'] = $this->item->get_item_id();

		$this->load->view('administrator/item/view_barcode', $data);
	}


	public function export_barcodepdf()
	{
		//Load the library
		$this->load->library('html2pdf');

		//Set folder to save PDF to
		$this->html2pdf->folder('./assets/pdfs/');

		//Set the filename to save/download as
		$this->html2pdf->filename('test.pdf');

		//Set the paper defaults
		$this->html2pdf->paper('a4', 'portrait');



		$data['data'] = $this->item->get_item();

		$this->html2pdf->html($this->load->view('administrator/item/view_barcode', $data, true));

		if ($this->html2pdf->create('save')) {

			echo 'PDF saved';
		}

		// $this->load->view('template_oznet/header', $data);
		// $this->load->view('template_oznet/sidebar', $data);
		// $this->load->view('administrator/item/view_barcode', $data);
		// $this->load->view('template_oznet/footer');
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



	function action()
	{


		$this->load->library("excel");
		$object = new PHPExcel();
		$object->setActiveSheetIndex(0);
		$table_columns = array("Name", "barcode");
		$column = 0;
		foreach ($table_columns as $field) {

			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);

			$column++;
		}

		$employee_data = $this->item->get_item();
		$excel_row = 2;

		foreach ($employee_data as $row) {

			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['item_code']);

			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setPath('assets/images/item/' . $row['remark']);
			$objDrawing->setCoordinates('C' . $excel_row);
			$objDrawing->setWorksheet($object->getActiveSheet());
			$object->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(120);
			// $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['remark']);
			$excel_row++;
		}

		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');

		header('Content-Type: application/vnd.ms-excel');

		header('Content-Disposition: attachment;filename="Item Data.xls"');

		$object_writer->save('php://output');
	}


	function export3()
	{
		$this->load->library("excel");
		$list = $this->item->get_item();
		$output = '';
		if ($list) {
			$output .= '
			<p style="text-align: center;">Item List </p>
			
			<table border="1">
			<thead>
				<tr>
					
					<th scope="col">Description</th>
				
					<th scope="col" style="width: 200px;" >barcode</th>
				</tr>
			</thead>
			<tbody>
			';
			foreach ($list as $row) {
				$output .= '
				<div class="container">

				<tr style="height:125px;">
				
					<td style="float:right; ">' . $row['item_description'] . '</td>
					
					<td style="float:right; "><img src="http://localhost/app-inv/assets/images/item/' . $row['remark'] . '" style="float:right;"></td>
				</tr>
		
			
		
			</div>
		
			';
			}
			$output .= '</tbody></table>';
			header('Content-Type: application/force-download');
			header('Content-Disposition: attachment;filename="Item Data.xls"');
			header('Content-Transfer-Encoding: BINARY');
			echo $output;
		}
	}





	public function report()
	{
		$data['title'] = 'Item';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		//konek model

		$data['item'] = $this->item->get_item();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/item/report', $data);
		$this->load->view('template_oznet/footer');
	}


	public function get_item_report()
	{

		$draw = intval($this->input->get("draw"));

		$this->db->order_by("id_item", "desc");
		$this->db->where("id_item >", 0);
		$query = $this->db->get("tb_items");
		$data = [];
		$no = 0;

		foreach ($query->result() as $r) {

			$this->db->where('id_category', $r->id_category);
			$xx = $this->db->get('tb_category');
			$this->db->where('id_unit', $r->id_unit);
			$s = $this->db->get('tb_unit');

			$row_category = '';
			$row_unit = '';

			$no++;
			$row = array();
			$row[] = $r->item_code;
			$row[] = $r->item_description;
			foreach ($xx->result() as $key) {
				$row_category .= $key->name_category;
			};

			$row[] = $row_category;
			foreach ($s->result() as $key) {
				$row_unit .= $key->code_unit;
			};
			$row[] = $row_unit;
			$row[] = $r->linex;
			$row[] = $r->status;


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
