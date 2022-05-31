<?php
   //cetak isi field suhu yang dikirm dari controller
   $tanggal_ke_string = strtotime( $data_sensor->tanggal );

   $tanggalconvert = date('d-m-Y H.i', $tanggal_ke_string);
   echo $tanggalconvert ;
   ?>