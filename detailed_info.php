<?php
if(isset($_GET['vehicle_id'])){
	$vehicle_id = $_GET['vehicle_id'];
	$sql= "select * from vehicles
			join seller
            on seller.vehicle_id = vehicles.vehicle_id
			join listing_images
			on listing_images.vehicle_id = seller.vehicle_id
			where listing_images.vehicle_id = '$vehicle_id'" ;
	$result =$conn->query($sql);
	if($result ->num_rows>0){
		
	} 
	
}
?>

<html>
<body>
	<p>helo</p>
</body>
</html>