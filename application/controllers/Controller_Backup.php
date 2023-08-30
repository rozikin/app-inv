<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controller_Backup extends CI_Controller
{
    public function index()
    {
        $data["title"]         = "Backup Database Dengan CodeIgniter";
        $this->load->view('backupdatabase', $data);
    }

    public function backup()
    {
        date_default_timezone_set("Asia/Jakarta"); // set waktu sesuai lokasi

        $this->load->dbutil();
        $pref = [
            'format' => 'zip',
            'filename' => 'blog.sql'
        ];

        $backup     = $this->dbutil->backup($pref);
        $db_name    = 'backup_database__' . date("d-m-Y__H-i-s") . '.zip'; // nama backup dalam bentuk zip
        $save       = './backup/db/' . $db_name; //folder tempat database disimpan

        $this->load->helper('file'); // load helper file
        write_file($save, $backup);

        $this->load->helper("download"); // load helper download
        force_download($db_name, $backup);
    }
}
