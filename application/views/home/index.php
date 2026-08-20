
          <h1 class="mt-4">Dashboard</h1>
          <hr>

          <!-- ajax untuk realtime -->
          <script type="text/javascript" src="<?= base_url('jquery/jquery.min.js'); ?>"></script>

         <script type="text/javascript">

             $(document).ready(function() {

                //atur interval waktu untuk realtime
                setInterval(function(){
                   $("#ceksuhu").load("<?php echo site_url('Home/ceksuhu'); ?>");
                   $("#cekph").load("<?php echo site_url('Home/cekph'); ?>");
                   $("#cekdht").load("<?php echo site_url('Home/cekdht'); ?>");
                   $("#cektanggal").load("<?php echo site_url('Home/cektanggal'); ?>");
                 }, 2000); //2000 = 2 detik

             }) ;

        </script>

            <div class="row d-flex justify-content-center">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body fs-2 text-center">Suhu Air</div>
                                    <div class="card-footer ">
                                        <div class="fs-2 text-center">
                                        <h1><span id="ceksuhu">--</span></h1>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body fs-2 text-center">PH</div>
                                    <div class="card-footer ">
                                       <div class="fs- text-center">
                                        <h1><span id="cekph">--</span></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body fs-2 text-center">Suhu DHT</div>
                                    <div class="card-footer ">
                                       <div class="fs- text-center">
                                        <h1><span id="cekdht">--</span></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body fs-2 text-center">Waktu Data</div>
                                    <div class="card-footer">
                                      <div class="fs-2 text-center">
                                        <h4><span id="cektanggal">--</span></h4>
                                      </div>

                                    </div>
                                </div>
                            </div>
                        </div>

            <h3>Grafik Sensor</h3>
            <hr>

<div class="d-flex justify-content-center">
    <canvas id="myChart" style="width: 100%; height: 300px"></canvas>
</div>


<script>

    $(function() {

        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Suhu',
                    data: [],
                    borderColor: ['rgba(255, 99, 132, 1)'],
                    borderWidth: 1
                }, {
                    label: 'Ph',
                    data: [],
                    borderColor: ['rgba(0, 99, 132, 1)'],
                    borderWidth: 1
                }, {
                    label: 'DHT',
                    data: [],
                    borderColor: ['rgba(0, 255, 132, 1)'],
                    borderWidth: 1
                }]
            },
        	options: {
        		scales: {
        			yAxes: [{
        				ticks: {
        					// beginAtZero: true,
                            maxTicksLimit: 8,
                            autoSkip: true,
                            maxRotation: 0,
                            minRotation: 4
        				}
        			}],
                    xAxes: [
                    {
                        // mengontrol jumlah item dengan autoSkip
                        ticks: {
                            maxTicksLimit: 8,
                            autoSkip: true,
                            maxRotation: 0,
                            minRotation: 4
                        }
                    }
                    ]
        		},
                animation: {

                    xAxis: true,
                }
        	}
        });



		var lastRecordId = null;
		var realtimeChart = function() {

            $.ajax({

                type: "GET",
                url : "<?php echo site_url('home/realtimedata') ?>",
                dataType: "json",
                success: function( response ) {
					if (!response.id_tampilan || response.id_tampilan === lastRecordId) {
						return;
					}
					lastRecordId = response.id_tampilan;

                    myChart.data.labels.push( response.tanggal );
                    myChart.data.datasets[0].data.push( response.suhu );
                    myChart.data.datasets[1].data.push( response.kadar_ph );
                    myChart.data.datasets[2].data.push( response.sensor_dht );

					if (myChart.data.labels.length > 30) {
						myChart.data.labels.shift();
						myChart.data.datasets.forEach(function(dataset) {
							dataset.data.shift();
						});
					}
                    
                    // re-render the chart
                    myChart.update();
                }
            });
        }


        setInterval( realtimeChart, 3000 );
        
    });
</script>

