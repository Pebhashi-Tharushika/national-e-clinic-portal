<?php

// If click the register button
if (isset($_POST["submit"])) {
    // Get form input data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];
    $role = $_POST["role"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $isValid = true;
    $errors = [];

    // Validate name, email, password, etc.
    if (empty($name) || empty($email) || empty($pwd) || empty($pwdRepeat) || empty($role)) {
        $isValid = false;
        $errors[] = "All fields are required.";
    }

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $isValid = false;
        $errors['email'] = "Invalid email format.";
    }

    // Password strength validation
    $passwordPattern = "/^(?=(.*[A-Z]))(?=(.*[a-z]))(?=(.*\d))(?=(.*[!@#$%^&*()\-_+=\[\]{};:',<>\./?\\|]))[A-Za-z\d!@#$%^&*()\-_+=\[\]{};:',<>\./?\\|]{12,}$
/";
    if (!preg_match($passwordPattern, $pwd)) {
        $isValid = false;
        $errors['password'] = "Password must be at least 12 characters with 1 uppercase letter, 1 lowercase letter, 1 number and 1 special character.";
    }

    // Check if passwords match
    if ($pwd !== $pwdRepeat) {
        $isValid = false;
        $errors['confirmPassword'] = "Passwords do not match.";
    }

    // If validation failed, return with error messages
    if (!$isValid) {
        // Return error message(s) and stop further processing
        foreach ($errors as $field => $errorMessage) {
            echo "<script>document.getElementById('{$field}Error').textContent = '{$errorMessage}';</script>";
        }
    } else {
       
    }
}
?>


<?php 
// If click the register button
      if (isset($_POST["submit"])){
        
        // Get form input data

        $name =$_POST["name"];
        $email =$_POST["email"];
        $pwd =$_POST["pwd"];
        $pwdRepeat =$_POST["pwdrepeat"];
        $role =$_POST["role"];

        require_once 'dbh.inc.php';
        require_once 'functions.inc.php';
        

        $isAdminUser = strtolower($role) === 'admin';

        $emptyInput = emptyInputSignup($name, $email,$pwd,$pwdRepeat);
        $isValidUsername = isValidUsername($username);
        $isValidEmail = isValidEmail($email);
        $isMatchedPwd = isMatchedPwd($pwd, $pwdRepeat);
        $isExistUsernameOrEmail = isExistUsernameOrEmail($conn, $username, $email,$isAdminUser);
        
             if($emptyInput !== false){
              header("location:../signup.php?error=empty-input");
              exit();
              }

              
             if(!$isValidUsername){
              header("location:../signup.php?error=invalid-username");
              exit();
              }

              
             if(!$isValidEmail){
              header("location:../signup.php?error=invalid-email");
              exit();
              }

              
             if(!$isMatchedPwd){
              header("location:../signup.php?error=password-mismatch");
              exit();
              }

              
             if( $isExistUsernameOrEmail){
              header("location:../signup.php?error=already-exist");
              exit();
              }

              // If all inputs are error free, register user
              createUser($conn, $name, $email,$username, $pwd,$isAdminUser);
            

        }
        else{
          header('location:../register-and-login.php');
          exit();
        }
?>