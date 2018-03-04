<?php
 
 class DbOperation{

     private $conn;

     function __construct(){
        require_once dirname(__FILE__).'/DbConnect.php';
        $db=new DbConnect();
        $this->conn=$db->connect();
     }

     /* Crud c-Create method */
    public function createuser($username,$pass,$email){
       if($this->isUserExists($username,$email)){
           return 0;
       }else{
         $password=md5($pass);
         $stmnt=$this->conn->prepare("INSERT INTO `users` (`id`, `username`, `password`, `email`)  VALUES (NULL, ?, ?, ?)");
         $stmnt->bind_param("sss",$username,$password,$email);
         if($stmnt->execute()){
          return 1;
         }else{
          return 2;
         }
        }
     }
     /* Read  function */
  private function isUserExists($username,$email){
      $stmt=$this->conn->prepare("select id from users where username=? or email=?");
      $stmt->bind_param("ss",$username,$email);
      $stmt->execute();
      $stmt->store_result();
      return $stmt->num_rows > 0;
  }
    }
 ?>