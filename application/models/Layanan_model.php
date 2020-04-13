<?php

/**
 *
 */
class Layanan_model extends CI_Model
{

  function __construct()
  {
    // code...
  }

  public function getLayanan($id = null)
  {
      if ($id === NULL) {
        return $this->db->get('layanan')->result_array();
      } else {
        return $this->db->get_where('layanan',['id' => $id])->result_array();
      }
  }

  public function deleteLayanan($id)
  {
    $this->db->delete('layanan', ['id' => $id]);
    return $this->db->affected_rows();
  }

  public function addLayanan($data)
  {
    return $this->db->insert('layanan',$data);
  }

  public function updateLayanan($data, $id)
  {
    $this->db->update('layanan',$data, ['id'=> $id]);
    return $this->db->affected_rows();

  }
}
 ?>
