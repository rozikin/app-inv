<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends CI_Controller
{
    public function __construct()

    {
        Parent::__construct();
        is_logged_in();

        $this->load->model('Account_model');
        $this->load->library('curl');
    }

    public function index()
    {
        $data['title'] = 'Account';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();



        $this->load->view('template_vegist/header', $data);
        $this->load->view('template_vegist/topbar', $data);
        $this->load->view('client/account/account', $data);
        $this->load->view('template_vegist/footer', $data);
    }

    public function address()
    {
        $data['title'] = 'Account';
        $data['data_profile'] =  $this->db->get('setting_profile')->row_array();
        $data['data_logo'] =  $this->db->get('setting_logo')->row_array();
        $data['data_banner'] =  $this->db->get('setting_banner');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['products'] = $this->Client_model->get_product();
        $data['categori'] = $this->Shop_model->getKategori();

        $data['user_pro'] = $this->Account_model->get_id_user();
        $this->load->view('template_vegist/header', $data);
        $this->load->view('template_vegist/topbar', $data);
        $this->load->view('client/account/address', $data);
        $this->load->view('template_vegist/footer', $data);
    }

    private $api_key = 'da67c2fc8580456276d272ea398c8d71';

    function get_provinsi()
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: $this->api_key"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);



        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            // echo $response;
            $array_response = json_decode($response, true);
            $data_provinsi = $array_response['rajaongkir']['results'];

            echo "<option>Pilih Provinsi</option>";

            foreach ($data_provinsi as $key => $value) {
                echo "<option value='" . $value['province'] . "' id_provinsi='" . $value['province_id'] . "'>" . $value['province'] . "</option>";
            }
        }
    }

    function get_kota()
    {

        $id_provinsi_terpilih = $this->input->post('id_provinsi');
        // $id_provinsi_terpilih = 10;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?&province=" . $id_provinsi_terpilih,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: $this->api_key"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $array_response = json_decode($response, true);
            $data_kota = $array_response['rajaongkir']['results'];
            echo "<option>Pilih kota</option>";
            foreach ($data_kota as $key => $value) {
                echo "<option value='" . $value['city_name'] . "'>" . $value['type'] . " " . $value['city_name'] . "</option>";
            }
        }
    }

    public function edit_address()
    {
        $data = [

            'id' => $this->input->post('id_user'),
            'company' => $this->input->post('company'),
            'provinsi' => $this->input->post('provinsi_val'),
            'city' => $this->input->post('kota_val'),
            'addres1' => $this->input->post('address1'),
            'addres2' => $this->input->post('address2'),
            'kode_pos' => $this->input->post('kode_pos'),
            'telp' => $this->input->post('telp'),
            'remark' => $this->input->post('remark'),
        ];


        $this->Account_model->edit_account($data);
        $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">New product added</div>');
        redirect('Account/address');
    }
    public function edit_user()
    {
        $data = [

            'id' => $this->input->post('idx'),
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),

        ];


        $this->Account_model->edit_user($data);
        $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">New product added</div>');
        redirect('Account');
    }



    public function order_client()
    {

        $data['title'] = 'Order';
        $data['data_profile'] =  $this->db->get('setting_profile')->row_array();
        $data['data_logo'] =  $this->db->get('setting_logo')->row_array();
        $data['data_banner'] =  $this->db->get('setting_banner');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row();
        $data['user_pro'] = $this->Account_model->get_id_user();

        $data['orders'] = $this->db->get_where('orders', ['id_user' => $this->session->userdata('id')])->result_array();


        $this->load->view('template_vegist/header', $data);
        $this->load->view('template_vegist/topbar', $data);
        $this->load->view('client/account/order_client', $data);
        $this->load->view('template_vegist/footer', $data);
    }

    public function order_detil($id)
    {

        $data['title'] = 'Order';
        $data['data_profile'] =  $this->db->get('setting_profile')->row_array();
        $data['data_logo'] =  $this->db->get('setting_logo')->row_array();
        $data['data_banner'] =  $this->db->get('setting_banner');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user_pro'] = $this->Account_model->get_id_user();

        $data['orders_detil'] = $this->db->get_where('v_orders', ['id_order' => $id])->result_array();


        $this->load->view('template_vegist/header', $data);
        $this->load->view('template_vegist/topbar', $data);
        $this->load->view('client/account/order_detil', $data);
        $this->load->view('template_vegist/footer', $data);
    }
}
