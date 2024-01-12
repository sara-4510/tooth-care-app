<?php

include __DIR__ . '/config.php';
include __DIR__ . '/helpers/AppManager.php';

//--------------TEST

require_once __DIR__ . '/models/User.php';

$userModel = new User();
$users = $userModel->getAll();

dd($users);

// -----------------------------------------------


// $sm = AppManager::getSM();
// $username = $sm->getAttribute("username");

// if (isset($username)) {

header('location: views/admin/dashboard.php');

// } else {
//   header('location: views/auth/login.php');
// }
