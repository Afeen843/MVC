<?php

namespace App\Models;

use App\Bootstrap\View;

class RegisterModel extends BaseModel
{
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $password;
    public string $confirmPassword;

    private array $error = [];


    public function validate(): bool
    {
        $flag = true;
        if(empty($this->firstName)){
            $flag = false;
            $this->error['firstName'] = "First name is required";
        }

        if(empty($this->lastName)){
            $flag = false;
            $this->error['lastName'] = "last name is required";
        }

        if(empty($this->password)){
            $flag = false;
            $this->error['password'] = "password name is required";
        }

        if(empty($this->confirmPassword)){
            $flag = false;
            $this->error['confirmPassword'] = "confirm password name is required";
        }

        if(empty($this->email)){
            $flag = false;
            $this->error['email'] = "Email is required";
        }

        if(!empty($this->email)){
            if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
                $flag = false;
                $this->error['email'] = "Invalid email format";
            }
        }

        if(!empty($this->password) && !empty($this->confirmPassword)){
            if($this->password !== $this->confirmPassword){
                $flag = false;
                $this->error['confirmPassword'] = "Passwords do not match";
            }
        }

        if(!empty($this->email)){
            if(filter_var($this->email, FILTER_VALIDATE_EMAIL)){
                $result = $this->query->table('users')
                    ->select('email')
                    ->where('email','=', $this->email)
                    ->first();
                if($result){
                    $flag = false;
                    $this->error['email'] = "Email already exists";
                }
            }
        }

        return $flag;
    }

    public function getErrors(): array
    {
        return $this->error;
    }

    public function hasError($key): bool
    {
        return $this->error[$key] ?? false;
    }

    public function getErrorText($key): string
    {
        return $this->error[$key];
    }

    public function insertUser(): false|string
    {
       return $this->query->table('users')->insert([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'password_hash' => password_hash($this->password, PASSWORD_DEFAULT),
        ]);

    }

    public function validateLogin(): bool
    {
        $flag = true;
        if(empty($this->email)){
            $flag = false;
            $this->error['email'] = "Email is required";
        }
        if(empty($this->password)){
            $flag = false;
            $this->error['password'] = "password is required";
        }

        if(!empty($this->email)){
            if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
                $flag = false;
                $this->error['email'] = "Invalid email format";
            }
        }
        if(!empty($this->password) && !empty($this->email)){
           $result = $this->query->table('users')
               ->select('password_hash')
               ->where('email', '=' , $this->email)
               ->first();
           if($result){
               if(!password_verify($this->password, $result->password_hash)){
                   $flag = false;
                   $this->error['password'] = "you entered wrong password";
               }
           }else{
               $flag = false;
               $this->error['email'] = "you entered wrong email";
           }
        }

        return $flag;
    }


    public function setUserSession()
    {
        $this->session->regenerateId();

        $result = $this->query->table('users')
            ->select('id')
            ->where('email', '=' , $this->email)
            ->first();

        $this->session->set('user_id', $result->id);
    }


}