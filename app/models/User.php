<?php 
// echo __DIR__."../database/databaseConnection.php";die;
include_once __DIR__."\../database\databaseConnection.php";
include_once __DIR__."\../database\operation.php";

class User extends databaseConnection implements operation{

    private $id;
    private $name;
    private $email;
    private $password;
    private $phone;
    private $code;
    private $photo;
    private $code_verified_at;
    private $email_verified_at;
    private $created_at;
    private $updated_at;
    private $remember_token;

    public function emailCheck(){
        $query="SELECT `users`.* FROM `users` WHERE `users`.`email`='$this->email'"; //$this->getEmail()
        return $this->runDQL($query);
    }
    function create(){
        $query= "INSERT INTO `users`
        (`users`.`name`,`users`.`email`,
         `users`.`password`, `users`.`phone`, `users`.`code`) VALUES 
         ('$this->name', '$this->email', '$this->password', '$this->phone', '$this->code')";
         return $this->runDML($query);

    }
    public function checkCodeByEmail(){
        $query="SELECT `users`.* FROM `users` WHERE `users`.`email`='$this->email' AND `users`.`code`='$this->code'"; //$this->getEmail()
        return $this->runDQL($query);
        
    }
    public function emailVerification(){
        $query="UPDATE `users` SET `users`.`email_verified_at`='".date('Y-m-d H:i:s')."'WHERE `users`.`email` = '$this->email'";
        return $this->runDML($query);
    }
    public function login(){
        $query="SELECT `users`.* FROM `users` WHERE `users`.`email`='$this->email' AND `users`.`password`='$this->password'"; //$this->getEmail()
        return $this->runDQL($query);

    }
    public function updateCodeByEmail(){
        $query="UPDATE `users` SET `users`.`code`='$this->code' WHERE `users`.`email` = '$this->email'";
        return $this->runDML($query);
    }
    public function updateUserPasswordByEmail(){
        $query="UPDATE `users` SET `users`.`password`='$this->password' WHERE `users`.`email` = '$this->email'";
        return $this->runDML($query);
    }
    public function getUserByEmail(){
        $query="SELECT `users`.* FROM `users` WHERE `users`.`email`='$this->email' "; //$this->getEmail()
        return $this->runDQL($query);
    }
    function update(){
       if($this->photo){
           $query="UPDATE `users` SET
            `users`.`name`='$this->name',
            `users`.`phone`='$this->phone',
             `users`.`photo`='$this->photo'
           WHERE `users`.`email` = '$this->email'";
       }else{
        $query="UPDATE `users` SET
        `users`.`name`='$this->name',
        `users`.`phone`='$this->phone'
        WHERE `users`.`email` = '$this->email'";
       }
        return $this->runDML($query);
    }

    function delete(){

    }
    function read(){

    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword($password): self
    {
        $this->password = sha1($password);
        return $this;
    }

    /**
     * Get the value of phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     */
    public function setPhone($phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of code
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     */
    public function setCode($code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of photo
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set the value of photo
     */
    public function setPhoto($photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get the value of code_verified_at
     */
    public function getCodeVerifiedAt()
    {
        return $this->code_verified_at;
    }

    /**
     * Set the value of code_verified_at
     */
    public function setCodeVerifiedAt($code_verified_at): self
    {
        $this->code_verified_at = $code_verified_at;

        return $this;
    }

    /**
     * Get the value of email_verified_at
     */
    public function getEmailVerifiedAt()
    {
        return $this->email_verified_at;
    }

    /**
     * Set the value of email_verified_at
     */
    public function setEmailVerifiedAt($email_verified_at): self
    {
        $this->email_verified_at = $email_verified_at;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     */
    public function setCreatedAt($created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     */
    public function setUpdatedAt($updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Get the value of remember_token
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the value of remember_token
     */
    public function setRememberToken($remember_token): self
    {
        $this->remember_token = $remember_token;

        return $this;
    }
}