<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

/**
 *
 */
class Layanan extends REST_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Layanan_model');
  }

  public function index_get()
  {
    $id = $this->get('id');
    if ($id === null) {
      $layanan = $this->Layanan_model->getLayanan();
    } else {
      $layanan = $this->Layanan_model->getLayanan($id);
    }


    if ($layanan) {
      $this->response([
          'status' => True,
          'Data' => $layanan
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
      if ($this->Layanan_model->deleteLayanan($id) >= 0) {
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

  public function index_post()
  {
    $data = [
        'kode_layanan' => $this->post('kode_layanan'),
        'nama_layanan' => $this->post('nama_layanan')
    ];

    if ($this->Layanan_model->addLayanan($data) > 0) {
      $this->response([
          'status' => TRUE,
          'message' => 'Layanan Ditambahkan'
      ], REST_Controller::HTTP_CREATED);
    } else {
      $this->response([
          'status' => FALSE,
          'message' => 'Gagal menambahkan layanan'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
  }


  public function index_put()
  {
    $id = $this->put('id');
    $data = [
        'kode_layanan' => $this->put('kode_layanan'),
        'nama_layanan' => $this->put('nama_layanan')
    ];

    if ($this->Layanan_model->updateLayanan($data, $id) > 0) {
      $this->response([
          'status' => TRUE,
          'message' => 'Layanan Diupdate'
      ], REST_Controller::HTTP_NO_CONTENT);
    } else {
      $this->response([
          'status' => FALSE,
          'message' => 'Gagal mengupdate layanan'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
  }
}

 ?>
