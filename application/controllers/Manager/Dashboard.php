<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
        parent::__construct();
        if ($this->session->userdata('role') != 'admin'){
            redirect('auth');
        }
    }

	public function index()
	{
        $data['title'] = 'Halaman Dashboard';
		$data['total_murid'] = $this->db->get('murid')->num_rows();
		$data['total_kelas'] = $this->db->get('kelas')->num_rows();
		$data['total_guru'] = $this->db->get('guru')->num_rows();
		$data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user') ])->row_array();
		$this->load->view('Manager/header.php', $data);
		$this->load->view('Manager/sidebar.php', $data);
		$this->load->view('Manager/topbar.php', $data);
		$this->load->view('Manager/dashboard.php', $data);
		$this->load->view('Manager/footer.php', $data);
	}
}

?>