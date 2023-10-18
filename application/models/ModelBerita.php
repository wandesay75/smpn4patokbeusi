<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class ModelBerita extends CI_Model
{

    public function lists()
    {
        $this->db->select('*');
        $this->db->from('berita');
        $this->db->order_by('id_berita', 'DESC');
        return $this->db->get()->result();
    }
}


?>