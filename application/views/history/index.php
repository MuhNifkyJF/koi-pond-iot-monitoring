<h1 class="mt-4">History</h1>
   <hr>

   <div class="card mb-4">
        <div class="card-header">
              <i class="fas fa-table me-1"></i>
                Data History 
        </div>
              <div class="card-body">
                <form method="post" action="<?= base_url('history'); ?>">
                  <table id="datatablesSimple">
                      <thead>
                               <tr>
                                 <th>No</th>
                                 <th>Tanggal</th>
                                 <th>Suhu Air</th>
                                 <th>PH Air</th>
                                 <th>Suhu lingkungan</th>
                               </tr>
                      </thead> 
                      <tbody>
                       
               <?php

$nomor = 1;
               foreach($tampil as $key) : ?>
               
                    <tr>
                     
                       <td><?= $nomor ?> </td>
                       <td><?= html_escape($key->tanggal) ?> </td>
                       <td><?= html_escape($key->suhu) ?> </td>
                       <td><?= html_escape($key->kadar_ph) ?> </td>
                       <td><?= html_escape($key->sensor_dht) ?> </td>
                    </tr>

              <?php

$nomor++;
            endforeach ?>
      
                          </tbody>
                  </table>
                  </form>
             </div>
    </div>


