<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelMurid extends CI_Model {

  public function getKelas()
  {
    return $this->db->get('kelas');
  }

  public $table = 'murid';
  public $id = 'nis';

  public function get_by_id($id)
  {
    $this->db->where($this->id,$id);
    return $this->db->get($this->table)->row();
  }

}
