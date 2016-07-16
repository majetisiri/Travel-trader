<?php

include 'config.php';

if (isset($_POST['search'])) {
	$listing_type = $_POST['listing_type'];
	$keyword= $_POST['keyword'];
	$min_price = substr($_POST['min_price'], 1);
	$max_price = substr($_POST['max_price'], 1);
	
	// echo $min_price, $max_price, $keyword, $listing_type ;
	$sql = "select * from vehicles
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
		}
	
		for ($i=0; $i<count($json_model); $i++){
			// $sql="SELECT request_status FROM Requests WHERE to_id='$uid' AND from_id='$json_id[$i]'";
			// $result =$conn->query($sql);
			// if($result->num_rows>0){
			// 	//print_r($result);
			// 	if (($result->fetch_assoc()['request_status']) === '1'){
			// 		//echo "im in pending";
					echo $json_model[$i];
				// }
				// else if (($result->fetch_assoc()['request_status']) === '2'){
				// 	//echo "im in accepted";
				// 	echo '<div style="font-size:25px" class="col-md-5 col-md-offset-3" >'.$json_username[$i].
				// 			'</br><p> You are now friends</p>
				// 		</div></br>';	
				// }
			// }
		}
		
		print_r($json_model);
		
	}
	else{
		$loginErr = "Matches Not Found";
		echo 'im here';

	}
}

?>
