<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelKelas extends CI_Model
{
    public $table = 'kelas';
    public $id = 'id_kelas';
  
    public function get_by_id($id)
    {
      $this->db->where($this->id,$id);
      return $this->db->get($this->table)->row();
    }
  
}


?>