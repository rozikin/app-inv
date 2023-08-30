<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Send_email extends CI_Controller
{

    /**
     * Kirim email dengan SMTP Gmail.
     *
     */
    public function index()
    {
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




        // Email dan nama pengirim
        $this->email->from('minion.indonesia33@gmail.com', 'MasRud.com');

        // Email penerima
        $this->email->to('rozi@kurios-utama.com'); // Ganti dengan email tujuan

        // Lampiran email, isi dengan url/path file


        // Subject email
        $this->email->subject('Registration');

        // Isi email
        $this->email->message("Ini adalah contoh email yang dikirim menggunakan SMTP Gmail pada CodeIgniter.<br><br> Klik <strong><a href='https://masrud.com/kirim-email-codeigniter/' target='_blank' rel='noopener'>disini</a></strong> untuk melihat tutorialnya.");

        // Tampilkan pesan sukses atau error
        if ($this->email->send()) {
            echo 'Sukses! email berhasil dikirim.';
        } else {
            echo $this->email->print_debugger();
        }
    }
}
