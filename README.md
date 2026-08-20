# Koi Pond IoT Monitoring

Dashboard web untuk mencatat dan menampilkan kondisi kolam koi. Project ini berfokus pada sisi software monitoring: penerimaan data sensor, penyimpanan MySQL, pembaruan dashboard dengan AJAX, grafik, dan riwayat pembacaan.

## Fitur

- Login administrator
- Monitoring suhu air, pH air, dan suhu lingkungan
- Timestamp pada setiap pembacaan
- Dashboard yang diperbarui secara berkala dengan AJAX
- Grafik pembacaan sensor
- Riwayat data dalam bentuk tabel
- Endpoint input untuk perangkat sensor

## Teknologi

- PHP dan CodeIgniter 3
- MySQL/MariaDB
- Bootstrap
- jQuery dan AJAX
- Chart.js

## Alur Data

```text
Sensor / data source
        │
        │ GET /Home/kirimdata/{suhu}/{ph}/{suhu_dht}
        ▼
Controller Home
        │ validasi nilai + timestamp server
        ▼
Model M_Home
        │
        ▼
MySQL (tb_tampilan)
        │
        ├── AJAX /Home/ceksuhu
        ├── AJAX /Home/cekph
        ├── AJAX /Home/cekdht
        ├── AJAX /Home/cektanggal
        └── AJAX /Home/realtimedata
                    │
                    ▼
             Dashboard dan grafik
```

Nilai pada kartu dashboard diperbarui setiap dua detik. Grafik meminta data terbaru setiap tiga detik dan menyimpan maksimal 30 titik di browser.

## Screenshots

Simpan screenshot aplikasi di folder `assets/screenshots/` dengan nama file berikut agar tampil otomatis di GitHub.

### Login

![Login page](assets/screenshots/login.png)

### Dashboard Monitoring

![Dashboard monitoring](assets/screenshots/dashboard.png)

### Grafik Sensor

![Sensor chart](assets/screenshots/sensor-chart.png)

### History Data

![History data](assets/screenshots/history.png)

### Input Sensor

![Sensor endpoint response](assets/screenshots/sensor-endpoint.png)

### Sample Database

![Sample database](assets/screenshots/database-sample.png)

## Instalasi

1. Letakkan project di document root Apache, misalnya `htdocs/koi-pond-iot-monitoring`.
2. Buat database MySQL bernama `ikan_koi`.
3. Import [`database/sample_schema.sql`](database/sample_schema.sql).
4. Atur environment variable pada Apache atau sistem operasi:

   ```apache
   SetEnv CI_ENV development
   SetEnv APP_BASE_URL http://localhost/koi-pond-iot-monitoring
   SetEnv APP_ENCRYPTION_KEY ganti-dengan-nilai-acak
   SetEnv APP_COOKIE_SECURE false
   SetEnv DB_HOST localhost
   SetEnv DB_USERNAME root
   SetEnv DB_PASSWORD ""
   SetEnv DB_DATABASE ikan_koi
   SetEnv SENSOR_API_KEY kunci-sensor-lokal
   ```

5. Buka `http://localhost/koi-pond-iot-monitoring/`.

File `.env.example` hanya berfungsi sebagai referensi dan tidak dibaca otomatis oleh CodeIgniter.

## Akun Demo

| Username | Password |
|---|---|
| `admin_koi` | `KoiDemo!2026` |

Akun tersebut hanya terdapat pada sample database.

## Format Input Sensor

Endpoint yang digunakan saat ini:

```http
GET /Home/kirimdata/{suhu_air}/{kadar_ph}/{suhu_lingkungan}
```

Contoh:

```bash
curl -H "X-Sensor-Key: kunci-sensor-lokal" \
  "http://localhost/koi-pond-iot-monitoring/index.php/Home/kirimdata/26.5/7.1/28.4"
```

API key juga dapat dikirim melalui query string `?key=...`, tetapi header `X-Sensor-Key` lebih aman karena tidak muncul pada URL.

| Posisi | Field | Format | Rentang valid |
|---|---|---|---|
| 1 | Suhu air | Angka desimal, °C | -10 sampai 60 |
| 2 | Kadar pH | Angka desimal | 0 sampai 14 |
| 3 | Suhu lingkungan/DHT | Angka desimal, °C | -40 sampai 100 |

Timestamp dibuat oleh server dengan format `YYYY-MM-DD HH:MM:SS`. Request yang valid menghasilkan respons JSON dan HTTP status `201`.

## Keamanan Endpoint

Jika `SENSOR_API_KEY` diisi pada server, setiap request sensor wajib membawa key yang sama. Jika variabel tersebut kosong, endpoint tetap menerima data tanpa autentikasi agar kompatibel dengan perangkat lama.

Keterbatasan yang masih ada:

- endpoint masih menggunakan GET karena mengikuti format perangkat yang ada;
- nilai sensor ikut tercatat pada URL dan access log;
- belum ada identitas per perangkat, rate limiting, dan perlindungan replay;
- dashboard menggunakan polling AJAX, bukan MQTT atau WebSocket.

Untuk demo internet, aktifkan HTTPS, isi `SENSOR_API_KEY`, gunakan `CI_ENV=production`, dan ganti password akun demo.

## Status

Prototype software monitoring untuk portfolio. Integrasi perangkat fisik bergantung pada sensor dan jaringan yang digunakan; repository ini tidak dimaksudkan sebagai implementasi hardware IoT lengkap.
