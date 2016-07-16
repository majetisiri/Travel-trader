<html>
	<head>
	<title> Travel Trader</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/siri.css">
	</head>

	<body>
		<p id="heading">Travel Trader</p>
		<p id="caption">The vehicles we drive say a lot about us.</p>
		<form method="post" action="vehicles.php" class="form-inline">
			<div class="col-md-offset-4">
				<div class="listing form-group">
					<select class="form-control box"  name="listing_type">
						<option>Vehicle Type</option>
						<option>Car</option>
						<option>Truck</option>
						<option>RV</option>
						<option>Motor Cycle</option>
					</select>
				</div>
				<div class="keyword form-group">
					<input type="text" name="keyword" class="form-control box" placeholder="Enter a Keyword">
				</div>
				<div class="priceRange form-group">
					<select class="form-control box" name="min_price">
						<option>Min Price</option>
						<option>$1000</option>
						<option>$2000</option>
						<option>$3000</option>
						<option>$4000</option>
						<option>$5000</option>
					</select>
					<select class="form-control box"  name="max_price">
						<option>Max Price</option>
						<option>$6000</option>
						<option>$7000</option>
						<option>$8000</option>
						<option>$9000</option>
						<option>$10000</option>
					</select>
				</div>
				<div class="form-group">
					<button class="btn" name="search">Search</button>
				</div>
			</div>
		</form>
	</body>
</html>

