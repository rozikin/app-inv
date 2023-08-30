<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		Parent::__construct();
		$this->load->library('form_validation');
	}


	public function index()
	{
		if ($this->session->userdata('email')) {
			redirect('Admin');
		}
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Login';

			$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();




			$this->load->view('template_oznet/auth_header');
			$this->load->view('administrator/auth2/login');
			$this->load->view('template_oznet/auth_footer');
		} else {
			//validasi success
			$this->_login();
		}
	}

	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		//user ada
		if ($user) {
			//jika usernya aktiv
			if ($user['is_active'] == 1) {
				//password 
				if (password_verify($password, $user['password'])) {
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id'],
						'id' => $user['id'],
					];
					$this->session->set_userdata($data);
					if ($user['role_id'] == 1) {
						redirect('Admin');
					} else {

						redirect('Admin');
					}
				} else {
					$this->session->set_flashdata('message', '<div class= "alert alert-danger" role="alert">Email is not Registered!</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class= "alert alert-danger" role="alert">This email is not been activated</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class= "alert alert-danger" role="alert">Email is not Registered!</div>');
			redirect('auth');
		}
	}



	public function registration()
	{
		if ($this->session->userdata('email')) {
			redirect('user');
		}
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'this email has already registered!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' => 'password dont match!',
			'min_length' => 'password too short!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Kurios Registration';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('administrator/auth/registration');
			$this->load->view('templates/auth_footer');
		} else {
			$email = $this->input->post('email', true);
			$data = [
				'name' => htmlspecialchars($this->input->post('name')),
				'email' => htmlspecialchars($email),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 0,
				'date_created' => time()
			];

			//siapkan token
			$token = base64_encode(random_bytes(32));
			$user_token =
				[
					'email' => $email,
					'token' => $token,
					'date_created' => time()
				];

			$this->db->insert('user', $data);
			$this->db->insert('user_token', $user_token);
			$this->_sendEmail($token, 'verify');
			$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">Congratulation! your account has been created. Please Activate your account!</div>');
			redirect('auth');
		}
	}

	private function _sendEmail($token, $type)
	{
		// $config = [
		// 	'protocol' => 'smtp',
		// 	'smtp_host' => 'ssl://mail.kurios-utama.com',
		// 	'smtp_user' => 'rozi@kurios-utama.com',
		// 	'smtp_pass' => 'Semarang123',
		// 	'smtp_port' => 465,
		// 	'mailtype' => 'html',
		// 	'charset' => 'utf-8',
		// 	'newline' => "\r\n"
		// ];


		// Konfigurasi email
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com';
		$config['smtp_port'] = '465';
		$config['smtp_timeout'] = '60';

		$config['smtp_user'] = 'minion.indonesia33@gmail.com';
		$config['smtp_pass'] = 'Semarang123';

		$config['charset'] = 'utf-8';
		$config['newline'] = "\r\n";
		$config['mailtype'] = 'html';
		$config['validation'] = TRUE;

		// Load library email dan konfigurasinya
		$this->email->initialize($config);
		$this->email->set_mailtype("html");


		// $this->load->library('email', $config);

		$this->email->from('minion.indonesia33@gmail.com', 'Admin Kurios');
		$this->email->to($this->input->post('email'));
		if ($type == 'verify') {
			$this->email->subject('Account Verification');
			$this->email->message('Click this link to verify your account : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
			if ($this->email->send()) {
				return true;
			} else {
				echo $this->email->print_debugger();
				die;
			}
		}
	}

	public function verify()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');
		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
			if ($user_token) {
				if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
					$this->db->set('is_active', 1);
					$this->db->where('email', $email);
					$this->db->update('user');
					$this->db->delete('user_token', ['email' => $email]);
					$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">Aktivasi Berhasil. Silahkan Login.</div>');
					redirect('auth');
				} else {
					$this->db->delete('user', ['email' => $email]);
					$this->db->delete('user_token', ['email' => $email]);
					$this->session->set_flashdata('message', '<div class= "alert alert-danger" role="alert">Token expired</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class= "alert alert-danger" role="alert">Account activation failed! wrong Email</div>');
				redirect('auth');
			}
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">You have been logged out!</div>');
		redirect('auth');
	}

	public function blocked()
	{
		$this->load->view('administrator/auth/blocked');
	}



	public function register_client()
	{
		if ($this->session->userdata('email')) {
			redirect('Admin');
		}
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'this email has already registered!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' => 'password dont match!',
			'min_length' => 'password too short!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Kurios Registration';

			$data['data_profile'] =  $this->db->get('setting_profile')->row_array();
			$data['data_logo'] =  $this->db->get('setting_logo')->row_array();
			$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();



			$this->load->view('template_vegist/header', $data);
			$this->load->view('template_vegist/topbar', $data);
			$this->load->view('client/auth/register');
			$this->load->view('template_vegist/footer');
		} else {
			$email = $this->input->post('email', true);
			$data = [
				'name' => htmlspecialchars($this->input->post('name')),
				'email' => htmlspecialchars($email),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 0,
				'date_created' => time()
			];

			//siapkan token
			$token = base64_encode(random_bytes(32));
			$user_token =
				[
					'email' => $email,
					'token' => $token,
					'date_created' => time()
				];

			$this->db->insert('user', $data);
			$this->db->insert('user_token', $user_token);
			$this->_sendEmail($token, 'verify');
			$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">Congratulation! your account has been created. Please Activate your account!</div>');
			redirect('auth');
		}
	}

	public function registrations()
	{
		if ($this->session->userdata('email')) {
			redirect('user');
		}
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'this email has already registered!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' => 'password dont match!',
			'min_length' => 'password too short!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Kurios Registration';

			$data['data_profile'] =  $this->db->get('setting_profile')->row_array();
			$data['data_logo'] =  $this->db->get('setting_logo')->row_array();
			$data['data_banner'] =  $this->db->get('setting_banner');
			$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

			$data['products'] = $this->Client_model->get_product();
			$data['categori'] = $this->Shop_model->getKategori();

			$this->load->view('template_vegist/header', $data);
			$this->load->view('template_vegist/topbar', $data);
			$this->load->view('client/auth/register');
			$this->load->view('template_vegist/footer');
		} else {
			$email = $this->input->post('email', true);
			$data = [
				'name' => htmlspecialchars($this->input->post('name')),
				'email' => htmlspecialchars($email),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 0,
				'date_created' => time()
			];

			//siapkan token
			$token = base64_encode(random_bytes(32));
			$user_token =
				[
					'email' => $email,
					'token' => $token,
					'date_created' => time()
				];

			$this->db->insert('user', $data);
			$this->db->insert('user_token', $user_token);
			$this->_sendEmail($token, 'verify');
			$this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">Congratulation! your account has been created. Please Activate your account!</div>');
			redirect('auth');
		}
	}
}
