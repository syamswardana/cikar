RESTful API for CIKAR WEB and APPS

CRUD Layanan
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

Login
- domain/cikar/users/auth (method : post, params : username,password)

CRUD Users FO
- read
  - Semua users fo
    - domain/users/fo (method : get)
  - spesifik
    - domain/users/fo?id=2 (method : get, params : id)
- delete
  - domain/users/fo (method : delete, params : delete)
- update
  - domain/users/fo (method : put, params : id, username, password, nama)
- create
  - domain/users/fo (method : post, params : username, password, nama)
CRUD Loket
- get data loket
  - semua loket
    - domain/loket (method : get)
  - spesifik
      - domain/loket?id=3 (method : get, params : id)
- delete loket
  - domain/loket (method : delete, params : id)
- update loket
  - domain/loket (method : put, params : id, nama_loket)
- create Loket
  - domain/loket (method : post, params : nama_loket)
Antrian
- request nomor antrian
  - domain/antrian/request (method : get, params : id_layanan)
- riwayat antrian
  - domain/antrian/riwayat (method : get)
- call
  -domain/antrian/call (method : put, params : id_loket, id_layanan);
