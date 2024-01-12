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
}
