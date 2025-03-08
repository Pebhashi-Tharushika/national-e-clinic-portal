<?php
header("Content-Type: application/json");

require_once 'register-and-login-functions.inc.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $errors = [];

    // Extract data from the request
    $name = trim($data['name'] ?? '');
    $email = trim($data['email'] ?? '');
    $password = $data['password'] ?? '';
    $confirmPassword = $data['confirmPassword'] ?? '';
    $role = $data['role'] ?? '';
    $adminCode = $data['adminCode'] ??'';

    $isAdminUser= $role === 'admin';

    // Name validation
    if (empty($name)) {
        $errors['name'] = 'Name is required.';
    }

    // Email validation
    if (empty($email)) {
        $errors['email'] = 'Email is required';
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email.';
    } else if (isExistEmail( $email,$isAdminUser, true)) {
        $errors['email'] = 'Already exists.';
    }

    // Password validation
    $passwordPattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,}$/';
    if(empty($password)){
        $errors['password'] = 'Password is Required';
    }
    else if (!preg_match($passwordPattern, $password)) {
        $errors['password'] = 'Wrong Password';
    }

    // Confirm Password validation
    if(empty($confirmPassword)){
        $errors['confirmPassword'] = 'Password Confirmation is required';
    }
    else if ($password !== $confirmPassword) {
        $errors['confirmPassword'] = 'Passwords do not match.';
    }

    // Role validation
    $allowedRoles = ['admin', 'user']; // Define allowed roles
    if (empty($role) ) {
        $errors['role'] = 'Role is required.';
    }elseif (!in_array($role, $allowedRoles)) {
        $errors['role'] = 'Invalid role.';
    }

    if($isAdminUser){
        if(empty($adminCode)){
            $errors['adminCode'] = 'Admin code is required';
        }elseif(!isCorrectAdminCode( $adminCode )){
            $errors['adminCode'] = 'Wrong admin code';
        }
    }

    if (empty($errors)) {
        // Call createUser function to register the user
        $userCreated = createUser( $name, $email, $password, $isAdminUser);

        if ($userCreated) {
            echo json_encode(['status' => 'success', 'message' => 'User registered successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to register user. Please try again.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'errors' => $errors]);
    }
    
    exit();
}

?>

