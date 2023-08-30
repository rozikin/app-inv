<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controller_Peminjaman extends CI_Controller
{
    public function __construct()
    {
        Parent::__construct();
        is_logged_in();
        $this->load->model('Model_Peminjaman', 'peminjaman');
    }


    public function kode_otomatis_out()
    {
        $data =  $this->peminjaman->buat_kode_out();
        echo json_encode($data);
    }

    public function kode_otomatis_no_out()
    {
        $data =  $this->peminjaman->buat_kode_no_out();
        echo json_encode($data);
    }



    public function index()
    {
        $data['title'] = 'Peminjaman';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pinjam'] = $this->peminjaman->get_out();

        $this->load->view('template_oznet/header', $data);
        // $this->load->view('template_oznet/sidebar', $data);
        $this->load->view('administrator/peminjaman/index', $data);
        $this->load->view('template_oznet/footer');
    }

    public function hapus_out($id)
    {
        $this->peminjaman->hapusDataOut($id);
        $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">data pinjam deleted</div>');
        redirect('Controller_peminjaman/material_out');
    }


    public function get_data_material_out_all()
    {
        // Datatables Variables

        $draw = intval($this->input->get("draw"));
        $this->db->order_by("id_out", "desc");
        $query = $this->db->get("v_pinjam");
        $data = [];
        $no = 0;

        foreach ($query->result() as $r) {
            $no++;

            $row = array();
            $row[] = $no;
            $row[] = $r->no_out;
            $row[] = $r->date;
            $row[] = $r->employee_id;
            $row[] = $r->employee_name;
            $row[] = $r->department;
            $row[] = $r->line;
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
        $data = $this->peminjaman->get_data_nik($kode);
        echo json_encode($data);
    }

    function get_data_kode()
    {
        $kode = $this->input->post('item_code');
        $data = $this->peminjaman->get_data_kode($kode);
        echo json_encode($data);
    }


    public function get_data_material_out()
    {
        // Datatables Variables


        $draw = intval($this->input->get("draw"));
        $this->db->order_by("id_out", "desc");
        $query = $this->db->get("v_pinjam");
        $data = [];
        $no = 0;


        foreach ($query->result() as $r) {
            $no++;

            $row = array();

            $row[] = $no;

            $row[] = $r->no_out;
            $row[] = $r->date;
            $row[] = $r->employee_id;
            $row[] = $r->employee_name;
            $row[] = $r->department;
            $row[] = $r->line;
            $row[] = $r->item_code;
            $row[] = $r->item_description;
            $row[] = $r->remark == 'PINJAM' ? '<a class="badge badge-danger">' . $r->remark . '</a>' : '<a class="badge badge-success">' . $r->remark . '</a>';


            $row[] = '

			<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
			Action
			<span class="sr-only">Toggle Dropdown</span>
			</button>
			<div class="dropdown-menu" role="menu">
					
			<div class="dropdown-divider"></div>
			
			<a class="dropdown-item " onclick="delete_data(' . $r->id_out . ')"><span class="fa fa-trash text-danger"></span> Delete</a>
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
        $data['item'] = $this->peminjaman->get_item_stok();
        $data['po'] = $this->peminjaman->get_po();
        $this->load->view('template_oznet/header', $data);
        $this->load->view('template_oznet/sidebar', $data);
        $this->load->view('administrator/peminjaman/add_material_out', $data);
        $this->load->view('template_oznet/footer');
    }





    // public function create_out()
    // {

    //     $no_id = $this->input->post('id_out');
    //     $sql = $this->db->query("SELECT id_out FROM tb_pinjam where id_out = '$no_id' ");
    //     $cek = $sql->num_rows();


    //     if ($cek < 1) {

    //         $this->_validate_out();
    //         date_default_timezone_set('Asia/Jakarta');
    //         $datas = [

    //             'no_out' => $this->input->post('no_out'),
    //             'date' => date('d-m-Y H:i:s'),
    //             'employee_id' => $this->input->post('employee_id'),
    //             'item_code' => $this->input->post('item_code'),
    //             'remark' => '',

    //         ];


    //         $this->db->insert('tb_pinjam', $datas);

    //         $this->session->set_flashdata('message', '<div class= "alert alert-success alert-sm" role="alert">New data added</div>');
    //         redirect('Controller_peminjaman/material_out');
    //     } else {
    //         $this->session->set_flashdata('message', '<div class= "alert alert-danger" role="alert">duplikat data</div>');
    //         redirect('Controller_peminjaman/material_out');
    //     }
    // }


    public function create_out_ajax()
    {
        date_default_timezone_set('Asia/Jakarta');
        if ($this->input->post('type') == 1) {

            $data = [

                'no_out' => $this->input->post('no_out'),
                'date' => date('d-m-Y H:i:s'),
                'employee_id' => $this->input->post('employee_id'),
                'item_code' => $this->input->post('item_code'),
                'remark' => 'PINJAM',
                'no_return' => '',
                'date_ret' => ''

            ];


            $this->db->insert('tb_pinjam', $data);


            $item_code = $this->input->post('item_code');
            $this->db->set('status', '1');
            $this->db->where('item_code', $item_code);
            $this->db->update('tb_items');

            echo json_encode(array(
                "statusCode" => 200
            ));
        }
    }



    public function get_id_otomatis()
    {
        $id = $_GET['id'];

        $this->db->where('id_item', $id);
        $data = $this->db->get('v_items')->result_array();
        echo json_encode($data);
    }


    // public function edit_material_out($id = null)
    // {
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     $data['title'] = 'Edit Material Out';
    //     $data['po'] = $this->peminjaman->get_id_out($id);
    //     $data['podetil'] = $this->peminjaman->get_detil_out($id);
    //     $data['itemtrim'] = $this->peminjaman->get_item();


    //     $this->load->view('template_oznet/header', $data);
    //     $this->load->view('template_oznet/sidebar', $data);
    //     $this->load->view('administrator/peminjaman/edit_material_out', $data);
    //     $this->load->view('template_oznet/footer');
    // }





    public function remove_material_out($id)
    {
        //delete fil

        $this->db->where('id_out', $id);
        $s = $this->db->get('tb_pinjam')->row_array();

        $ix = $s['item_code'];

        $this->db->set('status', '0');
        $this->db->where('item_code', $ix);
        $this->db->update('tb_items');


        $this->peminjaman->delete_by_out($id);
        echo json_encode(array("status" => TRUE));
    }


    public function report()
    {
        $data['title'] = 'Peminjaman';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $this->load->view('template_oznet/header', $data);
        $this->load->view('template_oznet/sidebar', $data);
        $this->load->view('administrator/peminjaman/report');
        $this->load->view('template_oznet/footer');
    }


    public function get_data_report()
    {
        // Datatables Variables


        $draw = intval($this->input->get("draw"));
        $this->db->order_by("id_out", "desc");
        $query = $this->db->get("v_pinjam");
        $data = [];
        $no = 0;


        foreach ($query->result() as $r) {
            $no++;

            $row = array();

            $row[] = $no;

            $row[] = $r->no_out;
            $row[] = $r->date;
            $row[] = $r->employee_id;
            $row[] = $r->employee_name;
            $row[] = $r->department;
            $row[] = $r->line;
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




    public function transaksi()
    {
        $data['title'] = 'transaksi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $this->load->view('template_oznet/header', $data);
        $this->load->view('template_oznet/sidebar', $data);
        $this->load->view('administrator/peminjaman/transaksi');
        $this->load->view('template_oznet/footer');
    }



    public function get_data_transaksi()
    {
        // Datatables Variables


        $draw = intval($this->input->get("draw"));
        $this->db->order_by("id_out", "desc");
        $query = $this->db->get("v_pinjam");
        $data = [];
        $no = 0;


        foreach ($query->result() as $r) {
            $no++;

            $row = array();

            $row[] = $no;

            $row[] = $r->no_out;
            $row[] = $r->date;
            $row[] = $r->no_return;
            $row[] = $r->date_ret;
            $row[] = $r->employee_id;
            $row[] = $r->employee_name;
            $row[] = $r->department;
            $row[] = $r->line;
            $row[] = $r->item_code;
            $row[] = $r->item_description;
            $row[] = $r->remark == 'PINJAM' ? '<a class="badge badge-danger">' . $r->remark . '</a>' : '<a class="badge badge-success">' . $r->remark . '</a>';
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