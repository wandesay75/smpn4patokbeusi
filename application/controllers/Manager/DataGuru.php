<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataGuru extends CI_Controller {

	public function __construct(){
        parent::__construct();
		$this->load->model('ModelGuru');
        if ($this->session->userdata('role') != 'admin'){
            redirect('auth');
        }
    }

	public function index()
	{
        $data['title'] = 'Data Guru';
		$data['table'] = $this->db->get('guru')->result();
		$data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user') ])->row_array();
		$this->load->view('Manager/header.php', $data);
		$this->load->view('Manager/sidebar.php', $data);
		$this->load->view('Manager/topbar.php', $data);
		$this->load->view('Manager/data_guru.php', $data);
		$this->load->view('Manager/footer.php', $data);
	}

	public function tambahGuru()
	{
		$this->form_validation->set_rules('nip', 'ID Number', 'required|trim|is_unique[guru.nip]', [
			'is_unique' => 'This ID Number already registered!'
		]);
		$this->form_validation->set_rules('nama_guru', 'Name', 'required|trim');
		$this->form_validation->set_rules('tanggal_lahir', 'Birthday Date', 'required|trim');
		if ($this->form_validation->run() == false) 
		{
			$data['title'] = 'Tambah Guru';
			$data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user') ])->row_array();
			$data['mapel'] = $this->ModelGuru->getMapel()->result_array();
			$this->load->view('Manager/header.php', $data);
			$this->load->view('Manager/sidebar.php', $data);
			$this->load->view('Manager/topbar.php', $data);
			$this->load->view('Manager/tambah_guru.php', $data);
			$this->load->view('Manager/footer.php', $data);
		} else {
			$config['upload_path']          = 'assets/img';
			$config['allowed_types']        = 'gif|jpg|png|jpeg|heic|heif';
			$config['max_size']             = '10240';

			$this->load->library('upload', $config); 

			if ($this->upload->do_upload("foto")) {
				$imageData = $this->upload->data();
				$fileName = $imageData['file_name']; 
			} else {
				//flashdata massage
				$x = $this->upload->display_errors();
				$this->session->set_flashdata(
					'message',
					'<div class="text-danger">
					<strong> ' . $x . ' </strong> 
					</div>'
				);
				$fix = $this->input->post('id_guru');
				redirect('Manager/DataGuru/tambahGuru/' . $fix);
			}


			$data = [
				'nip' => $this->input->post('nip', true),
				'nama_guru' => $this->input->post('nama_guru', true),
				'tanggal_lahir' => date('Y-m-d'),
				'jabatan' => $this->input->post('jabatan', true),
				'matapelajaran' => $this->input->post('matapelajaran', true),
				'foto' => $fileName
			];
			
			$this->session->set_flashdata('message', '
		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4 class="h5 text-center"><i class="icon fas fa-success"></i> Data Berhasil Ditambah! </h4>
		</div>');

        	$this->db->insert('guru', $data);
			redirect('Manager/DataGuru');
		}

	}
	

	public function ubahGuru($id_guru)
	{
		$this->form_validation->set_rules('nip', 'ID Number', 'required|trim');
		$this->form_validation->set_rules('nama_guru', 'Name', 'required|trim');
		$this->form_validation->set_rules('tanggal_lahir', 'Birthday Date', 'required|trim');
		if ($this->form_validation->run() == false) 
		{
			$data['title'] = 'Ubah Guru';
			$data['row'] = $this->db->get_where('guru', ['id_guru' => $id_guru])->row();
			$data['table'] = $this->db->get('guru')->result();
			$data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user') ])->row_array();
			$data['mapel'] = $this->ModelGuru->getMapel()->result_array();
			$this->load->view('Manager/header.php', $data);
			$this->load->view('Manager/sidebar.php', $data);
			$this->load->view('Manager/topbar.php', $data);
			$this->load->view('Manager/ubah_guru.php', $data);
			$this->load->view('Manager/footer.php', $data);
		} else {
			$config['upload_path']          = 'assets/img';
			$config['allowed_types']        = 'gif|jpg|png|jpeg|heic|heif';
			$config['max_size']             = '10240';

			$this->load->library('upload', $config); 

			if ($this->upload->do_upload("foto")) {
				$imageData = $this->upload->data();
				$fileName = $imageData['file_name']; 
			} else {
				//flashdata massage
				$x = $this->upload->display_errors();
				$this->session->set_flashdata(
					'message',
					'<div class="text-danger">
					<strong> ' . $x . ' </strong> 
					</div>'
				);
				$fix = $this->input->post('id_guru');
				redirect('Manager/DataGuru/ubahGuru/' . $fix);
			}


			$data = [
				'nip' => $this->input->post('nip', true),
				'nama_guru' => $this->input->post('nama_guru', true),
				'tanggal_lahir' => date('Y-m-d'),
				'jabatan' => $this->input->post('jabatan', true),
				'matapelajaran' => $this->input->post('matapelajaran', true),
				'foto' => $fileName
			];
			
			$this->session->set_flashdata('message', '
		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4 class="h5 text-center"><i class="icon fas fa-success"></i> Data Berhasil Diperbarui! </h4>
		</div>');

        	$this->db->where('id_guru', $this->input->post('id_guru'));
			$this->db->update('guru', $data);
			redirect('Manager/DataGuru');
		}
	}
	

	public function hapus($id_guru)
	{
		$this->db->delete('guru', ['id_guru' => $id_guru]);
		if ($this->db->affected_rows() > 0){
			$this->session->set_flashdata('message', '
			<div class="alert alert-warning alert-dismissible">
				<button type="text-center button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-warning"></i> Data Telah Terhapus! </h4>
			</div>');
			redirect('Manager/DataGuru');
		}
	}
}

?>