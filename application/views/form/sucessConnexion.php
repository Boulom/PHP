<?php



if ($checkAuthentification === TRUE){
    header('Location: http://localhost/codeigniter/index.php/reservations/liste');
    
}
else {
    header('Location: http://localhost/codeigniter/index.php/reservations');
    exit();
}
 
