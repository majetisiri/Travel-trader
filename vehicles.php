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
			// print_r($row);
			echo '<div class="row listing">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
	<h4 style="text-align:center">'.$row['year'].$row['make'].$row['model'].'<h4>
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="img/car.png" alt="Chania" width="460" height="345">
      </div>

      <div class="item">
        <img src="img/motorCycle.png" alt="Chania" width="460" height="345">
      </div>
    
      <div class="item">
        <img src="img/bg.jpeg" alt="Flower" width="460" height="345">
      </div>

      <div class="item">
        <img src="img/truck.png" alt="Flower" width="460" height="345">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
<div class="row" id="features">
<h2  class="text-center" style="font-size:30px;"> <span style="font-weight:800">CAR</span> FEATURES </h2></br>
	<div class="col-md-offset-4" style ="float:left">
	<p>'.$row['make'].'</p></br>
	<p>'.$row['model'].'</p></br>
	 <p>'.$row['year'].' Type</br>
	 <p>'.$row['color'].'</p></br>
	 <p>'.$row['transmission'].'</p></br>
	 <p>'.$row['body_type'].'</p></br>
	 <p>'.$row['fuel_type'].'</p></br>
	</div>
	<div class="col-md-offset-1 col-md-2">
	<p>Transmission</p></br>
	<p>Color</p></br>
	 <p>Body Type</br>
	 <p>Model</p></br>
	 <p>Make</p></br>
	 <p>Year</p></br>
	 <p>Fuel Type</p></br>
	</div>
</div>
<div id="description">
	<div class="row">
	<h2  class="text-center" style="font-size:30px;"> DESCRIPTION </h2></br>
		<div class="col-md-offset-3 col-md-6">
		<p>'.$row['description'].'</p>
		</div>
		</div>
		
	</div>
 <div id="reviews">
	<h2  class="text-center" style="font-size:30px;"> REVIEWS </h2></br>
		  <div class="row" style=" margin-bottom:0px;">
			<div class="col-md-2 col-md-offset-4">
			  <div class="card">
				<div class="card-content">
				<img src="http://absorbmarketing.com/wp-content/uploads/2015/01/Picture-of-person.png"  width="100%" height="auto">
				  <span class="card-title">Mark Johnson</span> </br>
				  <span class="glyphicon glyphicon-star" aria-hidden="true" style="color:#fc5a0a"></span>
				   <span class="glyphicon glyphicon-star" aria-hidden="true" style="color:#fc5a0a"></span>
				   <span class="glyphicon glyphicon-star" aria-hidden="true" style="color:#fc5a0a"></span>
				   <span class="glyphicon glyphicon-star" aria-hidden="true" style="color:#fc5a0a"></span>
				  <p style="color:black;">We have used Auto Towing for years to tow unauthorized vehicles out of our apartment community. They are always professional. They understand our needs and strict requirements, which help tremendously when dealing with difficult situations. I would recommend them to others.</p>
				</div>
			  </div>
			</div>
			<div class="col-md-2">
			  <div class="card">
				<div class="card-content">
				<img src="http://engineering.unl.edu/images/staff/Kayla_Person-small.jpg" width="100%" height="auto">
				  <span class="card-title">Alan smith</span></br>
				  <span class="glyphicon glyphicon-star" aria-hidden="true" style="color:#fc5a0a"></span>
				  <span class="glyphicon glyphicon-star" aria-hidden="true" style="color:#fc5a0a"></span>
				   <span class="glyphicon glyphicon-star" aria-hidden="true" style="color:#fc5a0a"></span>
				   <span class="glyphicon glyphicon-star" aria-hidden="true" style="color:#fc5a0a"></span>
				   <span class="glyphicon glyphicon-star" aria-hidden="true" style="color:#fc5a0a"></span>
				  <p style="color:black;">I was very impressed with how fast the drivers helped me
with my flat tire late at night even with all the complications due to the blown tire. They were kind and very helpful and Chris worked with me and got my car done quick. Thanks just really seems like it’s not enough.</p></div>
			  </div>
			</div>
      </div>
	</div>
	<div id="contact">
	<div class="row">
	<h2  class="text-center" style="font-size:30px;"> CONTACTS </h2></br>
		<div class="col-md-offset-3" style="float:left">
		<p><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Name:'.$row['name'].'</p>
		<p>Seller Type: '.$row['seller_type'].'</p>
		<p><span class="glyphicon glyphicon-phone" aria-hidden="true"></span> '.$row['phone_number'].'</p>
		 <p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> '.$row['email'].'</p>
		 <p><span class="glyphicon glyphicon-home" aria-hidden="true"></span> '.$row['website'].'</p>
		 <p><span class="glyphicon glyphicon-home" aria-hidden="true"></span> '.$row['address'].'</p>
		</div>
		<div class="col-md-offset-1 col-md-2">
			<input type="email" class="form-control input-sm" id="inputEmail3" placeholder="Name">
			<input type="password" class="form-control input-sm" id="inputPassword3" placeholder="Email">
			<input type="password" class="form-control input-sm" id="inputPassword3" placeholder="Subject">
			<textarea type="password" class="form-control input-sm" rows="5" id="inputPassword3" placeholder="Your message goes here." ></textarea></br>
			<button type="submit" class="btn btn-success">Send Message</button></br></br>
		</div>
		</div>
		
	</div>';
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
 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">

  <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      max-width: 100%;
      margin: auto;
	  height: auto;
	  display:block;
	  padding-bottom:80px;
  }
  .carousel-indicators .active {
	  background-color: black;
}

.carousel-indicators li {
  border: 1px solid black;
}

.carousel-control.left {
  background-image: none;
}
.carousel-control.right {
  background-image: none;
}
.left, .right{
color:black;
}

#contact{
background: #272d33;
color: #fff;
}

#features{
background: #fff;
}

.listing{
background: #fff;
margin-bottom:0px;
}


#reviews{
background: #fc5a0a;
color: #fff;
}

.card-title{
color:black;
}

#description{
	color: black;
	font-size: 20px;
	font-style: bold;
}
  </style>
