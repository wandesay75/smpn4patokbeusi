<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataMurid extends CI_Controller {

	public function __construct(){
        parent::__construct();
		$this->load->model('ModelMurid');
        if ($this->session->userdata('role') != 'admin'){
            redirect('auth');
        }
    }

	public function index()
	{
        $data['title'] = 'Data Murid';
		$data['table'] = $this->db->get('murid')->result();
		$data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user') ])->row_array();
		$this->load->view('Manager/header.php', $data);
		$this->load->view('Manager/sidebar.php', $data);
		$this->load->view('Manager/topbar.php', $data);
		$this->load->view('Manager/data_murid.php', $data);
		$this->load->view('Manager/footer.php', $data);
	}

	public function tambahMurid()
	{
		$this->form_validation->set_rules('nis', 'ID Number', 'required|trim|is_unique[murid.nis]', [
			'is_unique' =>  'This ID Number already registered!'
		]);
		$this->form_validation->set_rules('nama_murid', 'Name', 'required|trim');
		$this->form_validation->set_rules('tempat_lahir', 'Birth Place', 'required|trim');
		$this->form_validation->set_rules('tanggal_lahir', 'Birthday Date', 'required|trim');
		if ($this->form_validation->run() == false) 
		{
			$data['title'] = 'Tambah Murid';
			$data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user') ])->row_array();
			$data['kelas'] = $this->ModelMurid->getKelas()->result_array();
			$this->load->view('Manager/header.php', $data);
			$this->load->view('Manager/sidebar.php', $data);
			$this->load->view('Manager/topbar.php', $data);
			$this->load->view('Manager/tambah_murid.php', $data);
			$this->load->view('Manager/footer.php', $data);
		} else {
			$data = [
				'nis' => $this->input->post('nis', true),
				'nama_murid' => $this->input->post('nama_murid', true),
				'nama_kelas' => $this->input->post('nama_kelas', true),
				'tempat_lahir' => $this->input->post('tempat_lahir', true),
				'tanggal_lahir' => date('Y-m-d'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
				'no_telepon' => $this->input->post('no_telepon', true),
			];
			
			$this->session->set_flashdata('message', '
		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4 class="h5 text-center"><i class="icon fas fa-success"></i> Data Berhasil Ditambah! </h4>
		</div>');

        	$this->db->insert('murid', $data);
			redirect('Manager/DataMurid');
		}
	}

	public function ubahMurid($id_murid)
	{
		$this->form_validation->set_rules('nis', 'ID Number', 'required|trim', [
			'is_unique' =>  'This ID Number already registered!'
		]);
		$this->form_validation->set_rules('nama_murid', 'Name', 'required|trim');
		$this->form_validation->set_rules('tempat_lahir', 'Birth Place', 'required|trim');
		$this->form_validation->set_rules('tanggal_lahir', 'Birthday Date', 'required|trim');
		if ($this->form_validation->run() == false) 
		{
			$data['title'] = 'Ubah Murid';
			$data['row'] = $this->db->get_where('murid', ['id_murid' => $id_murid])->row();
			$data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user') ])->row_array();
			$data['kelas'] = $this->ModelMurid->getKelas()->result_array();
			$this->load->view('Manager/header.php', $data);
			$this->load->view('Manager/sidebar.php', $data);
			$this->load->view('Manager/topbar.php', $data);
			$this->load->view('Manager/ubah_murid.php', $data);
			$this->load->view('Manager/footer.php', $data);
		} else {

			$data = [
				'nis' => $this->input->post('nis', true),
				'nama_murid' => $this->input->post('nama_murid', true),
				'nama_kelas' => $this->input->post('nama_kelas', true),
				'tempat_lahir' => $this->input->post('tempat_lahir', true),
				'tanggal_lahir' => date('Y-m-d'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
				'no_telepon' => $this->input->post('no_telepon', true),
			];
			
			$this->session->set_flashdata('message', '
		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4 class="h5 text-center"><i class="icon fas fa-success"></i> Data Berhasil Diperbarui! </h4>
		</div>');

        	$this->db->where('id_murid', $this->input->post('id_murid'));
        	$this->db->update('murid', $data);
			redirect('Manager/DataMurid');
		}
	}

	public function hapus($id_murid)
	{
		$this->db->delete('murid', ['id_murid' => $id_murid]);
		if ($this->db->affected_rows() > 0){
			$this->session->set_flashdata('message', '
			<div class="text-center alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-warning"></i> Data Telah Terhapus! </h4>
			</div>');
			redirect('Manager/DataMurid');
		}
	}
}

?>