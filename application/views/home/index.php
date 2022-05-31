
          <h1 class="mt-4">Dashboard</h1>
          <hr>

          <!-- ajax untuk realtime -->
          <script type="text/javascript" src="jquery/jquery.min.js"></script>

         <script type="text/javascript">

             $(document).ready(function() {

                //atur interval waktu untuk realtime
                setInterval(function(){
                   $("#ceksuhu").load("<?php echo site_url('Home/ceksuhu'); ?>");
                   $("#cekph").load("<?php echo site_url('Home/cekph'); ?>");
                   $("#cektanggal").load("<?php echo site_url('Home/cektanggal'); ?>");
                 }, 1000); //1000 = 1detik 

             }) ;

        </script>

            <div class="row d-flex justify-content-center">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body fs-2 text-center">Suhu</div>
                                    <div class="card-footer ">
                                        <div class="fs-2 text-center">
                                        <h1><span id="ceksuhu">5</span></h1> 
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body fs-2 text-center">PH</div>
                                    <div class="card-footer ">
                                       <div class="fs- text-center">
                                        <h1><span id="cekph">5</span></h1> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body fs-2 text-center">Active</div>
                                    <div class="card-footer">
                                      <div class="fs-2 text-center">
                                        <h3><span id="cektanggal">5</span></h3> 
                                      </div>

                                    </div>
                                </div>
                            </div>
                        </div>

            <h3>Controlling</h3>
            <hr>

<div class="d-flex justify-content-center">
              <button class="btn btn-primary px-5" type="submit">Heater On</button>
              <button class="btn btn-primary px-5 ms-5" type="submit">Tambah Air</button>
              <button class="btn btn-primary px-5 ms-5" type="submit">Kuras Air</button>
</div>

