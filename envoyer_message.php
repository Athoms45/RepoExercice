<html>
	<head>
        <title>Message</title>
        <meta charset="utf-8"/>
    </head>
    <body>
    <?
    	<p>Envoi du message ...</p>
    	<?php 
    		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

    			// Connexion à la base de données
    			try{$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');}
    			catch (Exception $e) {die('Erreur : ' . $e->getMessage());}

    			//Insertion des champs
    			$req = $bdd->prepare('INSERT INTO message(nom,prenom,email,sujet,message) VALUES (?,?,?,?,?)');
    			$req->execute(array($_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['sujet'],$_POST['message']));

    			//envoi de l'email
    			$to = 'denis.thomas45@gmail.com';
				// Subject
				$subject = 'Developpez.com - Test Mail';
				// Message
				$msg = 'Developpez.com - Message du mail ...';
				// Function mail()
				mail($to, $subject, $msg);

	    		header('Location: Premier_exercice.php');
	    	}
	    	else {
	    		echo "ce n'est pas une adresse mail valide";
	    	}
    	?>
    </body>
</html>