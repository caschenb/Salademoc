<HTML>
  <head>
    <title>Competition</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<?php
	mb_internal_encoding("UTF-8");
	include("connect.php");
	$idConnexion=fconnect();
	?>
	
    <script type="text/javascript">
      function catsel(sel) {
        //if (sel.value=="-1" ) return;
        var opt=sel.getElementsByTagName("option" );
        for (var i=0; i<opt.length; i++) {
          var x=document.getElementById(opt[i].value);
          if (x) x.style.display="none";
        }
        var cat = document.getElementById(sel.value);
        if (cat) cat.style.display="block";
      }
    </script>
  </head>
  <body>

    <table>
      <tr>
        <td>
        Faites un choix :
        </td>
        <td>
          <select name="choice" onchange="catsel(this)">
          <!--<option value="-1">None</option>!-->
            <option value="1">Créer</option>
            <option value="2">Modifier</option>
            <option value="3">Supprimer</option>
            <option value="4">Rechercher</option>
          </select>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <div id="1" style="display:block">
            <table border="0" cellspacing="3" cellpadding="0">
				<tr><td>formulaire création</td></tr>
			</table>
				<form method = "GET" action="competition_ajout_res.php">
				<p><label for="nom">Nom :</label><br />
				<input type = "text" name = "nom" id="nom" required></p>
				<p><label for="date">Date :</label><br />
				<input type = "text" name = "date" id="date" required></p>
				<p><label for="lieu">Lieu :</label><br />
				<input type = "text" name = "lieu" id="lieu"></p>
				<p><label for="site">Site Web :</label><br />
				<input type = "text" name = "site" id="site" required></p> <!--s'il est nul il n'est plus unique.... dommage pour la contrainte-->
				<p><label for="mail">Mail :</label><br />
				<input type = "text" name = "mail" id="mail"></p>
				<!--<p><label for="materiau">Nom Du Materiau :</label><br />
				<input type = "text" name = "materiau" id="materiau"></p> !-->
				<p>
				<label for="type">De quel type de Compétition s'agit-il ?</label><br />
				<select name="type" onchange="catsel(this)" id="type" required>
					<option value="CompetitionKata">Kata</option>
				   <option value="CompetitionKumite">Kumite</option>
				   <option value="CompetitionTameshiWari">Tameshi Wari</option>
				   <option value="CompetitionMixte">Mixte</option>
				</select>
				</p>
				<div id="CompetitionTameshiWari" style="display:none">
					<p>Nom Du Materiau :<br />
					<input type = 'text' name = 'materiau'></p>
				</div>
				<div id="CompetitionMixte" style="display:none">
					<p>Nom Du Materiau :<br />
					<input type = 'text' name = 'materiau' ></p>
				</div>
				<input type = "submit">
				</form>
			
          </div>
          <div id="2" style="display:none">
            <table border="0" cellspacing="3" cellpadding="0"><tr><td>formulaire modification</td></tr></table>
				<form method = "GET" action="competition_modif.php">
				<?php
				echo '<p> <label for="type">Veuillez choisir la competition que vous voulez modifier : </label><br />
				<select name="type" id="type"></p>';
				$querystring = "SELECT nom, date
								FROM projet_karate.competition";
				//créer la requête qui permet de récupérer les compétitions déjà créées
				$query = pg_query($idConnexion, $querystring);
				$i=0;
				while($result = pg_fetch_array($query))
				{
					$i++;
					//$nb = $result['nom']; // ici on stocke la projection sur nom du résultat de la ième ligne 
					echo"<option value=$result[nom]>$result[nom] - $result[date]</option>";
				}				
				
				echo'</select>
				</p>'
				?>
				<input type = "submit">
				</form>
		  </div>
          <div id="3" style="display:none">
            <table border="0" cellspacing="3" cellpadding="0"><tr><td>formulaire suppression</td></tr></table>
			<form method = "GET" action="competition_supp_res.php">
				<?php
				echo '<p> <label for="type">Veuillez choisir la competition que vous voulez supprimer : </label><br />
				<select name="compet_supp" id="type"></p>';
				$querystring = "SELECT nom, date 
								FROM projet_karate.competition";
				//créer la requête qui permet de récupérer les compétitions déjà créées
				$query = pg_query($idConnexion, $querystring);
				$i=0;
				while($result = pg_fetch_array($query))
				{
					$i++;
					//$nb = $result['nom']; // ici on stocke la projection sur nom du résultat de la ième ligne 
					echo"<option value=$result[nom]>$result[nom] - $result[date]</option>";
				}				
				echo'</select>
				</p>'
				?>   
				<input type = "submit">
			</form>				
		  </div>
          <div id="4" style="display:none">
            <table border="0" cellspacing="3" cellpadding="0"><tr><td>formulaire rechercher</td></tr></table>
				<form method = "GET" action="competition_rech_res.php">
				<?php
				echo '<p> <label for="nomCompet">Veuillez choisir la competition que vous souhaitez consulter : </label><br />
				<select name="type" id="type"></p>';
				$querystring = "SELECT nom, date 
								FROM projet_karate.competition";
				//créer la requête qui permet de récupérer les compétitions déjà créées
				$query = pg_query($idConnexion, $querystring);
				$i=0;
				while($result = pg_fetch_array($query))
				{
					$i++;
					//$nb = $result['nom']; // ici on stocke la projection sur nom du résultat de la ième ligne 
					echo"<option value=$result[nom]>$result[nom] - $result[date]</option>";
				}				
				echo'</select>
				</p>'
				?>   
				<input type = "submit">
			</form>	          
		  </div>
        </td>
      </tr>
    </table>
  </body>
</html>
