<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataAbsen extends CI_Controller {

	public function __construct(){
        parent::__construct();
        if ($this->session->userdata('role') != 'admin'){
            redirect('auth');
        }
    }

	public function index()
	{
        $data['title'] = 'Rekap Absen';
		$data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user') ])->row_array();
		$this->load->view('Manager/header.php', $data);
		$this->load->view('Manager/sidebar.php', $data);
		$this->load->view('Manager/topbar.php', $data);
		$this->load->view('Manager/data_absen.php', $data);
		$this->load->view('Manager/footer.php', $data);
	}
}

?>