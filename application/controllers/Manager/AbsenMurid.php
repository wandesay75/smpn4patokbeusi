<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AbsenMurid extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('ModelAbsensi');
        if ($this->session->userdata('role') != 'admin'){
            redirect('auth');
        }
    }

	public function index()
	{
        $data['title'] = 'Absen Murid';
        $data['table'] = $this->db->get('data_absen')->result(); 
		$data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user') ])->row_array();
		$this->load->view('Manager/header.php', $data);
		$this->load->view('Manager/sidebar.php', $data);
		$this->load->view('Manager/topbar.php', $data);
		$this->load->view('Manager/absen_murid.php', $data);
		$this->load->view('Manager/footer.php', $data);
	}

	public function buatKelas()
	{
		$this->form_validation->set_rules('nama_kelas', 'kelas', 'required|trim');
		if ($this->form_validation->run() == false) {

			$data['title'] = 'Buat Absen Kelas';
			$data['kelas'] = $this->ModelAbsensi->getKelas()->result_array();
			$data['guru'] = $this->ModelAbsensi->getGuru()->result_array();
			$data['mapel'] = $this->ModelAbsensi->getMapel()->result_array();
			$data['user'] = $this->ModelAbsensi->getUser()->result_array();
			$data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user') ])->row_array();
			$this->load->view('Manager/header.php', $data);
			$this->load->view('Manager/sidebar.php', $data);
			$this->load->view('Manager/topbar.php', $data);
			$this->load->view('Manager/buat_kelas.php', $data);
			$this->load->view('Manager/footer.php', $data);
		} else {

			$data = [
				'id_user' => $this->input->post('id_user', true),
				'nama_kelas' => $this->input->post('nama_kelas', true),
				'nama_guru' => $this->input->post('nama_guru', true),
				'matapelajaran' => $this->input->post('matapelajaran', true),
			];
			
			$this->session->set_flashdata('message', '
		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4 class="h5 text-center"><i class="icon fas fa-success"></i> Data Berhasil Ditambah! </h4>
		</div>');
	
			$this->db->insert('data_absen', $data);
			redirect('Manager/AbsenMurid');

		}
	}

	public function lihatAbsen($id_absen)
	{
		$this->form_validation->set_rules('status[]', 'status', 'required|trim');
		if ($this->form_validation->run() == false) {
			

			$data['title'] = 'Absen Kelas';
			$data['submit'] = $this->db->get_where('submit_absen', ['id_submit' => $id_absen])->row();
			$data['row'] = $this->db->get_where('data_absen', ['id_absen' => $id_absen])->row();
			// $data['table'] = $this->db->get_where('murid', ['nama_kelas'])->result();
			$data['table'] = $this->ModelAbsensi->getMuridbyKelas($id_absen);
			$data['kelas'] = $this->ModelAbsensi->getKelas()->result_array();
			$data['guru'] = $this->ModelAbsensi->getGuru()->result_array();
			$data['mapel'] = $this->ModelAbsensi->getMapel()->result_array();
			$data['user'] = $this->ModelAbsensi->getUser()->result_array();
			$data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user') ])->row_array();
			$this->load->view('Manager/header.php', $data);
			$this->load->view('Manager/sidebar.php', $data);
			$this->load->view('Manager/topbar.php', $data);
			$this->load->view('Manager/lihat_absen.php', $data);
			$this->load->view('Manager/footer.php', $data);
		} else {

			$id_murid = $_POST['id_murid']; // Ambil data nis dan masukkan ke variabel nis
			$nama_murid = $_POST['nama_murid']; // Ambil data nama dan masukkan ke variabel nama
			$nama_kelas = $_POST['nama_kelas']; // Ambil data telp dan masukkan ke variabel telp
			$status = $_POST['status'];
			$data = array();
    
			$index = 0; // Set index array awal dengan 0
			foreach($id_murid as $datanis){ // Kita buat perulangan berdasarkan nis sampai data terakhir
			array_push($data, array(
				'id_murid'=>$datanis,
				'nama_murid'=>$nama_murid[$index],  // Ambil dan set data nama sesuai index array dari $index
				'nama_kelas'=>$nama_kelas[$index],  // Ambil dan set data telepon sesuai index array dari $index
				'status'=>$status[$index],  // Ambil dan set data alamat sesuai index array dari $index
			));
			
			$index++;
			}

			// $data = [
			// 	'id_murid' => $this->input->post('id_murid', true),
			// 	'nama_murid' => $this->input->post('nama_murid', true),
			// 	'nama_kelas' => $this->input->post('nama_kelas', true),
			// 	'status' => $this->input->post('status', true),
			// ];

			
			
			$this->session->set_flashdata('message', '
				<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4 class="h5 text-center"><i class="icon fas fa-success"></i> Data Berhasil Ditambah! </h4>
				</div>');
	
			$this->db->insert_batch('submit_absen', $data);
			redirect('Manager/AbsenMurid');

		}
	}
}

?>