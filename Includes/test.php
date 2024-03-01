<?php
    // FunctionTye -> User, Chatmessage
    // Playload == Data you want to insert


    if(isset($_Get["FucntionType"]))
    {
        // send error messag back to client
        exit;
    }
    switch ($_Get["FucntionType"]){
        case "user";
        insertUSer($_Get["playload"]);
        break;
        case "Chatmessage";
        insertMessage($_Get["playload"]);
        break;
        default;
        // ssend Error message back to client;
            exit;
    }
    function Insertuser($playload){

    }
    function insertMessage(){

    }

?>