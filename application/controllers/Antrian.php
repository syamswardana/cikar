<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
/**
 *
 */
class Antrian extends REST_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Antrian_model');
  }
  public function request_get()
  {
    $ktp = $this->get('ktp');
    $nomer_hp = $this->get('nomer_hp');
    $id_layanan = $this->get('id_layanan');
    if ($id_layanan === null) {
      $this->response([
          'status' => True,
          'message' => 'parameter kurang'
      ], REST_Controller::HTTP_BAD_REQUEST);
    } else {
      if ($ktp === null && $nomer_hp === null) {
        $data = $this->Antrian_model->requestAntrian($id_layanan);
        if ($data > 0) {
          $this->response([
            'status' => True,
            'Data' => $data
          ], REST_Controller::HTTP_OK);
        } else {
          $this->response([
            'status' => False,
            'message' => 'Data tidak ada'
          ], REST_Controller::HTTP_NOT_FOUND);
        }
      } else {
        $data = $this->Antrian_model->requestAntrian($id_layanan, $ktp, $nomer_hp);
        if ($data > 0) {
          $this->response([
            'status' => True,
            'Data' => $data
          ], REST_Controller::HTTP_OK);
        } else {
          $this->response([
            'status' => True,
            'message' => 'Data tidak ada'
          ], REST_Controller::HTTP_NOT_FOUND);
        }
      }
    }
  }

  public function riwayat_get()
  {
    $riwayat = $this->Antrian_model->riwayat();
    if ($riwayat->num_rows() > 0) {
      $this->response([
        'status' => True,
        'Data' => $riwayat->result_array()
      ], REST_Controller::HTTP_OK);
    } else {
      $this->response([
        'status' => FALSE,
        'Message' => 'Data Kosong'
      ], REST_Controller::HTTP_NOT_FOUND);
    }
  }

  public function call_put()
  {
    $id_loket = $this->put('id_loket');
    $id_layanan = $this->put('id_layanan');
    if ($id_loket === NULL || $id_layanan === NULL) {
      $this->response([
          'status' => FALSE,
          'message' => 'parameter kurang'
      ], REST_Controller::HTTP_BAD_REQUEST);
    } else {
      if ($this->Antrian_model->call($id_loket, $id_layanan) > 0) {
        $this->response([
          'status' => True,
          'message' => 'berhasil'
        ], REST_Controller::HTTP_OK);
      } else {
        $this->response([
          'status' => FALSE,
          'message' => 'fail'
        ], REST_Controller::HTTP_BAD_REQUEST);
      }
    }
  }
}

 ?>
