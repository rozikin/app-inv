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


    public function kode_otomatis_no_return()
    {
        $data =  $this->pengembalian->buat_kode_no_return();
        echo json_encode($data);
    }



    public function index()
    {
        $data['title'] = 'pengembalian';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['pinjam'] = $this->pengembalian->get_out();

        $this->load->view('template_oznet/header', $data);
        // $this->load->view('template_oznet/sidebar', $data);
        $this->load->view('administrator/pengembalian/index');
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

        $draw = intval($this->input->get("draw"));


        $this->db->order_by("id_retur", "desc");
        $query = $this->db->get("tb_kembali");
        $data = [];
        $no = 0;

        foreach ($query->result() as $r) {
            $this->db->where('employee_id', $r->employee_id);
            $xx = $this->db->get('tb_employee');
            $this->db->where('item_code', $r->item_code);
            $s = $this->db->get('tb_items');

            $row_item_desc = '';
            $row_name = '';
            $row_department = '';
            $row_line = '';

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->no_return;
            $row[] = $r->dates;
            $row[] = $r->no_out;
            $row[] = $r->employee_id;
            foreach ($xx->result() as $key) {
                $row_name .= $key->employee_name;
                $row_department .= $key->department;
                $row_line .= $key->linex;
            };

            $row[] = $row_name;
            $row[] = $row_department;
            $row[] = $row_line;
            $row[] = $r->item_code;
            foreach ($s->result() as $key) {
                $row_item_desc .= $key->item_description;
            };

            $row[] = $row_item_desc;


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





    function get_data_kode()
    {
        $kode = $this->input->post('item_code');
        $data = $this->pengembalian->get_data_kode($kode);
        echo json_encode($data);
    }


    public function get_data_return()
    {
        date_default_timezone_set('Asia/Jakarta');

        $draw = intval($this->input->get("draw"));

      
        $this->db->like('dates', date('Y-m-d'));
        $this->db->order_by("id_retur", "desc");
        $query = $this->db->get("tb_kembali");
        $data = [];
        $no = 0;


        foreach ($query->result() as $r) {
            $this->db->where('employee_id', $r->employee_id);
            $xx = $this->db->get('tb_employee');
            $this->db->where('item_code', $r->item_code);
            $s = $this->db->get('tb_items');

            $row_item_desc = '';
            $row_name = '';
            $row_department = '';
            $row_line = '';


            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->no_return;
            $row[] = $r->dates;
            $row[] = $r->no_out;
            $row[] = $r->employee_id;
            foreach ($xx->result() as $key) {
                $row_name .= $key->employee_name;
                $row_department .= $key->department;
                $row_line .= $key->linex;
            };

            $row[] = $row_name;
            $row[] = $row_department;
            $row[] = $row_line;
            $row[] = $r->item_code;
            foreach ($s->result() as $key) {
                $row_item_desc .= $key->item_description;
            };

            $row[] = $row_item_desc;


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
        $nox =  $this->pengembalian->buat_kode_no_return();

        $no_itemx = $this->input->post('item_code');
        $sqlx = $this->db->query("SELECT * FROM tb_items where item_code = '$no_itemx' ");
        $cek0 = $sqlx->row_array();

        if ($cek0['status'] == 1) {


                $no_id = $this->input->post('employee_id');
                $sql = $this->db->query("SELECT employee_id FROM tb_pinjam where employee_id = '$no_id' ");
                $cek = $sql->num_rows();

                $no_item = $this->input->post('item_code');
                $sqlx = $this->db->query("SELECT item_code FROM tb_pinjam where item_code = '$no_item' ");
                $cek2 = $sqlx->num_rows();

                if ($cek > 0  && $cek2 > 0) {

                
                    $data = [
                        'no_return' => $nox,
                        'dates' => date('Y-m-d H:i:s'),
                        'employee_id' => $this->input->post('employee_id'),
                        'item_code' => $this->input->post('item_code'),
                        'no_out' => $this->input->post('no_pinjam'),
                        'remark' => '',

                    ];

                    $this->db->insert('tb_kembali', $data);

                    $sukses = $this->db->affected_rows();

                    if ($sukses == 1) {

                        $item_coded = $this->input->post('item_code');
                        $this->db->set('status', 0);
                        $this->db->where('item_code', $item_coded);
                        $this->db->update('tb_items');
    
    
                        $no_out = $this->input->post('no_pinjam');
                        $no_retur = $nox;
                        $this->db->set('remark', 'KEMBALI');
                        $this->db->set('no_return', $no_retur);
                        $this->db->set('date_ret', date('Y-m-d H:i:s'));
                        $this->db->where('no_out', $no_out);
                        $this->db->update('tb_pinjam');
    
                    }

                    
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







    public function remove_material_return($id)
    {
        //delete fil

        $this->db->where('id_retur', $id);
        $s = $this->db->get('tb_kembali')->row_array();

        $ix = $s['item_code'];
        $this->db->set('status', 1);
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



        $draw = intval($this->input->get("draw"));

        $from_trx = $this->input->post('from_transaksi');
        $to_trx = $this->input->post('to_transaksi');

        $this->db->where('dates >=', $from_trx);
        $this->db->where('dates <=', $to_trx);
        $query = $this->db->get('tb_kembali');




        // $coba = $this->db->query('SELECT * FROM tb_kembali where dates >== "' . $fr . '" AND "' . $to . '"');
        // $query = $coba;
        $data = [];
        $no = 0;


        foreach ($query->result() as $r) {

            $this->db->where('employee_id', $r->employee_id);
            $xx = $this->db->get('tb_employee');
            $this->db->where('item_code', $r->item_code);
            $s = $this->db->get('tb_items');

            $row_item_desc = '';
            $row_name = '';
            $row_department = '';
            $row_line = '';






            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->no_return;
            $row[] = $r->dates;
            $row[] = $r->no_out;
            $row[] = $r->employee_id;
            foreach ($xx->result() as $key) {
                $row_name .= $key->employee_name;
                $row_department .= $key->department;
                $row_line .= $key->linex;
            };

            $row[] = $row_name;
            // $row[] = $row_department;
            // $row[] = $row_line;
            $row[] = $r->item_code;
            foreach ($s->result() as $key) {
                $row_item_desc .= $key->item_description;
            };

            $row[] = $row_item_desc;

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


    public function del_kembali()
    {
        $data['title'] = 'pengembalian';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pinjam'] = $this->pengembalian->get_out();

        $this->load->view('template_oznet/header', $data);
        // $this->load->view('template_oznet/sidebar', $data);
        $this->load->view('administrator/pengembalian/del_kembali', $data);
        $this->load->view('template_oznet/footer');
    }


    public function get_data_return_del()
    {


        $draw = intval($this->input->get("draw"));

        $from_trx = $this->input->post('from_transaksi');
        $to_trx = $this->input->post('to_transaksi');
        $this->db->where('dates >==', $from_trx);
        $this->db->where('dates <==', $to_trx . '24:00:00');

        $this->db->order_by("id_retur", "desc");
        $query = $this->db->get("tb_kembali");
        $data = [];
        $no = 0;


        foreach ($query->result() as $r) {


            $this->db->where('employee_id', $r->employee_id);
            $xx = $this->db->get('tb_employee');
            $this->db->where('item_code', $r->item_code);
            $s = $this->db->get('tb_items');

            $row_item_desc = '';
            $row_name = '';
            $row_department = '';
            $row_line = '';

            $no++;

            $row = array();

            $row[] = $no;

            $row[] = $r->no_return;
            $row[] = $r->dates;
            $row[] = $r->no_out;
            $row[] = $r->employee_id;
            foreach ($xx->result() as $key) {
                $row_name .= $key->employee_name;
                $row_department .= $key->department;
                $row_line .= $key->linex;
            };

            $row[] = $row_name;
            $row[] = $row_department;
            $row[] = $row_line;
            $row[] = $r->item_code;
            foreach ($s->result() as $key) {
                $row_item_desc .= $key->item_description;
            };

            $row[] = $row_item_desc;



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