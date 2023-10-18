<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataAkun extends CI_Controller {

	public function __construct(){
        parent::__construct();
        if ($this->session->userdata('role') != 'admin'){
            redirect('auth');
        }
    }

	public function index()
	{
        $data['title'] = 'Data Akun';
		$data['table'] = $this->db->get('user')->result();
		$data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user') ])->row_array();
		$this->load->view('Manager/header.php', $data);
		$this->load->view('Manager/sidebar.php', $data);
		$this->load->view('Manager/topbar.php', $data);
		$this->load->view('Manager/data_akun.php', $data);
		$this->load->view('Manager/footer.php', $data);
	}

	public function tambahAkun($data = null)
	{
		$this->form_validation->set_rules('nama_user', 'Username', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'Email Ini Sudah Terdaftar!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|max_length[16]|matches[password2]', [
			'matches' => 'Katasandi Anda Tidak Cocok!',
			'min_length' => 'Katasandi Anda Terlalu Pendek! (Minimal 8 Kata)',
			'max_length' => 'Katasandi Anda Terlalu Panjang! (Maksimal 16 Kata)']);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[8]|max_length[16]|matches[password1]');
		if($this->form_validation->run() == false)
		{
			$data['title'] = 'Tambah Akun';
			$data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user') ])->row_array();
			$this->load->view('Manager/header.php', $data);
			$this->load->view('Manager/sidebar.php', $data);
			$this->load->view('Manager/topbar.php', $data);
			$this->load->view('Manager/tambah_akun.php', $data);
			$this->load->view('Manager/footer.php', $data);
		} else{
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
				$fix = $this->input->post('id_user');
				redirect('Manager/DataAkun/tambahAkun/' . $fix);
			}


			$data = [
				'nama_user' => $this->input->post('nama_user'),
				'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'foto' => $fileName,
				'role' => $this->input->post('role')
			];
			
			$this->session->set_flashdata('message', '
		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4 class="h5 text-center"><i class="icon fas fa-success"></i> Data Berhasil Ditambah! </h4>
		</div>');
			$this->db->insert('user', $data);
			redirect('Manager/DataAkun');
		}
	}

	public function ubahAkun($id_user)
	{

		$this->form_validation->set_rules('nama_user', 'Username', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|max_length[16]|matches[password2]', [
			'matches' => 'Password are not match!',
			'min_length' => 'Password too short!',
			'max_length' => 'Password too long!']);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[8]|max_length[16]|matches[password1]');
		if($this->form_validation->run() == false)
		{
			$data['title'] = 'Ubah Akun';
			$data['row'] = $this->db->get_where('user', ['id_user' => $id_user])->row();
			$data['table'] = $this->db->get('user')->result();
			$data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user') ])->row_array();
			$this->load->view('Manager/header.php', $data);
			$this->load->view('Manager/sidebar.php', $data);
			$this->load->view('Manager/topbar.php', $data);
			$this->load->view('Manager/ubah_akun.php', $data);
			$this->load->view('Manager/footer.php', $data);
		} else{
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
				$fix = $this->input->post('id_user');
				redirect('Manager/DataAkun/ubahAkun/' . $fix);
			}


			$data = [
				'nama_user' => $this->input->post('nama_user', true),
				'email' => $this->input->post('email', true),
				'password' => password_hash($this->input->post('password1', true), PASSWORD_DEFAULT),
				'foto' => $fileName,
				'role' => $this->input->post('role', true)
			];
			
			$this->session->set_flashdata('message', '
		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4 class="h5 text-center"><i class="icon fas fa-success"></i> Data Berhasil Diperbarui! </h4>
		</div>');

			$this->db->where('id_user', $this->input->post('id_user'));
        	$this->db->update('user', $data);
			redirect('Manager/DataAkun');
		}

	}

	public function hapus($id_user)
	{
	$this->db->delete('user', ['id_user' => $id_user]);
	if ($this->db->affected_rows() > 0){
		$this->session->set_flashdata('message', '
		<div class="text-center alert alert-warning alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4 class="h5 text-center"><i class="icon fa fa-warning"></i> Data Telah Terhapus! </h4>
		</div>');
		redirect('Manager/DataAkun/');
	}
  }

}

?>