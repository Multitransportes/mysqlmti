<?php  
header('Content-Type: text/xml');  
    require_once 'Numbers/Words.php';   
    $nw = new Numbers_Words();   
    $resultadio = $nw->toWords($_GET['numero']);  
    echo "$resultadio"; 
    print_r($resultadio);
?> 