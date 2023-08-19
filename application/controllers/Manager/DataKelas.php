<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataKelas extends CI_Controller {

	public function __construct(){
        parent::__construct();
		$this->load->model('ModelGuru');
        if ($this->session->userdata('role') != 'admin'){
            redirect('auth');
        }
    }

	public function index()
	{
        $data['title'] = 'Data Kelas';
		$data['table'] = $this->db->get('kelas')->result();
		$data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user') ])->row_array();
		$this->load->view('Manager/header.php', $data);
		$this->load->view('Manager/sidebar.php', $data);
		$this->load->view('Manager/topbar.php', $data);
		$this->load->view('Manager/data_kelas.php', $data);
		$this->load->view('Manager/footer.php', $data);
	}

	public function tambahKelas()
	{
		$this->form_validation->set_rules('nama_kelas', 'Name', 'required|trim');
		$this->form_validation->set_rules('wali_kelas', 'Teacher', 'required|trim');
		if ($this->form_validation->run() == false) 
		{
			$data['title'] = 'Tambah Kelas';
			$data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user') ])->row_array();
			$data['walikelas'] = $this->ModelGuru->getGuru()->result_array();
			$this->load->view('Manager/header.php', $data);
			$this->load->view('Manager/sidebar.php', $data);
			$this->load->view('Manager/topbar.php', $data);
			$this->load->view('Manager/tambah_kelas.php', $data);
			$this->load->view('Manager/footer.php', $data);
		} else {

			$data = [
				'nama_kelas' => $this->input->post('nama_kelas', true),
				'wali_kelas' => $this->input->post('wali_kelas', true)
			];
			
			$this->session->set_flashdata('message', '
		<div class="text-center alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4 class="h5 text-center"><i class="icon fas fa-success"></i> Data Berhasil Ditambah! </h4>
		</div>');

        	$this->db->insert('kelas', $data);
			redirect('Manager/DataKelas');
		}
	}

	public function ubahKelas($id_kelas)
	{
		$this->form_validation->set_rules('nama_kelas', 'Name', 'required|trim');
		$this->form_validation->set_rules('wali_kelas', 'Teacher', 'required|trim');
		if ($this->form_validation->run() == false) 
		{
			$data['title'] = 'Ubah Kelas';
			$data['row'] = $this->db->get_where('kelas', ['id_kelas' => $id_kelas])->row();
			$data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user') ])->row_array();
			$data['walikelas'] = $this->ModelGuru->getGuru()->result_array();
			$this->load->view('Manager/header.php', $data);
			$this->load->view('Manager/sidebar.php', $data);
			$this->load->view('Manager/topbar.php', $data);
			$this->load->view('Manager/ubah_kelas.php', $data);
			$this->load->view('Manager/footer.php', $data);
		} else {

			$data = [
				'nama_kelas' => $this->input->post('nama_kelas', true),
				'wali_kelas' => $this->input->post('wali_kelas', true)
			];
			
			$this->session->set_flashdata('message', '
		<div class="text-center alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4 class="h5 text-center"><i class="icon fas fa-success"></i> Data Berhasil Ditambah! </h4>
		</div>');

			$this->db->where('id_kelas', $this->input->post('id_kelas'));
        	$this->db->update('kelas', $data);
			redirect('Manager/DataKelas');
		}
	}

	public function hapus($id_kelas)
	{
		$this->db->delete('kelas', ['id_kelas' => $id_kelas]);
		if ($this->db->affected_rows() > 0){
			$this->session->set_flashdata('message', '
			<div class="text-center alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-warning"></i> Data Telah Terhapus! </h4>
			</div>');
			redirect('Manager/DataKelas');
		}
	}

}

?>