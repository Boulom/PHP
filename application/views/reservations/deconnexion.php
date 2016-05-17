<?php
session_start();
session_destroy();
 header('Location: http://localhost/codeigniter/index.php/reservations');
 exit();
