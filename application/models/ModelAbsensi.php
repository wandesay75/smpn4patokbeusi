<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelAbsensi extends CI_Model {


  private $_table = 'data_absen';

  public function getKelas()
  {
    return $this->db->get('kelas');
  }

  public function getMurid()
  {
    return $this->db->get('murid');
  }

  public function getGuru()
  {
    return $this->db->get('guru');
  }

  public function getMapel()
  {
    return $this->db->get('matapelajaran');
  }

  public function getUser()
  {
    return $this->db->get('user');
  }
  
  public $table = 'data_absen';
  public $id = 'id_absen';

  public function get_by_id($id)
  {
    $this->db->where($this->id,$id);
    return $this->db->get($this->table)->row();
  }

  // public function getMuridbyKelas($id_absen)
  // {
  //   $this->db->select('*');
  //   $this->db->from($this->_table);
  //   $this->db->join('murid', 'murid.nama_kelas=data_absen.nama_kelas');
  //   $this->db->where('id_absen', $id_absen);
  //   $query = $this->db->get();
  //   return $query->result();
  // }

//   public function get_murid_by_kelas($id_absen) {
//     $this->db->where('nama_kelas', $id_absen);
//     return $this->db->get('murid')->result_array();
// }

  public function getAbsen()
  {
    return $this->db->get('data_absen');
  }

}
