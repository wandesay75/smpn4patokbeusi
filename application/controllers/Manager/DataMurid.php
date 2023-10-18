<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataMurid extends CI_Controller {

	public function __construct(){
        parent::__construct();
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
            'id_tahun' => set_value('id_tahun')
        );

        $data['title'] = 'Data Murid';
		$data['kelas'] = $this->ModelMurid->getKelas()->result_array();
		$data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user') ])->row_array();
		$this->load->view('Manager/header.php', $data);
		$this->load->view('Manager/sidebar.php', $data);
		$this->load->view('Manager/topbar.php', $data);
		$this->load->view('Manager/cari_data_murid.php', $data);
		$this->load->view('Manager/footer.php', $data);
	}

	public function Murid()
	{
		$kelas = $this->input->post('nama_kelas', TRUE);
		$tahun_ajaran = $this->input->post('id_tahun', TRUE);

		$data = array(
			'nama_kelas' => $kelas,
			'id_tahun' => $tahun_ajaran,
		);
        $data['title'] = 'Data Murid Kelas';
		$data['table'] = $this->db->get('murid')->result();
		$data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user') ])->row_array();
		$dataMurid = array(
            'data_murid' => $this->lihatMurid($kelas, $tahun_ajaran),
            'id_tahun' => $tahun_ajaran,
            'tahun_ajaran' => $this->ModelTahunAjaran->get_by_id($tahun_ajaran)->tahun_ajaran,
            'semester' => $this->ModelTahunAjaran->get_by_id($tahun_ajaran)->semester,
			'nama_kelas' => $kelas
        );
		$this->load->view('Manager/header.php', $data);
		$this->load->view('Manager/sidebar.php', $data);
		$this->load->view('Manager/topbar.php', $data);
		$this->load->view('Manager/data_murid.php', $dataMurid);
		$this->load->view('Manager/footer.php', $data);
	}

    public function lihatMurid($kelas, $tahun_ajaran)
    {
        $this->db->select('*');
        $this->db->from('murid as m');
		$this->db->where('k.nama_kelas', $kelas);
        $this->db->where('m.id_tahun', $tahun_ajaran);
        $this->db->join('kelas as k', 'k.nama_kelas = m.nama_kelas');

        $nilai = $this->db->get();
        return $nilai->result();
    }

	public function tambahMurid($kelas, $tahun_ajaran)
	{
		// $this->form_validation->set_rules('nis', 'ID Number', 'required|trim|is_unique[murid.nis]', [
		// 	'is_unique' =>  'This ID Number already registered!'
		// ]);
		$this->form_validation->set_rules('nama_murid', 'Name', 'required|trim');
		$this->form_validation->set_rules('tempat_lahir', 'Birth Place', 'required|trim');
		$this->form_validation->set_rules('tanggal_lahir', 'Birthday Date', 'required|trim');
		if ($this->form_validation->run() == false) 
		{
			$data = array(
				'nama_kelas' => $kelas,
				'id_tahun' => $tahun_ajaran,
			);

			$data['title'] = 'Tambah Murid';
			$data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user') ])->row_array();
			$data['kelas'] = $this->ModelMurid->getKelas()->result_array();
			$this->load->view('Manager/header.php', $data);
			$this->load->view('Manager/sidebar.php', $data);
			$this->load->view('Manager/topbar.php', $data);
			$this->load->view('Manager/tambah_murid.php', $data);
			$this->load->view('Manager/footer.php', $data);
		} else {


			$kelas = $this->input->post('nama_kelas', TRUE);
			$tahun_ajaran = $this->input->post('id_tahun', TRUE);
			$id_tahun = $this->input->post('id_tahun', TRUE);

			$data = array(
                'nis' => $kelas,
                'id_tahun' => $tahun_ajaran,
            );

			$data = array(
				'nis' => $this->input->post('nis', true),
				'id_tahun' => $id_tahun,
				'nama_murid' => $this->input->post('nama_murid', true),
				'nama_kelas' => $kelas,
				'tempat_lahir' => $this->input->post('tempat_lahir', true),
				'tanggal_lahir' => date('Y-m-d'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
				'no_telepon' => $this->input->post('no_telepon', true),
		);

        	$this->db->insert('murid', $data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">Data murid berhasil ditambahkan! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('Manager/DataMurid/Data/' . $kelas . '/' . $id_tahun);
		}
	}

	public function Cetak($kelas, $tahun_ajaran)
	{
		$data = array(
			'nama_kelas' => $kelas,
			'id_tahun' => $tahun_ajaran,
		);

		$dataMurid = array(
            'data_murid' => $this->lihatMurid($kelas, $tahun_ajaran),
            'id_tahun' => $tahun_ajaran,
            'tahun_ajaran' => $this->ModelTahunAjaran->get_by_id($tahun_ajaran)->tahun_ajaran,
            'semester' => $this->ModelTahunAjaran->get_by_id($tahun_ajaran)->semester,
			'nama_kelas' => $kelas
        );

		$this->load->view('Manager/cetak_data_murid.php', $dataMurid);
	}

	public function Data($kelas, $tahun_ajaran)
	{
		$data = array(
			'nama_kelas' => $kelas,
			'id_tahun' => $tahun_ajaran,
		);
        $data['title'] = 'Data Murid Kelas';
		$data['table'] = $this->db->get('murid')->result();
		$data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user') ])->row_array();
		$dataMurid = array(
            'data_murid' => $this->lihatMurid($kelas, $tahun_ajaran),
            'id_tahun' => $tahun_ajaran,
            'tahun_ajaran' => $this->ModelTahunAjaran->get_by_id($tahun_ajaran)->tahun_ajaran,
            'semester' => $this->ModelTahunAjaran->get_by_id($tahun_ajaran)->semester,
			'nama_kelas' => $kelas
        );
		$this->load->view('Manager/header.php', $data);
		$this->load->view('Manager/sidebar.php', $data);
		$this->load->view('Manager/topbar.php', $data);
		$this->load->view('Manager/data_murid.php', $dataMurid);
		$this->load->view('Manager/footer.php', $data);
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