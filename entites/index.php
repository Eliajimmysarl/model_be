<?php
    include('../../connect/connect.php');

    $headers = apache_request_headers();
    
    $token=$headers['Authorisation'];

    $methode=$_SERVER['REQUEST_METHOD'];
        
    if (isSet($_GET['id']))
        {
            $id=$_GET['id'];
        
            if($methode=='PUT')
                {
                    require_once("modification_un.php"); 
                }
            else if($methode=='GET')
                {
                    require_once("recuperation_un_seul.php");   
                }    
            else if($methode=='DELETE')
                {
                    require_once("suppression_un.php");        
                }
            else
                {
                    echo" Erreur 400 :  Votre requete est POST et a un parametre id dans l'URL ";     
                }
        }
    else if($methode=='POST')
        {
            if(isSet($_GET['plusieurs']))
                { 
                    require_once("ajout_plusieurs.php"); 
                }
            else if(isSet($_GET['excel']))
                { 
                    require_once("import_excel.php"); 
                }
            else if(isSet($_GET['image']))
                { 
                    require_once("import_image.php"); 
                }
            else
                {
                    require_once("ajout_un_seul.php");   
                }
        }
    else if($methode=='GET')
        {
            require_once("recuperation_plusieurs.php"); 
        }  
    else if($methode=='PUT')
        {
            require_once("modification_plusieurs.php"); 
        }
    else if($methode=='DELETE')
        {
            require_once("suppression_plusieurs.php"); 
        }
    else 
        {
            echo" Erreur 405 :  Abscence de la méthode : POST, GET, PUT, DELETE  ";
        }