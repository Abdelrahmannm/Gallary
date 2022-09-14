<?php 
$file ="abdelrahman.txt"; 

if($var_file = fopen($file,"r")){

    echo $c= fread($var_file,filesize($file));
    fclose($var_file );   
}else{
    echo "action denied ";
}


//unlink("name of file");

?> 
