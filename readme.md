RESTful API for CIKAR WEB and APPS

Antrian
- get data layanan
  - semua layanan
    - domain/layanan (method : get)
  - spesifik
    - domain/layanan?id=3 (method : get, params : id)
- delete layanan
  - domain/layanan (method : delete, params : id)
- update layanan
  - domain/layanan (method : put, params : id, kode_layanan, nama_layanan)
- create Layanan
  - domain/layanan (method : post, params : kode_layanan, nama_layanan)
