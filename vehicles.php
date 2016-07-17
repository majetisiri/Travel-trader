<?php

include 'config.php';
include 'resources.php';

if (isset($_POST['search'])) {
	$listing_type = $_POST['listing_type'];
	$keyword= $_POST['keyword'];
	$min_price = substr($_POST['min_price'], 1);
	$max_price = substr($_POST['max_price'], 1);
	
	echo $min_price, $max_price, $keyword, $listing_type ;
	$sql = "select * from vehicles
				join seller
                 on seller.vehicle_id = vehicles.vehicle_id
			 where type_id in(select id from vehicle_type 
			 					where vehicle_type ='$listing_type') 
			and ( price >'$min_price')
			and (price <'$max_price')
			and (model like '%$keyword%' or make like '%$keyword%' or description like '%$keyword%' or fuel_type like '%$keyword%' or color like '%$keyword%' or transmission like '%$keyword%' or body_type like '%$keyword%');";
		
	// echo $sql;
	// echo 'im here';
	$result = $conn->query($sql);

		$json_model=array();
		$json_make=array();
		$json_description=array();
		$json_fuel_type=array();
		$json_color=array();
		$json_transmission=array();	
		$json_body_type=array();
		$json_price=array();
		$json_year=array();
		$json_vehicle_id=array();

		$json_seller_type=array();
		$json_name=array();
		$json_address=array();
		$json_phone_number=array();
		$json_email=array();
		$json_website=array();
		
	// print_r($result);
	if ($result->num_rows > 0) {
		// echo $result;
		while($row= $result->fetch_assoc()){
			array_push($json_model,$row['model']);
			array_push($json_make,$row['make']);
			array_push($json_description,$row['description']);
			array_push($json_fuel_type,$row['fuel_type']);
			array_push($json_color,$row['color']);
			array_push($json_transmission,$row['transmission']);
			array_push($json_body_type,$row['body_type']);
			array_push($json_price,$row['price']);
			array_push($json_year,$row['year']);
			array_push($json_vehicle_id,$row['vehicle_id']);


			array_push($json_seller_type,$row['seller_type']);
			array_push($json_name,$row['name']);
			array_push($json_address,$row['address']);
			array_push($json_phone_number,$row['phone_number']);
			array_push($json_email,$row['email']);
			array_push($json_website,$row['website']);
		}
	
		// print_r($json_model);
		echo '<div class="col-md-offset-3 col-md-5">';
		for ($i=0; $i<count($json_vehicle_id); $i++){
			echo '
        <div class="row listing_item" id="'.$json_vehicle_id[$i].'"><a href="vehicles.php?vehicle_id='.urlencode($json_vehicle_id[$i]).'">
          <div class="card darken-1">
            <table>
				<tr>
					<td>
						<img src="img/car.png" width= 100px; height= 100px>
					</td>
					<td>
						<div class="card-content">
			              <span class="card-title">'.$json_make[$i].' '.$json_model[$i].'</span>
			              <p class="model">'.$json_year[$i].'</p>
			              <p id="price">$'.$json_price[$i].'</p>
						  <p id ="color">'.$json_color[$i].'</p>
						  <p id ="transmission">'.$json_transmission[$i].'| '.$json_body_type[$i].'</p>
						</div>
					</td>
					<td>
						<div class="card-content">
			              <span class="seller-name">'.$json_name[$i].'</span>
			              <p id ="email">'.$json_email[$i].'</p>
						  <p id ="phone_number"> '.$json_phone_number[$i].'</p>
						  <p id = "website">'.$json_website[$i].'</p>
						</div>
					</td>
				 </tr>
			 </table>
          </div>
        </div>';
		}
	}
	else{
		$loginErr = "Matches Not Found";
		header('Location:index.php');
		echo '<p>Matches Not Found</p>';
	}
}
	
}
?>
