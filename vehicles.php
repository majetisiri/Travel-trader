<?php

include 'config.php';
include 'resources.php';
include 'header.php';

if (isset($_POST['search'])) {
	$listing_type = $_POST['listing_type'];
	$keyword= $_POST['keyword'];
	$min_price = substr($_POST['min_price'], 1);
	$max_price = substr($_POST['max_price'], 1);
	
	$sql = "select * from vehicles
				join seller
                 on seller.vehicle_id = vehicles.vehicle_id
			 where type_id in(select id from vehicle_type 
			 					where vehicle_type ='$listing_type') 
			and ( price >'$min_price')
			and (price <'$max_price')
			and (model like '%$keyword%' or make like '%$keyword%' or description like '%$keyword%' or fuel_type like '%$keyword%' or color like '%$keyword%' or transmission like '%$keyword%' or body_type like '%$keyword%');";
		
	$result = $conn->query($sql);

	//print_r($result->fetch_assoc());
		
	if ($result->num_rows > 0) {
		echo '<div class="container" style="margin-top:50px;">';	

		while($row= $result->fetch_assoc()) {
		echo '
			<div style="margin-bottom:30px; cursor:pointer;" class="col-xs-4 col-sm-2 col-md-2 car-box post" id="'.$row["vehicle_id"].'"><a href="vehicles.php?vehicle_id='.urlencode($row["vehicle_id"]).'">
    			<div style="box-shadow: 1px 1px 1px #888888;" class="thumbnail">
      				<div class="caption">
            			 <h4>'.$row["model"].'</h4><hr>
      				</div>
      				<img width="150" style="margin-bottom:40px;" src="img/car.png"> 
        			<div class="row car-info" style="margin-bottom:8px;">
        				<div class="car-details">
        					<div class="col-md-4 text-center">
        						<b>MAKE</b></br>'.$row["make"].'
        					</div>
        					<div class="col-md-4 pull-right text-center">
        						<b>YEAR</b></br>'.$row["year"].'
        					</div>
        				</div>
        				<div class="details-button col-md-12">
        					<button style="width:100%;" class="btn btn-warning">
        						<i class="fa fa-info-circle" aria-hidden="true"></i>
								GET DETAILS
							</button>
        				</div>
        			</div>
          		</div></a>
          	</div>';
		}
		echo '</div>';
	}

	else{
		$loginErr = "Matches Not Found";
		header('Location:index.php');
		echo '<p>Matches Not Found</p>';
	}
}

if(isset($_GET['vehicle_id'])){
	$vehicle_id = $_GET['vehicle_id'];
	$sql= "select * from vehicles
			join seller
            on seller.vehicle_id = vehicles.vehicle_id
			where seller.vehicle_id = '$vehicle_id'" ;
	$result =$conn->query($sql);
	if($result ->num_rows>0){
		while($row= $result->fetch_assoc()) {
			print_r($row);
		}
	} 
	
}
	
?>

<script>
	$(document).ready(function() {
		$('.details-button').hide();
		$('.car-box').hover(function(){
			$(this).find('.car-details').hide();
			$(this).find('.details-button').show();
		}, function(){
			$(this).find('.car-details').show();
			$(this).find('.details-button').hide();
		});
	});
</script>