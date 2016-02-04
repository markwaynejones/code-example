<html>
	<head>
		<title>Laravel</title>
		
		
	</head>
	<body>
		<div class="container">
			<div class="content">
				<div class="title" style="color:black;">Laravel 5 - Test Page</div>
				
				<h2>Test Page</h2>
				
				<div class="quote" style="color:black;font-weight:bold;font-family:arial;">{{ Inspiring::quote() }}</div>
				
				<?php 
					/*<!-- 
					full_name represents a column name in your Price table. 
					Either add this column to your database table or modify line below 
					to represent a different column name  
					*/
				?>
				
				@foreach($allPrices as $Price)

					<p class="name">{{ $Price->name }}</p>
					
				@endforeach
				
			</div>
		</div>
	</body>
</html>
