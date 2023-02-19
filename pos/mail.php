<!DOCTYPE html>
<html>
<head>
<title>Send Mail</title>


<script src="https://smtpjs.com/v3/smtp.js">
</script>
<script type="text/javascript">
	function sendEmail() {

		Email.send({
    Host : "smtp.elasticemail.com",
    Username : "testmarvinug@gmail.com",
	Password: "590FB6DB982CD11C3D1A0F822014531FBE18",
		To: 'marvins.kauta@gmail.com',
		From: "okmarvins@gmail.com",
		Subject: "Sending Email using javascript",
		Body: "Well that was easy!!",
}).then(
  message => alert(message)
);
	}
</script>
</head>

<body onload="sendEmail()">
<!-- <form method="post">
	<input type="button" value="Send Email"
		onclick="sendEmail()" />
</form> -->
</body>
</html>
