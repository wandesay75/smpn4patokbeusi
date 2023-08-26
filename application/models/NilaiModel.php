<?php 

class NilaiModel extends CI_Model{

    public $table = 'nilai';
    public $id = 'id_nilai';

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function get_by_id($id)
    {
      $this->db->where($this->id,$id);
      return $this->db->get($this->table)->row();
    }

    public function update($id, $data)
    {
      $this->db->where($this->id, $id);
      $this->db->update($this->table, $data);
    }

    public function delete($where, $table)
    {
      $this->db->where($where);
      $this->db->delete($table);
    }
}

?>