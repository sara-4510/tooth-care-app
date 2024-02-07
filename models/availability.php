<?php

require_once 'BaseModel.php';

class Availability extends BaseModel
{
    public $day;
    public $session_from;
    public $session_to;
    public $is_active;
    private $doctor_id;
    //private $session_from;

    protected function getTableName()
    {
        return "doctor_availability";
    }

    protected function addNewRec()
    {
        // Hash the session_from before storing it
     //   $this->session_from = session_from_hash($this->session_from, session_from_DEFAULT);

        $param = array(
            ':day' => $this->day,
          //  ':session_from' => $this->session_from,
            ':session_from' => $this->session_from,
            ':session_to' => $this->session_to,
            ':doctor_id' => $this->doctor_id,
            ':is_active' => $this->is_active
        );

        return $this->pm->run("INSERT INTO " . $this->getTableName() . "(day, session_from,session_to,doctor_id,is_active) values(:day, :session_from,:session_to,:doctor_id,:is_active)", $param);
    }

    protected function updateRec()
    {
        
        // Check if the new day or doctor_id already exists (excluding the current user's record)
        $existingAvailability = $this->getAvailabilityByDoctorAndDay($this->doctor_id, $this->day);
        if ($existingAvailability && $existingAvailability['id'] != $this->id) {
            // Handle the error (return an appropriate message or throw an exception)
            return false; // Or throw an exception with a specific error message
        }

    
        $param = array(
            ':day' => $this->day,
            ':session_from' => $this->session_from,
            ':session_to' => $this->session_to,
            ':doctor_id' => $this->doctor_id,
            ':is_active' => $this->is_active,
            ':id' => $this->id
        );
        return $this->pm->run(
            "UPDATE " . $this->getTableName() . " 
            SET 
                day = :day, 
                session_from = :session_from,
                session_to = :session_to,  
                doctor_id = :doctor_id,
                is_active = :is_active
            WHERE id = :id",
            $param
        );
    }
    public function getAvailabilityByDoctorAndDay($doctor_id,$day)
    {
        $param = array(':doctor_id' => $doctor_id,':day' => $day);

        $query = "SELECT * FROM " . $this->getTableName() . " 
                  WHERE doctor_id = :doctor_id AND day = :day";

        $result = $this->pm->run($query, $param);

        return !empty($result) ? $result[0] : null;
    }

    function createAvailability($day, $session_from, $session_to, $doctor_id, $is_active = 1)
    {
        $availabilityModel  = new Availability();

        // Check if availability already exists for the given doctor_id and day
        $existingAvailability = $availabilityModel->getAvailabilityByDoctorAndDay($doctor_id, $day);
        if ($existingAvailability) {
            // Handle the error (return an appropriate message or throw an exception)
            return false; // Or throw an exception with a specific error message
        }

        $availability = new Availability();
        $availability->day = $day;
        $availability->session_from = $session_from;
        $availability->session_to = $session_to;
        $availability->doctor_id = $doctor_id;
        $availability->is_active = $is_active;
        $availability->addNewRec();

        if ($availability) {
            return true; // User created successfully
        } else {
            return false; // User creation failed (likely due to database error)
        }
    }
   
}