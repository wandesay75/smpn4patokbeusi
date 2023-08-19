<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelMurid');
        if ($this->session->userdata('role') != 'admin'){
            redirect('auth');
        }
    }

    public function index()
    {

        $data = array(
            'nis' => set_value('nis'),
            'id_tahun' => set_value('id_tahun')
        );

        $data['title'] = 'Data Nilai';
        $data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user') ])->row_array();
        $this->load->view('Manager/header.php' , $data);
        $this->load->view('Manager/sidebar.php', $data);
        $this->load->view('Manager/topbar.php', $data);
        $this->load->view('Manager/data_nilai.php', $data);
        $this->load->view('Manager/footer.php', $data);
    }

    public function CariNilai()
    {
        $this->_rulesNilai();
    
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $nis = $this->input->post('nis', TRUE);
            $tahun_ajaran = $this->input->post('id_tahun', TRUE);
    
            // Memeriksa ketersediaan Nomor Induk Siswa
            if ($this->ModelMurid->get_by_id($nis) == null) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                Nomor Induk Siswa tidak ditemukan! :( <button type="button" class="close"
                data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times; </span></button></div>');
                redirect('Manager/Nilai');
            }
    
            $data = array(
                'nis' => $nis,
                'id_tahun' => $tahun_ajaran,
                'nama_murid' => $this->ModelMurid->get_by_id($nis)->nama_murid
            );
            $dataNilai = array(
                'nilai_data' => $this->lihatNilai($nis, $tahun_ajaran),
                'nis' => $nis,
                'id_tahun' => $tahun_ajaran,
                'tahun_ajaran' => $this->ModelTahunAjaran->get_by_id($tahun_ajaran)->tahun_ajaran,
                'semester' => $this->ModelTahunAjaran->get_by_id($tahun_ajaran)->semester == 1 ? 'Ganjil' : 'Genap',
                'nama_murid' => $this->ModelMurid->get_by_id($nis)->nama_murid,
                'nama_kelas' => $this->ModelMurid->get_by_id($nis)->nama_kelas,
            );
    
            $data['title'] = 'Nilai Matapelajaran';
            $data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();
            $this->load->view('Manager/header.php', $data);
            $this->load->view('Manager/sidebar.php', $data);
            $this->load->view('Manager/topbar.php', $data);
            $this->load->view('Manager/lihat_nilai.php', $dataNilai);
            $this->load->view('Manager/footer.php', $data);
        }
    }
    

    public function lihatNilai($nis,$tahun_ajaran)
    {
        $this->db->select('k.id_nilai,k.kd_mapel,m.nama_mapel');
        $this->db->from('nilai as k');
        $this->db->where('k.nis', $nis);
        $this->db->where('k.id_tahun', $tahun_ajaran);
        $this->db->join('matapelajaran as m', 'm.kd_mapel = k.kd_mapel');

        $nilai = $this->db->get()->result();
        return $nilai;
    }

    public function _rulesNilai()
    {
        $this->form_validation->set_rules('nis', 'nis', 'required');
        $this->form_validation->set_rules('id_tahun', 'id_tahun', 'required');
    }

}