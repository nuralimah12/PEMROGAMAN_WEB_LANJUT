<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KTP EL</title>
    <style>
          body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

.ktp {
  width: 800px;
  margin: 20px auto;
  border-radius: 5px;
  padding: 20px;
  background-image: url('https://lh5.googleusercontent.com/-W4FM3TIV9I0/TYQzLeULsNI/AAAAAAAAAIo/4HwHZD_bgzQ/s1600/KTP+2.jpg');
  background-size: cover;
  background-repeat: no-repeat;
  display: flex;
  justify-content: center; /* center horizontally */
  align-items: center; /* center vertically */
}

table {
  width: 100%;
  /* border: solid 2px red; */
}
td {
  /* border: solid 2px blue; */
  
}

.header {
  text-align: center;
}

.header img {
  width: 100px;
  height: 100px;
}

.label {
  font-weight: bold;
}

.footer {
  text-align: center;
}

.note {
  font-style: italic;
}
    </style>
</head>
<body>
  <div class="ktp">
    <table >
      <tr>
        <td colspan="3" class="header">
          <h1>PROVINSI JAWA TIMUR</h1>
          <h1>KABUPATEN TULUNGAGUNG</h1>
        </td>
      </tr>
      <tr>
        <td class="label">NIK</td>
        <td class="value">3504166xxxxxxxxxx</td>
        <td rowspan="14" style="text-align: center;">
          <img width="210" height="280" src="images/ima.jpg" alt=""><br>
          <span>TULUNGAGUNG</span><br>
          <span>06-02-2019</span><br>
          <img width="100" src="images/ttd.png" alt="">
        </td>
      </tr>
      <tr>
        <td class="label">Nama</td>
        <td class="value">Nur Alimah</td>
      </tr>
      <tr>
        <td class="label">Tempat/Tanggal Lahir</td>
        <td class="value">Tulungagung, 20-01-2002</td>
      </tr>
      <tr>
        <td class="label">Jenis Kelamin</td> 
        <td class="value">Laki-laki</td>
      </tr>
      <tr>
        <td class="label">Alamat</td>
        <td class="value">DSN CAMPURJANGGRANG</td>
      </tr>
      <tr>
        <td class="label">&nbsp;&nbsp;&nbsp;&nbsp;RT/RW</td>
        <td class="value">001/013</td>
      </tr>
      <tr>
        <td class="label">&nbsp;&nbsp;&nbsp;&nbsp;Kel/Desa</td>
        <td class="value">CAMPURDARAT</td>
      </tr>
      <tr>
        <td class="label">&nbsp;&nbsp;&nbsp;&nbsp;Kecamatan</td>
        <td class="value">CAMPURDARAT</td>
      </tr>
      <tr>
        <td class="label">Agama</td>
        <td class="value">Islam</td>
      </tr>
      <tr>
        <td class="label">Status Perkawinan</td>
        <td class="value">Belum Kawin</td>
      </tr>
      <tr>
        <td class="label">Pekerjaan</td>
        <td class="value">PELAJAR/MAHASISWA</td>
      </tr>
      <tr>
        <td class="label">Kewarganegaraan</td>
        <td class="value">WNI</td>
      </tr>
      <tr>
        <td class="label">Berlaku Hingga</td>
        <td class="value">SEUMUR HIDUP</td>
      </tr>
      
    </table>
    <br>
  </div>
</body>
</html>
