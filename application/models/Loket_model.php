<?php

/**
 *
 */
class Loket_model extends CI_Model
{

  function __construct()
  {
    // code...
  }

  public function getLoket($id = null)
  {
      if ($id === NULL) {
        return $this->db->get('loket')->result_array();
      } else {
        return $this->db->get_where('loket',['id' => $id])->result_array();
      }
  }

  public function deleteLoket($id)
  {
    $this->db->delete('loket', ['id' => $id]);
    return $this->db->affected_rows();
  }

  public function addLoket($data)
  {
    return $this->db->insert('loket',$data);
  }

  public function updateLoket($data, $id)
  {
    $this->db->update('loket',$data, ['id'=> $id]);
    return $this->db->affected_rows();

  }
}
 ?>
