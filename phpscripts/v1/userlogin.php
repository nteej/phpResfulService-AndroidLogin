<?php
require '../includes/DbOperations.php';
$responce=array();
if($_SERVER['REQUEST_METHOD']=='POST')
{
    if(isset($_POST['username'])  && isset($_POST['password'])){
    $db=new DbOperation();
  if($db->userlogin($_POST['username'] ,$_POST['password'])){
    $user=$db->getuserbyemail($_POST['username']);
    
    $responce['error']=false;
    $responce['message']="Log in is sucessfull";
    $responce['id']=$user['id'];
    $responce['email']=$user['email'];
    $responce['username']=$user['username'];

  }else{

        $responce['error']=true;
        $responce['message']="Wrong username or Password";

  }


}else{
    $responce['error']=false;
    $responce['message']="User Registered Sucessfully";
}


}else{

}

echo json_encode($responce);
