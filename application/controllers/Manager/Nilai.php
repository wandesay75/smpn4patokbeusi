<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelMurid');
        $this->load->model('NilaiModel'); // tambahkan ini jika belum dimuat
        $this->load->model('ModelTahunAjaran'); // tambahkan ini jika belum dimuat
        
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

        $data['title'] = 'Cari Nilai';
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
            $murid = $this->ModelMurid->get_by_id($nis);
            if (!$murid) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                Nomor Induk Siswa tidak ditemukan! :( <button type="button" class="close"
                data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times; </span></button></div>');
                redirect('Manager/Nilai');
            }
    
            $data = array(
                'nis' => $nis,
                'id_tahun' => $tahun_ajaran,
                'nama_murid' => $murid->nama_murid
            );
            $dataNilai = array(
                'nilai_data' => $this->lihatNilai($nis, $tahun_ajaran),
                'nis' => $nis,
                'id_tahun' => $tahun_ajaran,
                'tahun_ajaran' => $this->ModelTahunAjaran->get_by_id($tahun_ajaran)->tahun_ajaran,
                'semester' => $this->ModelTahunAjaran->get_by_id($tahun_ajaran)->semester,
                'nama_murid' => $murid->nama_murid,
                'nama_kelas' => $murid->nama_kelas,
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

    public function DataNilai($nis, $tahun_ajaran)
    {
        $murid = $this->ModelMurid->get_by_id($nis);
        $data = array(
            'nis' => $nis,
            'id_tahun' => $tahun_ajaran,
            'nama_murid' => $murid->nama_murid
        );
        $dataNilai = array(
            'nilai_data' => $this->lihatNilai($nis, $tahun_ajaran),
            'nis' => $nis,
            'id_tahun' => $tahun_ajaran,
            'tahun_ajaran' => $this->ModelTahunAjaran->get_by_id($tahun_ajaran)->tahun_ajaran,
            'semester' => $this->ModelTahunAjaran->get_by_id($tahun_ajaran)->semester,
            'nama_murid' => $murid->nama_murid,
            'nama_kelas' => $murid->nama_kelas,
        );

        $data['title'] = 'Nilai Matapelajaran';
        $data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $this->load->view('Manager/header.php', $data);
        $this->load->view('Manager/sidebar.php', $data);
        $this->load->view('Manager/topbar.php', $data);
        $this->load->view('Manager/lihat_nilai.php', $dataNilai);
        $this->load->view('Manager/footer.php', $data);
    
    }

    public function lihatNilai($nis, $tahun_ajaran)
    {
        $this->db->select('k.id_nilai, k.kd_mapel, m.nama_mapel, k.nilai_tugas, k.nilai_uts, k.nilai_uas, k.total_nilai');
        $this->db->from('nilai as k');
        $this->db->where('k.nis', $nis);
        $this->db->where('k.id_tahun', $tahun_ajaran);
        $this->db->join('matapelajaran as m', 'm.kd_mapel = k.kd_mapel');

        $nilai = $this->db->get();
        return $nilai->result();
    }

    public function _rulesNilai()
    {
        $this->form_validation->set_rules('nis', 'Nomor Induk Siswa', 'required');
        $this->form_validation->set_rules('id_tahun', 'Tahun Ajaran', 'required');
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_nilai', 'ID Nilai', 'required');
        $this->form_validation->set_rules('id_tahun', 'Tahun Ajaran', 'required');
        $this->form_validation->set_rules('nis', 'Nomor Induk Siswa', 'required');
        $this->form_validation->set_rules('kd_mapel', 'Kode Matapelajaran', 'required');
        $this->form_validation->set_rules('nilai_tugas', 'Nilai Tugas', 'required');
        $this->form_validation->set_rules('nilai_uts', 'Nilai UTS', 'required');
        $this->form_validation->set_rules('nilai_uas', 'Nilai UAS', 'required');
    }

    public function tambahDataNilai($nis, $tahun_ajaran)
    {
        $data = array(
            'id_nilai' => set_value('id_nilai'),
            'id_tahun' => $tahun_ajaran,
            'tahun_ajaran' => $this->ModelTahunAjaran->get_by_id($tahun_ajaran)->tahun_ajaran,
            'semester' => $this->ModelTahunAjaran->get_by_id($tahun_ajaran)->semester,
            'nama_murid' => $this->ModelMurid->get_by_id($nis)->nama_murid,
            'nis' => $nis,
            'kd_mapel' => set_value('kd_mapel')
        );
        $data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['title'] = 'Tambah Nilai';
        $this->load->view('Manager/header.php', $data);
        $this->load->view('Manager/sidebar.php', $data);
        $this->load->view('Manager/topbar.php', $data);
        $this->load->view('Manager/tambah_data_nilai.php', $data);
        $this->load->view('Manager/footer.php', $data);
    }

    public function simpanDataNilai($nis, $tahun_ajaran)
    {
        $this->_rules();
        
        if ($this->form_validation->run() == FALSE) {
            $this->tambahDataNilai();
        } else {
            $tugas = $this->input->post('nilai_tugas', TRUE);
            $uts = $this->input->post('nilai_uts', TRUE);
            $uas = $this->input->post('nilai_uas', TRUE);
            
            $total_nilai = round(($tugas + $uts + $uas) / 3);
    
            $nis = $this->input->post('nis', TRUE);
            $id_tahun = $this->input->post('id_tahun', TRUE);
            $kd_mapel = $this->input->post('kd_mapel', TRUE);
            $nama_murid = $this->input->post('nama_murid', TRUE);
            $nilai_tugas = $tugas;
            $nilai_uts = $uts;
            $nilai_uas = $uas;
            $total_nilai = $total_nilai;
            $tahun_ajaran = $this->input->post('id_tahun', TRUE);
    
            $data = array(
                'id_tahun' => $id_tahun,
                'nis' => $nis,
                'nama_murid' => $nama_murid,
                'kd_mapel' => $kd_mapel,
                'nilai_tugas' => $nilai_tugas,
                'nilai_uts' => $nilai_uts,
                'nilai_uas' => $nilai_uas,
                'total_nilai' => $total_nilai,
            );
    
            $this->NilaiModel->insert($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">Data nilai berhasil ditambahkan! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('Manager/Nilai/DataNilai/' . $nis . '/' . $id_tahun);
        }
    }

    public function update($id)
    {
        $row = $this->NilaiModel->get_by_id($id);
        $th = $row->id_tahun;

        if ($row) {
            $data = array(
                'id_nilai' => set_value('id_nilai', $row->id_nilai),
                'id_tahun' => set_value('id_tahun', $row->id_tahun),
                'nis' => set_value('nis', $row->nis),
                'nama_murid' => set_value('nama_murid', $row->nama_murid),
                'kd_mapel' => set_value('kd_mapel', $row->kd_mapel),
                'nilai_tugas' => set_value('nilai_tugas', $row->nilai_tugas),
                'nilai_uts' => set_value('nilai_uts', $row->nilai_uts),
                'nilai_uas' => set_value('nilai_uas', $row->nilai_uas),
                'tahun_ajaran' => $this->ModelTahunAjaran->get_by_id($th)->tahun_ajaran,
                'semester' => $this->ModelTahunAjaran->get_by_id($th)->semester,
            );
            $data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();
            $data['title'] = 'Ubah Data Nilai';
            $this->load->view('Manager/header.php', $data);
            $this->load->view('Manager/sidebar.php', $data);
            $this->load->view('Manager/topbar.php', $data);
            $this->load->view('Manager/ubah_data_nilai.php', $data);
            $this->load->view('Manager/footer.php', $data);
        } else {
            echo "Data tidak ditemukan!";
        }
    }
    
    public function simpanUpdate()
    {
        if (isset($_POST['nilai_tugas']) && isset($_POST['nilai_uts']) && isset($_POST['nilai_uas'])) {
            $tugas = $_POST['nilai_tugas'];
            $uts = $_POST['nilai_uts'];
            $uas = $_POST['nilai_uas'];
            
            $total_nilai = round(($tugas + $uts + $uas) / 3);
        }

        $id_nilai = $this->input->post('id_nilai', TRUE);
        $nis = $this->input->post('nis', TRUE);
        $id_tahun = $this->input->post('id_tahun', TRUE);
        $kd_mapel = $this->input->post('kd_mapel', TRUE);
        $nama_murid = $this->input->post('nama_murid', TRUE);
        $nilai_tugas = $this->input->post('nilai_tugas', TRUE);
        $nilai_uts = $this->input->post('nilai_uts', TRUE);
        $nilai_uas = $this->input->post('nilai_uas', TRUE);
        $total_nilai = $total_nilai;

        $data = array(
            'id_nilai' => $id_nilai,
            'id_tahun' => $id_tahun,
            'nis' => $nis,
            'kd_mapel' => $this->input->post('kd_mapel', TRUE),
            'nama_murid' => $nama_murid,
            'nilai_tugas' => $nilai_tugas,
            'nilai_uts' => $nilai_uts,
            'nilai_uas' => $nilai_uas,
            'total_nilai' => $total_nilai,
        );

        $this->NilaiModel->update($id_nilai, $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">Data nilai berhasil diubah! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('Manager/Nilai/DataNilai/' . $nis . '/' . $id_tahun);
    }

    public function hapus($id)
    {
        $where = array('id_nilai' => $id);
        $this->NilaiModel->delete($where, 'nilai');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">Data nilai berhasil dihapus! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('Manager/Nilai/DataNilai/' . $nis . '/' . $id_tahun);
    }

    public function cetakNilai($nis, $tahun_ajaran)
    {   
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
            'semester' => $this->ModelTahunAjaran->get_by_id($tahun_ajaran)->semester,
            'nama_murid' => $this->ModelMurid->get_by_id($nis)->nama_murid,
            'nama_kelas' => $this->ModelMurid->get_by_id($nis)->nama_kelas,
        );
        $this->load->view('Manager/cetak_data_nilai.php', $dataNilai);
    }
}
