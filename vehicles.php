<?php

include 'config.php';

include 'resources.php';

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
		$json_price=array();
		$json_year=array();
		
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
		}
	
		// print_r($json_model);
		echo '<div class="col-md-offset-3 col-md-5">';
		for ($i=0; $i<count($json_model); $i++){
			echo '
        <div class="row">
          <div class="card darken-1">
            <table>
			<tr>
			<td>
			<img src="img/car.png" width= 100px; height= 100px>
			</td>
			<td>
			<div class="card-content">
			
              <span class="card-title">'.$json_model[$i].'</span>
              <p class="model">'.$json_year[$i].'</p>
              <p id="price">$'.$json_price[$i].'</p>
			  <p id ="color">'.$json_color[$i].'</p>
			  <p id ="transmission">'.$json_transmission[$i].'| '.$json_body_type[$i].'</p>
			   </div>
			 </td>
			 <td>
			 <div class="card-content">
			
              <span class="seller-name">Srividya Majeti</span>
              <p id ="email">majetisiri@gmail.com</p>
			  <p id ="phone_number"> 757-685-2052</p>
			  <p id = "website">www.google.com</p>
			   </div></td>
			 </tr>
			 </table>
          </div>
        </div>';
		}
	}
	else{
		$loginErr = "Matches Not Found";
		echo 'im here';

	}
}

?>
