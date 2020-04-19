<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

/**
 *
 */
class Loket extends REST_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Loket_model');
  }

  public function index_get()
  {
    $id = $this->get('id');
    if ($id === null) {
      $loket = $this->Loket_model->getLoket();
    } else {
      $loket = $this->Loket_model->getLoket($id);
    }
    if ($loket) {
      $this->response([
          'status' => True,
          'Data' => $loket
      ], REST_Controller::HTTP_OK);
    } else {
      $this->response([
          'status' => FALSE,
          'message' => 'ID tidak ditemukan'
      ], REST_Controller::HTTP_NOT_FOUND);
    }
  }

  public function index_delete()
  {
    $id = $this->delete('id');

    if ($id === NULL) {
        $this->response([
            'status' => FALSE,
            'message' => 'Isi ID'
        ], REST_Controller::HTTP_BAD_REQUEST);
    } else {
      if ($this->Loket_model->deleteLoket($id) >= 0) {
          $this->response([
              'status' => TRUE,
              'message' => 'Loket Terhapus'
          ], REST_Controller::HTTP_NO_CONTENT);
      } else {
        $this->response([
            'status' => FALSE,
            'message' => 'ID tidak ditemukan'
        ], REST_Controller::HTTP_NOT_FOUND);
      }
    }
  }

  public function index_post()
  {
    $data = [
        'nama_loket' => $this->post('nama_loket')
    ];
    var_dump($data);
    if ($this->Loket_model->addLoket($data) > 0) {
      $this->response([
          'status' => TRUE,
          'message' => 'Loket Ditambahkan'
      ], REST_Controller::HTTP_CREATED);
    } else {
      $this->response([
          'status' => FALSE,
          'message' => 'Gagal menambahkan Loket'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
  }


  public function index_put()
  {
    $id = $this->put('id');
    $data = [
        'nama_loket' => $this->put('nama_loket')
    ];
    $respon = $this->Loket_model->updateLoket($data, $id);
    if ($respon > 0) {
      $this->response([
          'status' => TRUE,
          'message' => 'Loket Diupdate'
      ], REST_Controller::HTTP_OK);
    } else {
      $this->response([
          'status' => FALSE,
          'message' => 'Gagal mengupdate Loket'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
  }
}

 ?>
