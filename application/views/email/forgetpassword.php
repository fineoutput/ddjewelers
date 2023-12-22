<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Forget Password</title>
</head>

<body style="font-family: sans-serif;">


	<div style="width:100%">
		<div style="display: flex;">
			<h3>Password Reset</h3>
		</div>
		<div>
			<p>Hi <?php echo $user_name; ?>,</p>
			<p>Someone has requested a new password for the following account on DD Jewel Plus:</p>
			<p>Username: <b> <?php echo $user_name; ?></b></p>
			<p>If you didn't make this request, just ignore this email. If you'd like to proceed:</p>
			<p><a href="<?php echo $link; ?>" style="color: #1a2f64;">Click here to reset your password</a></p>
			<!-- <p>Stay Safe, Stay Fashionable</p> -->
			<p>Team DD Jewel Plus</p>
		</div>
	</div>

</body>

</html>