<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class TahunAjaran extends CI_Controller{

    
    public function index()
    {
        $data['title'] = 'Tahun Ajaran';
        $data['tahun_ajaran'] = $this->ModelTahunAjaran->tampil_data('tahun_ajaran')->result();
        $data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user') ])->row_array();
        $this->load->view('Manager/header.php', $data);
		$this->load->view('Manager/sidebar.php', $data);
		$this->load->view('Manager/topbar.php', $data);
		$this->load->view('Manager/tahun_ajaran.php', $data);
		$this->load->view('Manager/footer.php', $data);
    }

    public function tambahTahunAjaran()
    {
        $data['title'] = 'Tambah Tahun Ajaran';
        $data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user') ])->row_array();
        $this->load->view('Manager/header.php', $data);
		$this->load->view('Manager/sidebar.php', $data);
		$this->load->view('Manager/topbar.php', $data);
		$this->load->view('Manager/tambah_ajaran.php', $data);
		$this->load->view('Manager/footer.php', $data);
    }

    public function simpanTahunAjaran()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE)
        {
            $this->tambahTahunAjaran();
        } else {
            $tahun_ajaran = $this->input->post('tahun_ajaran');     
            $semester = $this->input->post('semester');     
            $status = $this->input->post('status');
            
            $data = array (
                'tahun_ajaran' => $tahun_ajaran,
                'semester' => $semester,
                'status' => $status,   
            );

            $this->ModelTahunAjaran->insert_data($data, 'tahun_ajaran');

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            Data Tahun Ajaran Berhasil Ditambahkan! <button type="button" class="close"
            data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times; </span></button> </div>');
            redirect('Manager/TahunAjaran');
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('tahun_ajaran', 'tahun_ajaran', 'required' ,[
            'required' => 'Tahun Ajaran Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('semester', 'semester', 'required' ,[
            'required' => 'Semester Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('status', 'status', 'required' ,[
            'required' => 'Status Wajib Diisi!'
        ]);
    }

    public function ubah($id_tahun)
    {
        $data['title'] = 'Ubah Tahun Ajaran';
        $data['pp'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user') ])->row_array();
        $where = array('id_tahun' => $id_tahun);
        $data['tahun_ajaran'] = $this->ModelTahunAjaran->edit_data($where, 'tahun_ajaran')->result();
        $this->load->view('Manager/header.php', $data);
		$this->load->view('Manager/sidebar.php', $data);
		$this->load->view('Manager/topbar.php', $data);
		$this->load->view('Manager/ubah_ajaran.php', $data);
		$this->load->view('Manager/footer.php', $data);

    }

    public function ubahTahunAjaran()
    {
        $id_tahun = $this->input->post('id_tahun');
        $tahun_ajaran = $this->input->post('tahun_ajaran');
        $semester = $this->input->post('semester');
        $status = $this->input->post('status');

        $data = array (
            'tahun_ajaran' => $tahun_ajaran,
            'semester' => $semester,
            'status' => $status,
        );

        $where = array (
            'id_tahun' => $id_tahun
        );

        $this->ModelTahunAjaran->update_data($where,$data, 'tahun_ajaran');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
        Data Tahun Ajaran Berhasil Diubah! <button type="button" class="close"
        data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times; </span></button></div>');
        redirect('Manager/TahunAjaran');
    }

    public function hapus($id_tahun)
    {
        $where = array('id_tahun' => $id_tahun);
        $this->ModelTahunAjaran->hapus_data($where,'tahun_ajaran');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        Data Tahun Ajaran Berhasil Dihapus! <button type="button" class="close"
        data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times; </span></button></div>');
        redirect('Manager/TahunAjaran');
    }


}


?>