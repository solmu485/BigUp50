<?php

if(!isset(GET['brawlername']) || (GET['attacks']) || (GET['health'])){
    //Error message
    exit();
}

switch ($variable) {
    case 'brawlername':
        echo brawlername();
        break;
    case 'health':
        echo health();
        break;    
    default:
        //Error message
        break;
}

function brawlername(){
    echo "Brawlername was updated";
}

function health(){
    echo "Health was updated";
}

?>