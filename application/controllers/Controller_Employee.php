<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controller_Employee extends CI_Controller
{
	public function __construct()
	{
		Parent::__construct();
		is_logged_in();
		$this->load->model('Model_Employee', 'employee');
		$this->load->library('excel');
		$this->load->library('pagination');
		$this->load->helper('url');
	}

	public function index()
	{
		$data['title'] = 'employee';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		//konek model
		$data['employee'] = $this->employee->get_employee();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/employee/index', $data);
		$this->load->view('template_oznet/footer');
	}

	public function get_data()
	{
		$draw = intval($this->input->get("draw"));

		$this->db->order_by("id", "desc");
		// $this->db->where("employee_id >", 0);
		$query = $this->db->get("tb_employee");
		$data = [];
		$no = 0;

		foreach ($query->result() as $r) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $r->employee_id;
			$row[] = $r->employee_name;
			$row[] = $r->department;
			$row[] = $r->linex;
			if ($r->remark)
				$row[] = '<a href="' . base_url('./assets/images/employee/' . $r->remark) . '" target="_blank"><img src="' . base_url('./assets/images/employee/' . $r->remark) . '"/></a>';
			else
				$row[] = '(No barcode)';

			$row[] = '

			<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
			Action
	  		<span class="sr-only">Toggle Dropdown</span>
			</button>
			<div class="dropdown-menu" role="menu">
		
	  		<a class="dropdown-item" onclick="edit_data(' . "'" . $r->id . "'" . ')"><span class="fa fa-edit text-primary"></span> Edit</a>
	  		<div class="dropdown-divider"></div>
	  		<a class="dropdown-item" onclick="deleted(' . "'" . $r->id . "'" . ')"><span class="fa fa-trash text-danger"></span> Delete</a>
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

	public function add_employee()
	{
		$data['title'] = 'Add employee';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['supplier'] = $this->employee->get_supplier();
		$data['unit'] = $this->employee->get_unit();
		$data['category'] = $this->employee->get_category();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/employee/add_employee', $data);
		$this->load->view('template_oznet/footer');
	}




	public function create()
	{

		$no_id = $this->input->post('employee_id');
		$sql = $this->db->query("SELECT employee_id FROM tb_employee where employee_id = '$no_id' ");
		$cek = $sql->num_rows();


		if ($cek < 1) {
			$this->_validate();

			$this->load->library('ciqrcode'); //pemanggilan library QR CODE
			$config['cacheable']    = true; //boolean, the default is true
			$config['cachedir']     = './assets/'; //string, the default is application/cache/
			$config['errorlog']     = './assets/'; //string, the default is application/logs/
			$config['imagedir']     = './assets/images/employee/'; //direktori penyimpanan qr code
			$config['quality']      = true; //boolean, the default is true
			$config['size']         = '1024'; //interger, the default is 1024
			$config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
			$config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
			$this->ciqrcode->initialize($config);
			$nim = $this->input->post('employee_id');
			$image_name = $nim . '.png'; //buat name dari qr code sesuai dengan nim

			$params['data'] = $nim; //data yang akan di jadikan QR CODE
			$params['level'] = 'H'; //H=High
			$params['size'] = 4;
			$params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
			$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE



			$data = [
				'employee_id' => $this->input->post('employee_id'),
				'employee_name' => $this->input->post('employee_name'),
				'department' => $this->input->post('department'),
				'linex' => $this->input->post('line'),
				'remark' => $image_name
			];

			$this->employee->save('tb_employee', $data);
			$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">New data added</div>');
			redirect('Controller_Employee');
		} else {
			$this->session->set_flashdata('message', '<div class= "alert alert-danger" role="alert">duplikat</div>');
			redirect('Controller_Employee');
		}
	}



	function import()
	{

		if (isset($_FILES["file"]["name"])) {
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);

			foreach ($object->getWorksheetIterator() as $worksheet) {
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();


				for ($row = 3; $row <= $highestRow; $row++) {
					$kode = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$description = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$department = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$line = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					// $item = $worksheet->getCellByColumnAndRow(31, $row)->getValue();
					// $sample_code = $worksheet->getCellByColumnAndRow(33, $row)->getValue();

					$this->load->library('ciqrcode'); //pemanggilan library QR CODE
					$config['cacheable']    = true; //boolean, the default is true
					$config['cachedir']     = './assets/'; //string, the default is application/cache/
					$config['errorlog']     = './assets/'; //string, the default is application/logs/
					$config['imagedir']     = './assets/images/employee/'; //direktori penyimpanan qr code
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
						'employee_id'  => $kode,
						'employee_name'   => $description,
						'department'  => $department,
						'linex'  => $line,
						'remark'  => $image_name

					);
				}
			}


			$this->db->where('employee_id', $kode);
			$num = $this->db->get('tb_employee')->num_rows();

			if ($num == 0) {
				echo  $this->employee->insert($data);
				// echo $this->trims->save_detil($data2);


				$message = array(
					'message' => '<div class="alert alert-success">Import file excel berhasil disimpan di database</div>',
				);

				$this->session->set_flashdata($message);
				redirect('Controller_Employee');
			} else {

				$message = array(
					'message' => '<div class="alert alert-danger">Import file excel gagal data duplikat</div>',
				);

				$this->session->set_flashdata($message);
				redirect('Controller_Employee');
			}
		} else {
			$message = array(
				'message' => '<div class="alert alert-danger">Import file excel not complete</div>',
			);

			$this->session->set_flashdata($message);
			redirect('Controller_Employee');
		}
	}


	public function view_barcode()
	{
		$data['title'] = 'View Barcode';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['data'] = $this->employee->get_employee_id();
		$this->load->view('administrator/employee/view_barcode', $data);
	}




	public function edit_employee($id)
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Edit employee';
		$data['employees'] = $this->employee->getID($id);
		$data['supplier'] = $this->employee->get_supplier();
		$data['unit'] = $this->employee->get_unit();
		$data['category'] = $this->employee->get_category();

		// $this->form_validation->set_rules('employee_code', 'employee Code', 'required');

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/employee/edit_employee', $data);
		$this->load->view('template_oznet/footer');
	}

	public function update()
	{

		$id = $this->input->post('employee_id');



		$data = [
			'employee_id' => $this->input->post('employee_id'),
			'employee_name' => $this->input->post('employee_name'),
			'department' => $this->input->post('department'),
			'linex' => $this->input->post('line'),
			'remark' => $this->input->post('remark'),
		];

		$this->employee->update_data('tb_employee', $data, $id);
		$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">data edited</div>');
		redirect('Controller_Employee');
	}


	public function remove($id)
	{


		$this->employee->delete_by_id($id);


		echo json_encode(array("status" => TRUE));
	}

	public function hapus_barcode($id)
	{
		$datax =  $this->db->get_where('tb_employee',  ['employee_id' => $id])->row_array();
		unlink('./assets/images/employee/' . $datax['remark']);
	}



	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('employee_id') == '') {
			$data['inputerror'][] = 'employee_id';
			$data['error_string'][] = 'employee id is required';
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

		$employee_data = $this->employee->get_employee();

		$excel_row = 2;


		foreach ($employee_data as $row) {

			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['employee_code']);

			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setPath('assets/images/' . $row['remark']);
			$objDrawing->setCoordinates('C' . $excel_row);
			$objDrawing->setWorksheet($object->getActiveSheet());
			$object->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(120);



			// $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['remark']);



			$excel_row++;
		}

		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');

		header('Content-Type: application/vnd.ms-excel');

		header('Content-Disposition: attachment;filename="employee Data.xls"');

		$object_writer->save('php://output');
	}



	public function print()
	{

		$data['title'] = 'Print Barcode Employee';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['linex'] = $this->employee->get_linex();

		$this->load->view('template_oznet/header', $data);
		$this->load->view('template_oznet/sidebar', $data);
		$this->load->view('administrator/employee/print', $data);
		$this->load->view('template_oznet/footer');
	}

	public function cari_line()
	{

		$id = $this->input->post('linex');

		$data['title'] = 'View Barcode Employee';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['data'] = $this->employee->get_employee_byid($id);

		$this->load->view('administrator/employee/view_barcode_line', $data);
	}



	function export3()
	{
		$this->load->library("excel");
		$list = $this->employee->get_employee();
		$output = '';
		if ($list) {
			$output .= '
			<p style="text-align: center;">employee List </p>
			<table border="1">
			<thead>
				<tr>
					<th scope="col">Code</th>
					<th scope="col">Description</th>
					<th scope="col">Category</th>
					<th scope="col">Unit</th>
					<th scope="col" style="width: 200px;" >barcode</th>
				</tr>
			</thead>
			<tbody>
			';
			foreach ($list as $row) {
				$output .= '
				<tr style="height:125px;">
					<td style="vertical-align: center;">' . $row['employee_code'] . '</td>
					<td style="float:right; ">' . $row['employee_description'] . '</td>
					<td style="float:right; ">' . $row['name_category'] . '</td>
					<td style="float:right; ">' . $row['unit'] . '</td>
					<td style="float:right; "><img src="http://localhost/app-inv/assets/images/' . $row['remark'] . '" style="float:right;"></td>
				</tr>
			';
			}
			$output .= '</tbody></table>';
			header('Content-Type: application/force-download');
			header('Content-Disposition: attachment;filename="employee Data.xls"');
			header('Content-Transfer-Encoding: BINARY');
			echo $output;
		}
	}
}
