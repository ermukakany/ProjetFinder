<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
 
<body>
 
<TABLE BORDER="1">
  <CAPTION> liste des news </CAPTION>
  <tr>
 <th> id </th>
 <th> titre </th>
 <th> contenu </th>
 <th> date </th>
  </tr>
  
 <?php
try
{
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    
    $bdd = new PDO('mysql:host=localhost;dbname=finder_2018', 'root', 'youssouf123', $pdo_options);
     
     
    // On recupere tout le contenu de la table news
$reponse = $bdd->query('SELECT id_collabo, nom_collabo, prenom_collabo FROM collaborateur');
  
// On affiche le resultat
while ($donnees = $reponse->fetch())
{
    //On affiche les données dans le tableau
    echo "</tr>";
    echo "<td> $donnees[id_collabo] </td>";
    echo "<td> $donnees[nom_collabo] </td>";
    echo "<td> $donnees[prenom_collabo] </td>";
    echo "</tr>";
 
     
}
$reponse->closeCursor();
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
?>
   
</table>
</body>
</html>