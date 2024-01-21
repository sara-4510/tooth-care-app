<?php

require_once 'BaseModel.php';

class User extends BaseModel
{
    public $username;
    public $permission;
    public $is_active;
    private $email;
    private $password;

    protected function getTableName()
    {
        return "users";
    }

    protected function addNewRec()
    {
        // Hash the password before storing it
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        $param = array(
            ':username' => $this->username,
            ':password' => $this->password,
            ':permission' => $this->permission,
            ':email' => $this->email,
            ':is_active' => $this->is_active
        );

        return $this->pm->run("INSERT INTO " . $this->getTableName() . "(username, password,permission,email,is_active) values(:username, :password,:permission,:email,:is_active)", $param);
    }

    protected function updateRec()
    {
        $param = array(
            ':username' => $this->username,
            ':password' => $this->password,
            ':permission' => $this->permission,
            ':email' => $this->email,
            ':is_active' => $this->is_active,
            ':id' => $this->id
        );
        return $this->pm->run(
            "UPDATE " . $this->getTableName() . " 
            SET 
                username = :username, 
                password = :password,
                permission = :permission,  
                email = :email,
                is_active = :is_active
            WHERE id = :id",
            $param
        );
    }

    function createUser($username, $password, $permission, $email, $is_active = 1)
    {
        $userModel = new User();

        // Check if username or email already exists
        $existingUser = $userModel->getUserByUsernameOrEmail($username, $email);
        if ($existingUser) {
            // Handle the error (return an appropriate message or throw an exception)
            return false; // Or throw an exception with a specific error message
        }

        $user = new User();
        $user->username = $username;
        $user->password = $password;
        $user->permission = $permission;
        $user->email = $email;
        $user->is_active = $is_active;
        $user->addNewRec();

        if ($user) {
            return true; // User created successfully
        } else {
            return false; // User creation failed (likely due to database error)
        }
    }

    public function getUserByUsernameOrEmail($username, $email)
    {
        $param = array(
            ':username' => $username,
            ':email' => $email
        );

        $sql = "SELECT * FROM " . $this->getTableName() . " WHERE username = :username OR email = :email";
        $result = $this->pm->run($sql, $param);

        if (!empty($result)) {  // Check if the array is not empty
            $user = $result[0]; // Assuming the first row contains the user data
            return $user;
        } else {
            return null;
        }
    }
}
