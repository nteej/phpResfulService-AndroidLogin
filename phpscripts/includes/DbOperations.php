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

  public function getuserbyemail($username){
      $stmt=$this->conn->prepare("SELECT * FROM `users` WHERE username =?");
      $stmt->bind_param("s",$username);
     return $stmt->get_result()->fetch_assoc();
  }

  public function userlogin($username,$pass){
      $password=md5($pass);
      $stmt=$this->conn->prepare("select id from users where username=? and password=?");
      $stmt->bind_param("ss",$username,$password);
      $stmt->execute();
      $stmt->store_result();
      return $stmt->num_rows>0;
  }
    }
 ?>