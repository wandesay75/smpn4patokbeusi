<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelGuru extends CI_Model {

  public function getMapel()
  {
    return $this->db->get('matapelajaran');
  }

  public function getGuru()
  {
    return $this->db->get('guru');
  }

  }
