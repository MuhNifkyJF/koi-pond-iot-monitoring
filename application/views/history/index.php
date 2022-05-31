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
                               </tr>
                      </thead> 
                      <tbody>
                       
               <?php foreach($tampil as $key) :  $no = 1; ?> 
               
                    <tr>
                     
                       <td><?= $no++ ?></td>
                       <td><?= $key->tanggal ?> </td>
                       <td><?= $key->suhu ?> </td>
                       <td><?= $key->kadar_ph ?> </td>
                    </tr>

              <?php endforeach ?>
      
                          </tbody>
                  </table>
                  </form>
             </div>
    </div>


