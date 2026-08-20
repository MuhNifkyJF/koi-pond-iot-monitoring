<?php
   //cetak isi field suhu yang dikirm dari controller
   if (!$data_sensor) {
      echo '--';
      return;
   }

   $tanggal_ke_string = strtotime($data_sensor->tanggal);

   $tanggalconvert = date('d-m-Y H.i', $tanggal_ke_string);
   echo $tanggalconvert ;
   ?>
