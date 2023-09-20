

<?php
$uri =  $authority.'/texte/';
//Recuperer les variables POST

$text=$_POST['text'];
$select=$_POST['select'];
$email=$_POST['email'];
$date=$_POST['date'];
$password=$_POST['password'];
$optionsRadios=$_POST['optionsRadios'];



$data = array(
    
    
    'text' => $text,
    'select'=> $select,
    'email'=> $email,
    'date'=> $date,
    'password'=> $password,
    'optionsRadios'=> $optionsRadios,
   
);
$result=curl_post($uri, $token, $data);
$textes=json_decode($result);

$code = $textes->code;
    
if($code ==201)
        {   
           
            
            //Intregration de l'IHM affichant la reponse positive
            require_once('interactions/texte/ajouter/view/reponse_positive.php'); 
        }
    else    
        {
            
            //Intregration de l'IHM affichant la reponse negative
            require_once('interactions/texte/ajouter/view/reponse_negative.php');   
        }


?>