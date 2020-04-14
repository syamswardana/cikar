<?php
/**
 *
 */
class Users_model extends CI_Model
{

  function __construct()
  {
    // code...
  }

  public function getAuth($username, $password)
  {
    $this->db->select('users.id, users.username, users.nama, users.level as id_level, levels.level as level');
    $this->db->from('users');
    $this->db->where('username',$username);
    $this->db->where('password',$password);
    $this->db->join('levels', 'levels.id = users.level');
    $user = $this->db->get();
    return $user;
  }

  public function getUsers($level = null, $id = null)
  {
    if ($level!=null && $id===null) {
      return $this->db->get_where('users',['level'=>$level]);
    } else if($id != null) {
      return $this->db->get_where('users',['id'=>$id]);
    }
  }

  public function deleteUser($id)
  {
    $this->db->delete('users', ['id' => $id]);
    return $this->db->affected_rows();
  }

  public function addUser($data)
  {
    return $this->db->insert('users',$data);
  }

  public function updateUser($data, $id)
  {
    $this->db->update('users',$data, ['id'=> $id]);
    // if ($this->db->affected_rows() > 0) {
    //   return 1;
    // } else {
    //   if ($this->db->_error_number()==1062) {
    //     return -1;
    //   } else {
    //     return 0;
    //   }
    // }
    return $this->db->affected_rows();

  }
}

 ?>
