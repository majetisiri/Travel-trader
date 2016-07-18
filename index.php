<html>
	<head>
	<title> Travel Trader</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">	
	<link rel="stylesheet" href="css/siri.css">
	<link rel="stylesheet" href="css/animate.css">
	</head>

	<body>
		<p id="heading" class="animated rubberBand">Travel Trader</p>
		<p id="caption" class="animated pulse">The vehicles we drive say a lot about us.</p>
		<div class="container">
		<div class="col-md-offset-3">
			<form method="post" action="vehicles.php" class="form-inline">
					<div class="listing form-group animated slideInLeft">
						<select class="form-control box"  name="listing_type">
							<option>Vehicle Type</option>
							<option>Car</option>
							<option>Truck</option>
							<option>RV</option>
							<option>Motor Cycle</option>
						</select>
					</div>
					<div class="keyword form-group animated slideInLeft">
						<input type="text" name="keyword" class="form-control box" placeholder="Enter a Keyword">
					</div>
					<div class="priceRange form-group animated slideInRight">
						<select class="form-control box" name="min_price">
							<option>Min Price</option>
							<option>$1000</option>
							<option>$2000</option>
							<option>$3000</option>
							<option>$4000</option>
							<option>$5000</option>
							<option>$10000</option>
							<option>$20000</option>
							<option>$30000</option>
							<option>$40000</option>
							<option>$50000</option>
						</select>
						<select class="form-control box animated slideInRight"  name="max_price">
							<option>Max Price</option>
							<option>$100000</option>
							<option>$200000</option>
							<option>$300000</option>
							<option>$500000</option>
							<option>$1000000</option>
						</select>
					</div>
					<div class="form-group animated slideInRight">
						<button class="btn" name="search">
							Search
						</button>
					</div>
			</form>
		</div>
		</div>
	</body>
</html>

