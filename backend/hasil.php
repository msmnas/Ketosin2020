<?php
	include "sidebar.php";
?>
<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-md-12 my-container">
				<h4>Ketosin 2019 / Hasil</h4>
				<hr class="hr">
				<br><br>

				<div id="containerz" style="min-width: 510px; height: 500px; max-width: 600px; margin: 0 auto"></div>
			</div>
		</div>
	</section>
</section>
	
<?php
	
?>
  	<script>
    $(document).ready(function () {
        $.get('chart.php', function(data) {
        	loadChart(data);
        }, 'json');
        
        function loadChart(datas) {
        	$('#containerz').highcharts({
	            chart: {
	                plotBackgroundColor: null,
	                plotBorderWidth: null,
	                plotShadow: false,
	                type: 'pie'
	            },
	            title: {
	                text: 'Hasil Voting Pemilihan Ketos 2019'
	            },
	            tooltip: {
	                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
	            },
	            plotOptions: {
	                pie: {
	                    allowPointSelect: true,
	                    cursor: 'pointer',
	                    dataLabels: {
	                        enabled: false
	                    },
	                    showInLegend: true
	                }
	            },
	            series: [{
	                name: 'Poin',
	                colorByPoint: true,
	                data: datas
	            }]
	        });
        }
    });
  	</script>