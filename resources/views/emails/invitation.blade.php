
<!DOCTYPE html>
<html>
<head>
	<title>Sample Template</title>
	<style type="text/css">
		body {
			font-family: Arial, sans-serif;
			font-size: 16px;
			line-height: 1.5;
			margin: 0;
			padding: 0;
			background-color: #f7f7f7;
		}

		.container {
			max-width: 800px;
			margin: 0 auto;
			padding: 40px;
			background-color: #ffffff;
			box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
		}

		h1 {
			font-size: 28px;
			margin-top: 0;
		}

		p {
			margin-bottom: 20px;
		}

		button {
			display: inline-block;
			padding: 10px 20px;
			font-size: 16px;
			font-weight: bold;
			color: #ffffff;
			background-color: #007bff;
			border-radius: 5px;
			text-decoration: none;
			cursor: pointer;
		}

		button:hover {
			background-color: #0062cc;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1>Hello {{ $data["name"] }}</h1>
		<p> I am reaching out to you to  join {{ $data["company"] }} . this is the link to our platform .use this credentials to log in then set up your profile</p>
        <div>
            <p><strong>Email</strong> :  {{$data["email"]}}</p>
            <p><strong>Password</strong> :  {{$data["password"]}}</p>
            <em>change your password after login</em>
        </div>
        <a href="" target="_blank">log in from here</a>
        <div>
            <p>Best regards,</p>
        </div>
	</div>
</body>
</html>
