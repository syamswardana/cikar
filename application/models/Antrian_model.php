<?php
/**
 *
 */
class Antrian_model extends CI_Model
{

  function __construct()
  {
    // code...
  }
  public function requestAntrian($id_layanan)
  {
    //get kode_layanan layanan
    $this->db->select('kode_layanan');
    $this->db->where('id',$id_layanan);
    $kodeLayanan = $this->db->get('layanan')->row()->kode_layanan;
    // var_dump($dataLayanan);

    $date = new DateTime("now");
    $curr_date = $date->format('Y-m-d ');

    //get nomer antrian terbesar
    $this->db->select_max('nomor_antrian');
    $this->db->where('id_layanan', $id_layanan);
    $this->db->where('DATE(waktu)',$curr_date);//use date function
    $nomorTerbesar = $this->db->get('antrian')->row()->nomor_antrian;
    if ($nomorTerbesar === NULL) {
      $nomorTerbesar = 0;
    }
    $nomorAntrian = $nomorTerbesar+=1;

    //update sisa
    $this->db->set('sisa','sisa+1',false);
    $this->db->where('id',$id_layanan);
    $this->db->update('layanan');

    //add Antrian
    $data = array(
      'id_layanan' => $id_layanan,
      'nomor_antrian' => $nomorAntrian
    );
    $this->db->insert('antrian', $data);

    $data = array(
      'kode_layanan' => $kodeLayanan,
      'nomor_antrian' =>$nomorAntrian
    );
    return $data;
  }

  public function riwayat()
  {
    $this->db->select('antrian.id, id_layanan, kode_layanan, nomor_antrian, nama_loket, waktu');
    $this->db->where('id_loket !=',NULL, False);
    $this->db->from('antrian');
    $this->db->join('loket','loket.id = antrian.id_loket');
    $this->db->join('layanan','layanan.id = antrian.id_layanan');
    return $this->db->get();
  }

  public function call($id_loket, $id_layanan)
  {
    //get kode_layanan layanan
    $this->db->select('kode_layanan');
    $this->db->where('id',$id_layanan);
    $kodeLayanan = $this->db->get('layanan')->row()->kode_layanan;

    //update sisa dan terlayani
    $this->db->set('sisa','sisa-1',false);
    $this->db->set('terlayani','terlayani+1',false);
    $this->db->where('id',$id_layanan);
    $this->db->update('layanan');

    //update sisa dan terlayani
    $this->db->set('id_loket',$id_loket);
    $this->db->where('id',$id_layanan);
    $this->db->update('layanan');

    $date = new DateTime("now");
    $curr_date = $date->format('Y-m-d ');

    //get nomer antrian terbesar
    $this->db->select_min('nomor_antrian');
    $this->db->select('id');
    $this->db->where('id_layanan', $id_layanan);
    $this->db->where('DATE(waktu)',$curr_date);//use date function
    $row = $this->db->get('antrian')->row();
    $nomorTerkecil = $row->nomor_antrian;
    $id = $row->id;
    if ($nomorTerkecil === NULL) {
      return 0;
    }

    $this->db->set('id_loket', $id_loket);
    $this->db->where('id', $id);
    $this->db->update('antrian');
    return $this->db->affected_rows();
  }
}

 ?>
