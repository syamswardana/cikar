<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

/**
*
*/
class Users extends REST_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Users_model');
  }

  public function auth_post()
  {
    $username = $this->post('username');
    $password = $this->post('password');

    $user = $this->Users_model->getAuth($username, $password);

    if ($user->num_rows()>0) {
      $this->response([
        'status' => True,
        'Data' => $user->result()
      ], REST_Controller::HTTP_OK);
    } else {
      $this->response([
        'status' => False,
        'message' => 'Gagal login'
      ], REST_Controller::HTTP_NOT_FOUND);
    }
  }
  public function fo_get()
  {
    $level = 2;
    $id = $this->get('id');
    if ($id === null) {
      $data = $this->Users_model->getUsers($level, NULL);
      if ($data->num_rows()>0) {
        $this->response([
          'status' => TRUE,
          'data' => $data->result_array()
        ], REST_Controller::HTTP_OK);
      } else {
        $this->response([
          'status' => FALSE,
          'message' => 'Data tidak ditemukan'
        ], REST_Controller::HTTP_NOT_FOUND);
      }
    } else {
      $data = $this->Users_model->getUsers(NULL, $id);
      if ($data->num_rows()>0) {
        $this->response([
          'status' => TRUE,
          'data' => $data->result_array()
        ], REST_Controller::HTTP_OK);
      } else {
        $this->response([
          'status' => FALSE,
          'message' => 'Data tidak ditemukan'
        ], REST_Controller::HTTP_NOT_FOUND);
      }
    }
  }

  public function fo_delete()
  {
    $id = $this->delete('id');

    if ($id === NULL) {
      $this->response([
        'status' => FALSE,
        'message' => 'Isi ID'
      ], REST_Controller::HTTP_BAD_REQUEST);
    } else {
      if ($this->Users_model->deleteUser($id) > 0) {
        $this->response([
          'status' => TRUE,
          'message' => 'Layanan Terhapus'
        ], REST_Controller::HTTP_NO_CONTENT);
      } else {
        $this->response([
          'status' => FALSE,
          'message' => 'ID tidak ditemukan'
        ], REST_Controller::HTTP_NOT_FOUND);
      }
    }
  }

  public function fo_post()
  {
    $data = [
      'username' => $this->post('username'),
      'password' => $this->post('password'),
      'nama' => $this->post('nama'),
      'level' => 2
    ];
    if ($this->Users_model->addUser($data) > 0) {
      $this->response([
        'status' => TRUE,
        'message' => 'User Ditambahkan'
      ], REST_Controller::HTTP_CREATED);
    } else {
      $this->response([
        'status' => FALSE,
        'message' => 'Gagal menambahkan user'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
  }

  public function fo_put()
  {
    $id = $this->put('id');
    $data = [
      'username' => $this->put('username'),
      'password' => $this->put('password'),
      'nama' => $this->put('nama')
    ];
      $respon = $this->Users_model->updateUser($data,$id);
    if ($respon > 0) {
      $this->response([
        'status' => TRUE,
        'message' => 'User Diupdate'
      ], REST_Controller::HTTP_OK);
    } elseif ($respon == -1) {
      $this->response([
        'status' => FALSE,
        'message' => 'username tidak boleh sama'
      ], REST_Controller::HTTP_BAD_REQUEST);
    } else {
      $this->response([
        'status' => FALSE,
        'message' => 'Gagal mengupdate user'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
  }
}

?>
