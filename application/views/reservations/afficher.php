<h1> <?php echo "Client :";
foreach ($utilisateur as $result) {
    if($id==$result['idUtil']){
        echo $result['Prenom']." ".$result['Nom'];
    }
    
}
echo "(id: ".$id.")";
    ?> </h1>

<table border="1">
    <tr><td>ID R&eacute;servation</td><td>Date d'Arriv&eacute;e</td><td>Date de D&eacute;part</td><td>Nombre de Personnes</td><td>Menage</td><td>Status</td></tr>
<?php
foreach ($reservations as $ligne){
    if($id==$ligne['idUtil']){
    echo "<tr><td>".$ligne['idReserv']."</td><td>".$ligne['Date_Arrivee']."</td><td>".$ligne['Date_Depart']."</td>"
         . "<td>".$ligne['Nb_Personnes']."</td><td>".$ligne['Menage']."</td><td>".$ligne['EtatReservation']."</td></tr>";
    
    
    }
}
echo '</table>'; 
?>


            









    