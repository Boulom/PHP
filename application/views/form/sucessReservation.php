<?php 


if($makeReservation ==1){
    echo "La reservation a bien été effectuer.";
    
}
else {
    echo "Une erreur a été rencontré lors de la reservation.";
}
$_POST['Date_Arrivee']=null;$_POST['Date_Depart']=null;
$_POST['Nb_Personnes']=null;$_POST['Menage']=null;
?> 
<a href="liste">Retour</a>
