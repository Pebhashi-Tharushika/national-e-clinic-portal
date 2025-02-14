<?php

header("Content-Type: application/json");

require_once 'register-and-login-functions.inc.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);
  $errors = [];

  // Extract data from the request
  $username = trim($data['username'] ?? '');
  $password = $data['pwd'] ?? '';

  // username validation
  if (empty($username)) {
    $errors['username'] = 'username is required.';
  }

  // Password validation
  if (empty($password)) {
    $errors['pwd'] = 'Password is Required';
  }

  // Role validation
  $user = ExistUser($username);

  if (!empty($user)) {
    if ($user['role'] === 'admin') {
      $isAdminUser = true;
    } elseif ($user['role'] === 'user') {
      $isAdminUser = false;
    } else {
      $isAdminUser = null;
    }
  }

  // Confirm Password and username validation
  if (empty($errors) && (empty($user) || !isCorrectPassword($password, $username, $isAdminUser))) {
    $errors['nameAndPwd'] = 'username or password is incorrect.';
  }


  if (empty($errors)) {

    session_start();
    $_SESSION["username"] = $user['email'];
    $_SESSION['isAdmin'] = $isAdminUser;
    $_SESSION['userId'] = $isAdminUser ? $user['admin_id'] : $user['user_id'];

    echo json_encode(['status' => 'success', 'message' => 'User login successfully.']);

  } else {
    echo json_encode(['status' => 'error', 'errors' => $errors]);
  }

  exit();
}

?>