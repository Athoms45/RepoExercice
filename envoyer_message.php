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
	    		//if (isset($_POST['nom']) AND isset($_POST['prenom']) AND isset($_POST['sujet']) AND isset($_POST['email']))
    			echo "Nom : " . $_POST['nom'] . "<br />";
    			echo "Prénom : " . $_POST['prenom'] . "<br />";
    			echo "email : " . $_POST['email'] . "<br />";
    			echo "Sujet : " . $_POST['sujet'] . "<br />";
    			echo "Message : " . $_POST['message'] . "<br />";

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
	    		/*else
	    		{	echo "Il manque des champs" . "<br />";
	    			echo "Nom : " . $_POST['nom'] . "<br />";
	    			echo "Prénom : " . $_POST['prenom'] . "<br />";
	    			echo "email : " . $_POST['email'] . "<br />";
	    			echo "Sujet : " . $_POST['sujet'] . "<br />";
	    		}*/
	    	}
	    	else {
	    		echo "ce n'est pas une adresse mail valide";
	    	}
    	?>
    </body>
</html>