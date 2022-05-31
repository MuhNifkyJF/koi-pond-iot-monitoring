
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
                                        <h4><span id="cektanggal">5</span></h4> 
                                      </div>

                                    </div>
                                </div>
                            </div>
                        </div>

            <h3>Controlling</h3>
            <hr>

<div class="d-flex justify-content-center">
    <canvas id="myChart" style="width: 100%; height: 300px"></canvas>
</div>


<script src="https://cdnjs.com/libraries/Chart.js"></script>
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
        			borderColor: [
        				'rgba(255, 99, 132, 1)'],
        			borderWidth: 1
        		}, 
                {
        			label: 'Ph',
        			data: [],
        			borderColor: [
        				'rgba(0, 99, 132, 1)'],
        			borderWidth: 1
        		}]
        	},
        	options: {
        		scales: {
        			yAxes: [{
        				ticks: {
        					// beginAtZero: true,
                            autoSkip: true,
                            maxRotation: 0,
                            minRotation: 0
        				}
        			}],
                    xAxes: [
                    {
                        // aqui controlas la cantidad de elementos en el eje horizontal con autoSkip
                        ticks: {
                            autoSkip: true,
                            maxRotation: 0,
                            minRotation: 0
                        }
                    }
                    ]
        		},
                animation: {

                    xAxis: true,
                }
        	}
        });



        var realtimeChart = function() {

            $.ajax({

                type: "GET",
                url : "<?php echo site_url('home/realtimedata') ?>",
                dataType: "json",
                success: function( response ) {

                    myChart.data.labels.push( response.tanggal );
                    myChart.data.datasets[0].data.push( response.suhu );
                    myChart.data.datasets[1].data.push( response.kadar_ph );
                    
                    // re-render the chart
                    myChart.update();
                }
            });
        }


        setInterval( realtimeChart, 3000 );
        
    });
</script>

