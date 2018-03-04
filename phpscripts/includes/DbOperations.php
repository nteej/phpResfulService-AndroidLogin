<?php
 
 class DbOperation{

     private $conn;
     function _construct(){
         require_once dirname(__FILE__).'/DbConnect.php';

         $db=new DbConnect();
         $this->conn=$db->connect();
     }

     /* Crud c-Create method */
     function createuser($username,$pass,$email){
         $password=md5($pass);
         $stmnt=$this->conn->prepare("INSERT INTO `users` (`id`, `username`, `password`, `email`)  VALUES (NULL, ?, ?, ?)");
         $stmnt->bind_param("sss",$username,$password,$email);
         if($stmnt->execute()){
          return true;
         }else{
          return false;
         }
     }
 }
 ?>