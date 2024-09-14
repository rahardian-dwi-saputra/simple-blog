<!DOCTYPE html>
<html>
	<head>
    	<title>Simple Blog</title>
	</head>
	<body>
		<h1>Forget Password Email</h1>
		<p>
		You can reset password from bellow link: <a href="{{ route('reset.password.get', $token) }}">Reset Password</a>
		</p>
		<p>Thank you</p>
	</body>
</html>