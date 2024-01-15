<?php 
class LoginRequest{
    private $password;
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
        return $errors;
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
?>