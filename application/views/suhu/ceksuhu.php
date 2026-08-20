<?php
   //cetak isi field suhu yang dikirm dari controller
   echo $data_sensor ? html_escape($data_sensor->suhu) : '--';
   ?>
