<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="ui.css">
</head>
<body>
	<div class="container">
		<div class="error"></div>
		<div class="search"><input type="text" placeholder="Search by location"></div>
		<br>
		<div class="date_location_temp_div">
			<p class="datetime">current date and time <br><span><?php echo $d = date('Y-m-d H:i:s'); ?></span></p>
			<p class="temp">Tempurature <br><span></span></p>
			<p class="location">location <br><span></span></p>
		</div>
		<br>
		<div class="weekdays">
			<p class="sun">Sunday <br><br><span></span></p>
			<p class="mon">monday <br><br><span></span></p>
			<p class="tue">tuesday <br><br><span></span></p>
			<p class="wed">wednesday <br><br><span></span></p>
			<p class="thur">thursday <br><br><span></span></p>
			<p class="fri">friday <br><br><span></span></p>
			<p class="sat">saturday <br><br><span></span></p>
		</div>
		<br>
	</div>
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<script>
		$('input').change(function(event) {
			var location = $(this).val();
			$.ajax({
				url: 'ajaxphp.php',
				type: 'POST',
				data: {location: location},
				success:function(res) {
					if (res!='') {
						$('.weekdays').html(res);
						$('.datetime span').text();
						$('.location span').text(location);
						var tempurature = $('.weekdays p:first-child').html();
						var tempp = tempurature.split(' ').slice(1).join(' ');
						$('.temp span').html(tempp);
						$('.error').html('');
					}else{
						var datetime = $('.datetime span').text();
						$('.error').html('<h1>No record found</h1>');
						$('.location span,.sat span,.datetime span,.temp span').html('');
						$('.datetime span').text(datetime);

					}
				},
				error:function(error) {
					console.log(error.responseText);
				}
			});
		});
	</script>
</body>
</html>