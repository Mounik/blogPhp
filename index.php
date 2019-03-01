<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Blog</title>
	<link href="style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <h1>Mon premier blog !</h1>
        <p>Derniers billets du blog :</p>
 
	<?php
		// Connexion à la base de données
		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
		}
		catch(Exception $e)
		{
		        die('Erreur : '.$e->getMessage());
		}

		// On récupère les 5 derniers billets
		$req = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%i\') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5');

		while ($donnees = $req->fetch())
		{
	?>
	<div class="news">
	    <h3>
	    	<!-- Titre du billet -->
	        <?php echo htmlspecialchars($donnees['titre']); ?> 
	        <!-- Données date du billet -->
	        <em>le <?php echo $donnees['date_creation_fr']; ?></em> 
	    </h3>
	    
	    <p>
		    <?php
		    // On affiche le contenu du billet
		    echo nl2br(htmlspecialchars($donnees['contenu']));
		    ?>
	    <br />
	    <!-- Lien vers les commentaires -->
	    <em><a href="commentaires.php?billet=<?php echo $donnees['id']; ?>">Commentaires</a></em> 
	    </p>
	</div>
		<?php
		} // Fin de la boucle des billets
		$req->closeCursor();
		?>
</body>
</html>