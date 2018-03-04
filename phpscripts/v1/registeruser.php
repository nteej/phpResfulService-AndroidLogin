<?php

require '../includes/DbOperations.php';
$responce=array();
if($_SERVER['REQUEST_METHOD']=='POST')
{
    if(
        isset($_POST['username']) &&
        isset($_POST['email']) &&
        isset($_POST['password']))
        {
    $db=new DbOperation();
if($db->createuser(
        $_POST['username'],
        $_POST['password'],
        $_POST['email']
    )){
        $responce['error']=false;
        $responce['message']="User Registered Sucessfully";
    }else{
        $responce['error']=true;
        $responce['message']="Some error ocurred Please try again";
     }


    }else{
        $responce['error']=true;
        $responce['massage']="Required fields are missing";
    }

}else{
    $responce['error']=true;
    $responce['message']="Invaid Request";
}
echo  json_encode($responce);
?>