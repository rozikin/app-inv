<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controller_Pengembalian extends CI_Controller
{
    public function __construct()
    {
        Parent::__construct();
        is_logged_in();
        $this->load->model('Model_Pengembalian', 'pengembalian');
    }


    // public function kode_otomatis_kembali()
    // {
    //     $data =  $this->pengembalian->buat_kode_out();
    //     echo json_encode($data);
    // }

    public function kode_otomatis_no_return()
    {
        $data =  $this->pengembalian->buat_kode_no_return();
        echo json_encode($data);
    }



    public function index()
    {
        $data['title'] = 'pengembalian';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pinjam'] = $this->pengembalian->get_out();

        $this->load->view('template_oznet/header', $data);
        // $this->load->view('template_oznet/sidebar', $data);
        $this->load->view('administrator/pengembalian/index', $data);
        $this->load->view('template_oznet/footer');
    }

    public function hapus_out($id)
    {
        $this->pengembalian->hapusDataOut($id);
        $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">data pinjam deleted</div>');
        redirect('Controller_pengembalian/material_out');
    }


    public function get_data_return_all()
    {
        // Datatables Variables

        $draw = intval($this->input->get("draw"));
        $this->db->order_by("id_retur", "desc");
        $query = $this->db->get("v_kembali");
        $data = [];
        $no = 0;

        foreach ($query->result() as $r) {
            $no++;

            $row = array();
            $row[] = $no;
            $row[] = $r->no_return;
            $row[] = $r->Date;
            $row[] = $r->employee_id;
            $row[] = $r->employee_name;
            $row[] = $r->department;
            $row[] = $r->linex;
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


    function get_data_nik()
    {
        $kode = $this->input->post('employee_id');
        $data = $this->pengembalian->get_data_nik($kode);
        echo json_encode($data);
    }

    function get_data_pinjam($employee_id)
    {
        $kode = $this->input->post('employee_id');
        $draw = intval($this->input->get("draw"));
        // $this->db->order_by("no_out", "desc");
        $this->db->where("employee_id", $employee_id);
        $this->db->where("remark", "PINJAM");
        $this->db->where("status", 1);
        $query = $this->db->get("v_pinjam");
        $data = [];
        $no = 0;

        foreach ($query->result() as $r) {
            $no++;

            $row = array();
            $row[] = $no;
            $row[] = $r->no_out;
            $row[] = $r->date;
            $row[] = $r->item_code;
            $row[] = $r->item_description;

            if ($r->remark == "PINJAM") {
                $row[] = '<div class="text-danger">PINJAM</div>';
            } else {
                $row[] = 'KEMBALI';
            }

            $row[] = '<a class="pilih_data btn-sm" data-id="' . $r->no_out . '" data-code="' . $r->item_code . '" data-desc="' . $r->item_description . '" data-status="' . $r->status . '">' . 'select' . '</a>';
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




    function get_data_kode()
    {
        $kode = $this->input->post('item_code');
        $data = $this->pengembalian->get_data_kode($kode);
        echo json_encode($data);
    }


    public function get_data_return()
    {
        // Datatables Variables


        $draw = intval($this->input->get("draw"));
        $this->db->order_by("id_retur", "desc");
        $query = $this->db->get("v_kembali");
        $data = [];
        $no = 0;


        foreach ($query->result() as $r) {
            $no++;

            $row = array();

            $row[] = $no;

            $row[] = $r->no_return;
            $row[] = $r->Date;
            $row[] = $r->no_out;
            $row[] = $r->employee_id;
            $row[] = $r->employee_name;
            $row[] = $r->department;
            $row[] = $r->linex;
            $row[] = $r->item_code;
            $row[] = $r->item_description;


            $row[] = '

			<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
			Action
			<span class="sr-only">Toggle Dropdown</span>
			</button>
			<div class="dropdown-menu" role="menu">
					
			<div class="dropdown-divider"></div>
			
			<a class="dropdown-item " onclick="delete_data(' . $r->id_retur . ')"><span class="fa fa-trash text-danger"></span> Delete</a>
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



    public function add_material_out()
    {
        $data['title'] = 'Add Material OUT';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['item'] = $this->pengembalian->get_item_stok();
        $data['po'] = $this->pengembalian->get_po();
        $this->load->view('template_oznet/header', $data);
        $this->load->view('template_oznet/sidebar', $data);
        $this->load->view('administrator/pengembalian/add_material_out', $data);
        $this->load->view('template_oznet/footer');
    }






    public function create_return_ajax()
    {
        date_default_timezone_set('Asia/Jakarta');
        if ($this->input->post('type') == 1) {

            $no_id = $this->input->post('no_return');
            $sql = $this->db->query("SELECT no_return FROM tb_pinjam where no_return = '$no_id' ");
            $cek = $sql->num_rows();

            if ($cek < 1) {
                $data = [
                    'no_return' => $this->input->post('no_return'),
                    'date' => date('d-m-Y H:i:s'),
                    'employee_id' => $this->input->post('employee_id'),
                    'item_code' => $this->input->post('item_code'),
                    'no_out' => $this->input->post('no_pinjam'),
                    'remark' => '',


                ];

                $this->db->insert('tb_kembali', $data);


                $item_code = $this->input->post('item_code');
                $this->db->set('status', '0');
                $this->db->where('item_code', $item_code);
                $this->db->update('tb_items');


                $no_out = $this->input->post('no_pinjam');
                $no_retur = $this->input->post('no_return');
                $this->db->set('remark', 'KEMBALI');
                $this->db->set('no_return', $no_retur);
                $this->db->set('date_ret', date('d-m-Y H:i:s'));
                $this->db->where('no_out', $no_out);
                $this->db->update('tb_pinjam');


                echo json_encode(array(
                    "statusCode" => 200
                ));
            }
        }
    }



    public function get_id_otomatis()
    {
        $id = $_GET['id'];

        $this->db->where('id_item', $id);
        $data = $this->db->get('v_items')->result_array();
        echo json_encode($data);
    }


    public function edit_material_out($id = null)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Edit Material Out';
        $data['po'] = $this->pengembalian->get_id_out($id);
        $data['podetil'] = $this->pengembalian->get_detil_out($id);
        $data['itemtrim'] = $this->pengembalian->get_item();


        $this->load->view('template_oznet/header', $data);
        $this->load->view('template_oznet/sidebar', $data);
        $this->load->view('administrator/pengembalian/edit_material_out', $data);
        $this->load->view('template_oznet/footer');
    }





    public function remove_material_return($id)
    {
        //delete fil

        $this->db->where('id_retur', $id);
        $s = $this->db->get('tb_kembali')->row_array();

        $ix = $s['item_code'];
        $this->db->set('status', '1');
        $this->db->where('item_code', $ix);
        $this->db->update('tb_items');

        $xx = $s['no_out'];
        $this->db->set('remark', 'PINJAM');
        $this->db->set('no_return', '');
        $this->db->where('no_out', $xx);
        $this->db->update('tb_pinjam');



        $this->pengembalian->delete_by_retur($id);
        echo json_encode(array("status" => TRUE));
    }





    public function report()
    {
        $data['title'] = 'Pengembalian';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $this->load->view('template_oznet/header', $data);
        $this->load->view('template_oznet/sidebar', $data);
        $this->load->view('administrator/pengembalian/report');
        $this->load->view('template_oznet/footer');
    }


    public function get_data_report()
    {
        // Datatables Variables

        $draw = intval($this->input->get("draw"));
        $this->db->order_by("id_retur", "desc");
        $query = $this->db->get("v_kembali");
        $data = [];
        $no = 0;


        foreach ($query->result() as $r) {
            $no++;

            $row = array();

            $row[] = $no;

            $row[] = $r->no_return;
            $row[] = $r->Date;
            $row[] = $r->employee_id;
            $row[] = $r->employee_name;
            $row[] = $r->department;
            $row[] = $r->linex;
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
}