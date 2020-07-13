
<?php 
// fonction  qui genere des caracteres num alpha de maniere alèatoirement 
function str_token($lenght){
    $token = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    return substr(str_shuffle(str_repeat($token,$lenght)),0,$lenght);
}

