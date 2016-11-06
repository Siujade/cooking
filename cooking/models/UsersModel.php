<?php

class UsersModel extends MainModel{
    public function register() {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
            $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_SPECIAL_CHARS);

            $data = array(
                'name'=> $name,
                'password'=>password_hash($password, PASSWORD_BCRYPT),
                'email'=>$email,
                'location'=>$location
            );

            //Todo validations
            if(empty($name) || ctype_space($name)) {
               return false;
            }

          $result =  self::insert('users', $data);

         if(gettype($result) != 'object') {
             return $result;
         } else {
             $error_code = $result->errorInfo[1];

             if ($error_code == 1062) {
                 return "Тази поща e заета.";
             } else {
                 return $result->getMessage();
             }
         }
    }

    public function login(){
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

        //Todo validations
        if(empty($name) || ctype_space($name)) {
            return true;
        }

        $fields = array('name','user_id', 'password');
        $conditions = array('name'=>$name);

        $result = parent::select('users', $fields, $conditions);

        if($result && password_verify($password, $result[0]['password'])){

              return $result[0];
        } else {
            return false;
        }
    }

} 