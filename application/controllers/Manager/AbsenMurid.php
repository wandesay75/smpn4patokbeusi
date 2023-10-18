<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AbsenMurid extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('ModelAbsensi');
		$this->load->model('ModelMurid');
		$this->load->model('ModelTahunAjaran');
        if ($this->session->userdata('role') != 'admin'){
            redirect('auth');
        }
    }

	public function index()
	{
		$data = array(
            'kelas' => set_value('nama_kelas'),
            'id_tahun' => set_value('id_tahun'),
			'id_absen' => set_value('id_absen')
        );

        $data['title'] = 'Absen Murid';
		$data['kelas'] = $this->ModelMurid->getKelas()->result_array();
		$data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user') ])->row_array();
		$this->load->view('Manager/header.php', $data);
		$this->load->view('Manager/sidebar.php', $data);
		$this->load->view('Manager/topbar.php', $data);
		$this->load->view('Manager/cari_data_kelas.php', $data);
		$this->load->view('Manager/footer.php', $data);
	}

	public function Data()
	{
		$kelas = $this->input->post('nama_kelas', TRUE);
		$tahun_ajaran = $this->input->post('id_tahun', TRUE);
		$absen = $this->input->post('id_absen', TRUE);

		$data = array(
			'nama_kelas' => $kelas,
			'id_tahun' => $tahun_ajaran,
			'id_absen' => $absen,
		);
        $data['title'] = 'Data Absen Kelas';
		$data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user') ])->row_array();
		$dataMurid = array(
            'dataAbsen' => $this->Absen($kelas, $tahun_ajaran),
			'nama_kelas' => $kelas,
            'id_tahun' => $tahun_ajaran,
            'id_absen' => $absen,
            'tahun_ajaran' => $this->ModelTahunAjaran->get_by_id($tahun_ajaran)->tahun_ajaran,
            'semester' => $this->ModelTahunAjaran->get_by_id($tahun_ajaran)->semester,
        );
		$this->load->view('Manager/header.php', $data);
		$this->load->view('Manager/sidebar.php', $data);
		$this->load->view('Manager/topbar.php', $data);
		$this->load->view('Manager/absen_murid.php', $dataMurid);
		$this->load->view('Manager/footer.php', $data);
	}

	public function DataAbsen($kelas, $tahun_ajaran)
	{

		$data = array(
			'nama_kelas' => $kelas,
			'id_tahun' => $tahun_ajaran,
		);
        $data['title'] = 'Data Absen Kelas';
		$data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user') ])->row_array();
		$dataMurid = array(
            'dataAbsen' => $this->Absen($kelas, $tahun_ajaran),
			'nama_kelas' => $kelas,
            'id_tahun' => $tahun_ajaran,
            'tahun_ajaran' => $this->ModelTahunAjaran->get_by_id($tahun_ajaran)->tahun_ajaran,
            'semester' => $this->ModelTahunAjaran->get_by_id($tahun_ajaran)->semester,
        );
		$this->load->view('Manager/header.php', $data);
		$this->load->view('Manager/sidebar.php', $data);
		$this->load->view('Manager/topbar.php', $data);
		$this->load->view('Manager/absen_murid.php', $dataMurid);
		$this->load->view('Manager/footer.php', $data);
	}

	public function Absen($kelas, $tahun_ajaran)
	{
		$this->db->select('*');
		$this->db->from('data_absen as m');
		$this->db->where('m.nama_kelas', $kelas);
		$this->db->where('m.id_tahun', $tahun_ajaran);
		$this->db->join('kelas as k', 'k.nama_kelas = m.nama_kelas');
	
		$nilai = $this->db->get();
		return $nilai->result();
	}
	

	public function buatKelas($kelas, $tahun_ajaran)
	{
		$this->form_validation->set_rules('nama_kelas', 'kelas', 'required|trim');
		if ($this->form_validation->run() == false) {
	

			$data = array(
				'nama_kelas' => $kelas,
				'id_tahun' => $tahun_ajaran,

			);

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


			$kelas = $this->input->post('nama_kelas', TRUE);
			$tahun_ajaran = $this->input->post('id_tahun', TRUE);
			$id_tahun = $this->input->post('id_tahun', TRUE);
			$id_absen = $this->input->post('id_absen', TRUE);

			$data = array(
                'nama_kelas' => $kelas,
                'id_tahun' => $tahun_ajaran,
				'id_absen' => $id_absen
            );

			$data = array(
				'id_absen' => $id_absen,
				'id_tahun' => $id_tahun,
				'nama_kelas' => $kelas,
				'nama_guru' => $this->input->post('nama_guru', true),
				'matapelajaran' => $this->input->post('matapelajaran', true)
		);
			
			$this->session->set_flashdata('message', '
		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4 class="h5 text-center"><i class="icon fas fa-success"></i> Data Berhasil Ditambah! </h4>
		</div>');
	
			$this->db->insert('data_absen', $data);
			redirect('Manager/AbsenMurid/submitAbsen/'. $kelas. '/'. $tahun_ajaran. '/'. $id_absen);

		}
	}

	public function abs($kelas, $tahun_ajaran)
	{
		$this->db->select('*');
		$this->db->from('data_absen as m', 'ASC');
		$this->db->where('k.nama_kelas', $kelas);
		$this->db->where('k.id_tahun', $tahun_ajaran);
		$this->db->join('murid as k', 'k.nama_kelas = m.nama_kelas');
	
		$nilai = $this->db->get();
		return $nilai->result();
	}

public function Submit($kelas, $tahun_ajaran, $id_absen)
{
    // $this->db->select('*');
    // $this->db->from('murid as d');
    // $this->db->where('d.nama_kelas', $kelas);
    // $this->db->where('d.id_tahun', $tahun_ajaran);
    // $this->db->join('data_absen as m', 'm.nama_kelas = d.nama_kelas');
    // $this->db->join('kelas as k', 'k.nama_kelas = d.nama_kelas');



	$this->db->select('*');
	$this->db->from('murid as m');
	$this->db->where('m.nama_kelas', $kelas);
	$this->db->where('m.id_tahun', $tahun_ajaran);	
	$this->db->join('data_absen', 'data_absen.nama_kelas = m.nama_kelas', $id_absen);

    $query = $this->db->get('');
    return $query->result();
}


	public function submitAbsen($kelas, $tahun_ajaran, $id_absen)
	{
		$this->form_validation->set_rules('status[]', 'status', 'required|trim');
		if ($this->form_validation->run() == false) {


			$id_absen = $this->modelAbsensi->get_by_id($id_absen);
			$data = array(
				'nama_kelas' => $kelas,
				'id_tahun' => $tahun_ajaran,
				'id_absen' => $id_absen->id_absen
			);
			$data = array(
				'dataSubmit' => $this->Submit($kelas, $tahun_ajaran, $id_absen),
				'nama_kelas' => $kelas,
				'id_absen' =>  $id_absen->id_absen,
				'id_tahun' => $tahun_ajaran,
				'tahun_ajaran' => $this->ModelTahunAjaran->get_by_id($tahun_ajaran)->tahun_ajaran,
				'semester' => $this->ModelTahunAjaran->get_by_id($tahun_ajaran)->semester,
			);
			$data['title'] = 'Absen Kelas';

			// $data['table'] = $this->db->get_where('murid', ['nama_kelas'])->result();
			// $data['table'] = $this->ModelAbsensi->getMuridbyKelas($id_absen);
			$data['row'] = $this->db->get_where('data_absen', ['id_absen' => $id_absen])->row();
			$data['table'] = $this->db->get('data_absen', ['id_absen'])->result();
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

			$id_tahun = $_POST['id_tahun'];
			$id_absen = $_POST['id_absen'];
			$id_murid = $_POST['id_murid']; // Ambil data nis dan masukkan ke variabel nis
			$nama_murid = $_POST['nama_murid']; // Ambil data nama dan masukkan ke variabel nama
			$nama_kelas = $_POST['nama_kelas']; // Ambil data telp dan masukkan ke variabel telp
			$status = $_POST['status'];
			$data = array();
    
			$index = 0; // Set index array awal dengan 0
			foreach($id_murid as $datanis){ // Kita buat perulangan berdasarkan nis sampai data terakhir
			array_push($data, array(
				'id_murid'=>$datanis,
				'id_tahun'=>$id_tahun[$index],
				'id_absen'=>$id_absen[$index],
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
			redirect('Manager/AbsenMurid/DataAbsen/'. $kelas. '/'. $tahun_ajaran);

		}
	}
}

?>