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


    public function index()
    {
        $data['title'] = 'peminjaman';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['pinjam'] = $this->peminjaman->get_out();

        $this->load->view('template_oznet/header', $data);
        // $this->load->view('template_oznet/sidebar', $data);
        $this->load->view('administrator/peminjaman/index');
        $this->load->view('template_oznet/footer');
    }

    public function hapus_out($id)
    {
        $this->peminjaman->hapusDataOut($id);
        $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">data pinjam deleted</div>');
        redirect('Controller_peminjaman/material_out');
    }



    public function kode_otomatis_no_out()
    {
        $data =  $this->peminjaman->buat_kode_no_out();
        echo json_encode($data);
    }



    public function get_data_material_out_all()
    {
        // Datatables Variables

        date_default_timezone_set('Asia/Jakarta');

        $draw = intval($this->input->get("draw"));
        $this->db->order_by("no_out", "desc");
        $query = $this->db->get("tb_pinjam");
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
            $row[] = $r->no_out;
            $row[] = $r->dates;
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
        date_default_timezone_set('Asia/Jakarta');

        $draw = intval($this->input->get("draw"));

        $this->db->like('dates', date('Y-m-d'));
        // $this->db->where('dates <', date('Y-m-d 24:00:00'));
        // $this->db->where('remark', 'PINJAM');
        $this->db->order_by("no_out", "desc");
        $query = $this->db->get("tb_pinjam");
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
            $row[] = $r->no_out;
            $row[] = $r->dates;
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


    public function create_out_ajax()
    {
        date_default_timezone_set('Asia/Jakarta');

        $nox =  $this->peminjaman->buat_kode_no_out();


        $no_itemx = $this->input->post('item_code');
        $sqlx = $this->db->query("SELECT * FROM tb_items where item_code = '$no_itemx' ");
        $cek0 = $sqlx->row_array();


        if ($cek0['status'] == 0) {


            $no_id = $this->input->post('employee_id');
            $sql = $this->db->query("SELECT employee_id FROM tb_employee where employee_id = '$no_id' ");
            $cek = $sql->num_rows();

            $no_item = $this->input->post('item_code');
            $sqlx = $this->db->query("SELECT item_code FROM tb_items where item_code = '$no_item' ");
            $cek2 = $sqlx->num_rows();

            if ($cek > 0  && $cek2 > 0) {


                $data = [

                    'no_out' => $nox,
                    'dates' => date('Y-m-d H:i:s'),
                    'employee_id' => $this->input->post('employee_id'),
                    'item_code' => $this->input->post('item_code'),
                    'remark' => 'PINJAM',
                    'no_return' => '',
                    'date_ret' => ''

                ];


                $this->db->insert('tb_pinjam', $data);
                $sukses = $this->db->affected_rows();

                if ($sukses == 1) {

                    $item_code = $this->input->post('item_code');
                    $this->db->set('status', 1);
                    $this->db->where('item_code', $item_code);
                    $this->db->update('tb_items');
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




    public function remove_material_out($id)
    {
        //delete fil

        $this->db->where('id_out', $id);
        $s = $this->db->get('tb_pinjam')->row_array();

        $ix = $s['item_code'];

        $this->db->set('status', 0);
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
        $draw = intval($this->input->get("draw"));


        $from_trx = $this->input->post('from_transaksi');
        $to_trx = $this->input->post('to_transaksi');
        $this->db->where('dates >=', $from_trx);
        $this->db->where('dates <=', $to_trx);
        $query = $this->db->get('tb_pinjam');

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
            $row[] = $r->no_out;
            $row[] = $r->dates;
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
        $draw = intval($this->input->get("draw"));

        $from_trx = $this->input->post('from_transaksi');
        $to_trx = $this->input->post('to_transaksi');


        $this->db->where('dates >=', $from_trx);
        $this->db->where('dates <=', $to_trx);
        $query = $this->db->get('tb_pinjam');

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
            $row[] = $r->no_out;
            $row[] = $r->dates;
            $row[] = $r->no_return;
            $row[] = $r->date_ret;
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





    public function del_pinjam()
    {
        $data['title'] = 'Peminjaman';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $this->load->view('template_oznet/header', $data);
        // $this->load->view('template_oznet/sidebar', $data);
        $this->load->view('administrator/peminjaman/del_pinjam');
        $this->load->view('template_oznet/footer');
    }



    public function get_data_material_out_dell()
    {
        // Datatables Variables



        $draw = intval($this->input->get("draw"));

        $from_trx = $this->input->post('from_transaksi');
        $to_trx = $this->input->post('to_transaksi');
        $this->db->where('dates >=', $from_trx);
        $this->db->where('dates <=', $to_trx);


        $this->db->order_by("no_out", "desc");
        $query = $this->db->get("tb_pinjam");
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

            $row[] = $r->no_out;
            $row[] = $r->dates;
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
