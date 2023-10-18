<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelBerita');
    }

	public function index()
	{
        $data = array(
            'title' => 'News',
            'news' => $this->ModelBerita->lists(),
            'content' => 'berita/tambahBerita'
        );
        $this->load->view('Manager/berita', $data, FALSE);
	}
}
