<?php

if(isset($_SESSION['msgSucesso'])){
   echo' 
   <div class="alert alert-success alert-dismissible fade show" role="alert">
        '.$_SESSION['msgSucesso'].'
      
   </div>';

   unset($_SESSION['msgSucesso']);
  
}


if(isset($_SESSION['msgErro'])){
    echo' 
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
         '.$_SESSION['msgErro'].'
       
    </div>';
    unset($_SESSION['msgErro']);
 }

 if(isset($_SESSION['msgErroExpirou'])){
     echo' 
     <div class="alert alert-danger alert-dismissible fade show" role="alert">
          '.$_SESSION['msgErroExpirou'].'
        
     </div>';
     
  }

 


?>
