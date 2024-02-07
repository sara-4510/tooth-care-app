<?php

require_once 'BaseModel.php';

class Treatment extends BaseModel
{
    public $name;
    public $description;
    public $registration_fee;
    public $treatment_fee;
    public $is_active;

    protected function getTableName()
    {
        return "treatments";
    }

    protected function addNewRec()
    {
        
        $param = array(
            ':name' => $this->name,
            ':description' => $this->description,
            ':treatment_fee' => $this->treatment_fee,
            ':registration_fee' => $this->registration_fee,
            ':is_active' => $this->is_active
        );

        return $this->pm->run("INSERT INTO " . $this->getTableName() . "(name,description,treatment_fee,registration_fee,is_active) values(:name,:description,:treatment_fee,:registration_fee,:is_active)", $param);
    }

    protected function updateRec()
    {
        
        $param = array(
            ':name' => $this->name,
            ':description' => $this->description,
            ':treatment_fee' => $this->treatment_fee,
            ':registration_fee' => $this->registration_fee,
            ':is_active' => $this->is_active,
            ':id' => $this->id
        );
        return $this->pm->run(
            "UPDATE " . $this->getTableName() . " 
            SET 
                name = :name, 
                description = :description,  
                treatment_fee = :treatment_fee,
                registration_fee = :registration_fee,
                is_active = :is_active
            WHERE id = :id",
            $param
        );
    }
    // public function getUserBynameOrtreatment_feeWithId($name, $treatment_fee, $excludeUserId = null)
    // {
    //     $param = array(':name' => $name, ':treatment_fee' => $treatment_fee);

    //     $query = "SELECT * FROM " . $this->getTableName() . " 
    //               WHERE (name = :name OR treatment_fee = :treatment_fee)";

    //     if ($excludeUserId !== null) {
    //         $query .= " AND id != :excludeUserId";
    //         $param[':excludeUserId'] = $excludeUserId;
    //     }

    //     $result = $this->pm->run($query, $param);

    //     return $result; // Return the user if found, or false if not found
    // }

    // function createUser($name, $password, $description, $treatment_fee, $is_active = 1)
    // {
    //     $userModel = new User();

    //     // Check if name or treatment_fee already exists
    //     $existingUser = $userModel->getUserBynameOrtreatment_fee($name, $treatment_fee);
    //     if ($existingUser) {
    //         // Handle the error (return an appropriate message or throw an exception)
    //         return false; // Or throw an exception with a specific error message
    //     }

    //     $user = new User();
    //     $user->name = $name;
    //     $user->password = $password;
    //     $user->description = $description;
    //     $user->treatment_fee = $treatment_fee;
    //     $user->is_active = $is_active;
    //     $user->addNewRec();

    //     if ($user) {
    //         return true; // User created successfully
    //     } else {
    //         return false; // User creation failed (likely due to database error)
    //     }
    // }
    // function updateUser($id, $name, $password, $description, $treatment_fee, $is_active = 1)
    // {
    //     $userModel = new User();

    //     // Check if name or treatment_fee already exists
    //     $existingUser = $userModel->getUserBynameOrtreatment_feeWithId($name, $treatment_fee, $id);
    //     if ($existingUser) {
    //         // Handle the error (return an appropriate message or throw an exception)
    //         return false; // Or throw an exception with a specific error message
    //     }

    //     $user = new User();
    //     $user->id = $id;
    //     $user->name = $name;
    //     $user->password = $password;
    //     $user->description = $description;
    //     $user->treatment_fee = $treatment_fee;
    //     $user->is_active = $is_active;
    //     $user->updateRec();

    //     if ($user) {
    //         return true; // User udapted successfully
    //     } else {
    //         return false; // User update failed (likely due to database error)
    //     }
    // }


    // public function getUserBynameOrtreatment_fee($name, $treatment_fee)
    // {
    //     $param = array(
    //         ':name' => $name,
    //         ':treatment_fee' => $treatment_fee
    //     );

    //     $sql = "SELECT * FROM " . $this->getTableName() . " WHERE name = :name OR treatment_fee = :treatment_fee";
    //     $result = $this->pm->run($sql, $param);

    //     if (!empty($result)) {  // Check if the array is not empty
    //         $user = $result[0]; // Assuming the first row contains the user data
    //         return $user;
    //     } else {
    //         return null;
    //     }
    // }

function deleteTreatment($id)
{
    $user = new User();
    $user->deleteRec($id);

    if ($user) {
        return true; // User udapted successfully
    } else {
        return false; // User update failed (likely due to database error)
    }
}
}