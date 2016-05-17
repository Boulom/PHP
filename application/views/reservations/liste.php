<?php 

if ($checkUser->Admin==1 ){
       
    ?><h2><?php echo "Liste des Clients"; ?></h2>
    <?php foreach ($utilisateur as $ligne): ?>
        <h3><?php echo $ligne['Nom']." ".$ligne['Prenom']; ?></h3>
        
        <p><a href="<?php echo site_url('reservations/afficher/'.$ligne['idUtil']); ?>">
                Voir R&eacute;servation</a></p>
              
    <?php endforeach;
    echo $calend;?>
    <p><a href="deconnexion">Deconexion</a>  
    <?php
    }

    else if ($checkUser->Admin==0){
        
        echo "<h2>Vos Reservations</h2>" ;?>
                <p>        
        <table border="1">
            <tr><td>ID R&eacute;servation</td><td>Date d'Arriv&eacute;e</td><td>Date de D&eacute;part</td><td>Nombre de Personnes</td><td>Menage</td><td>Status</td><td>Suppression</td></tr>
        <?php
        foreach ($reservation as $ligne){
            
                echo "<tr><td>".$ligne['idReserv']."</td><td>".$ligne['Date_Arrivee']."</td><td>".$ligne['Date_Depart']."</td>"
                . "<td>".$ligne['Nb_Personnes']."</td><td>".$ligne['Menage']."</td><td>".$ligne['EtatReservation']."</td><td><a href='suppressionReservation'>Supprimer</a></td></tr>";
    
    
            }
            echo '</table><p>'; 
            echo $calend;
            ?><p><a href="reserver">Reserver</a></p>
            <a href='modificationReservation'>Modifier</a>
            <p><a href="deconnexion">Deconexion</a>
            
                
               
            <?php 

    } 
    else {
        header('Location: http://localhost/codeigniter/index.php/reservations');
        exit();
    }
 
 
    


?>

