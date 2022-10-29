<?php 
session_start();
if (isset($_POST['send'])) {

	//extraction des variables
	extract($_POST);

	//verification si les variables existent et ne sont pas vides
	if (isset($username) && $username != "" &&
		isset($email) && $username != "" &&
		isset($phone) && $phone != "" &&
		isset($message) && $message != ""){
			//envoyé l'email
			//le destinataire (notre adresse mail)
			$to = "alexis.gontier03@gmail.com";
			//objet du mail
			$subject = "Vous avez reçu un message de :" . $email;

			$message = "
				<p>Vous avez reçu un message de <strong> ".$email." </strong></p>
				<p><strong>Nom :</strong> ".$username." </p>
				<p><strong>Téléphone :</strong> ".$message." </p>
			";

			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			// More headers
			$headers .= 'From: <'.$email.'>' . "\r\n";


			//envoi de mail
			$send = mail($to,$subject,$message,$headers);
			//verification de l'envoi
			if ($send){
				$_SESSION['succes_message'] = "message envoyé";
				//redirection
				header("location:index.php");
				
			}else {
				$info = "message non envoyé";
			}



	}else{
		//si elles sont vides
		$info = "veuillez remplir tous les champs !";
	}
}

?>






<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>


	<?php 
		//afficher le message d'erreur
		if(isset($info)){ ?>
			<p class="request_message" style="color: red">
				<?=$info?>
			</p>
		<?php
		}
	?>

	<?php 
		//afficher le message de succes
		if(isset($_SESSION['succes_message'])){ ?>
			<p class="request_message" style="color: green">
				<?=$_SESSION['succes_message']?>
			</p>
		<?php
		}
	?>

	
	<form action="" method="POST">
		<h2>Contact Us</h2>
		<label>Username</label>
		<input type="text" name="username">
		<label>Email</label>
		<input type="email" name="email">
		<label>Phone</label>
		<input type="number" name="phone">
		<label>Message</label>
		<textarea name="message" cols="30" rows="10"></textarea>
		<button name="send">Send</button>
	</form>

</body>
</html>