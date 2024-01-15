<?php 
include_once __DIR__."\../models\User.php";
class RegisterRequest {
    private $password;
    private $confirm_password;
    private $email; 
   
    // function name, pass, email, phone,  .......
    public function emailValidation(){
        //validation, required regular expression
        $errors = [];
        $pattern= '/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/';
        if(empty($this->email)){ // $this->getEmail
            $errors['email-required'] = "Email Is Required";
        }else{
            if(!preg_match($pattern, $this->email)){
                $errors['email-invalid'] = "Email Must be ensure the top level domain is between 2 and 4 characters long, but does not check the specific domain against a list";
            }
        }
       return $errors;
    }

    public function passwordValidation(){
        // required, regex, confirm     
        $errors = [];
        $pattern= '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/';
        if(empty($this->password)){
            $errors['password-required'] = "password Is Required";
        }else{
            if(!preg_match($pattern, $this->password)){
                $errors['password-invalid'] = "Password must be between 4 and 8 digits long and include at least one numeric digit";
            }
        }
        if(empty($this->confirm_password)){
            $errors['confirm-password-required'] = "Confirm password Is Required";
        }else{
            if($this->password != $this->confirm_password){
                $errors['confirm-password-invalid'] = "Confirm password dosnot match password";
            }
        }
        return $errors;
    }

    public function emailDataBaseCheck(){
        $user = new User;
        $user->setEmail($this->email);
        if($user->emailCheck()){
            return ['email-exists'=>'Email already exists']; //email exist in db
        }else{
            return []; // email not exist
        }
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
     * Get the value of confirm_password
     */
    public function getConfirmPassword()
    {
        return $this->confirm_password;
    }

    /**
     * Set the value of confirm_password
     */
    public function setConfirmPassword($confirm_password): self
    {
        $this->confirm_password = $confirm_password;

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
        $this->password = $password;

        return $this;
    }
}