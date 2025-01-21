<?php
require_once 'dbh.inc.php';


// Function to check if the username or email already exists in the system
function isExistEmail($email, $isAdminUser)
{
    global $conn;
    $sql = $isAdminUser ? "SELECT * FROM admins WHERE email = ?;" : 
    "SELECT * FROM clinic_users WHERE email = ?;";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:../register-and-login.php?action=register");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s",  $email);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        mysqli_stmt_close($stmt);
        return $row; // Return the row if the user is found
    } else {
        mysqli_stmt_close($stmt);
        return false;
    }
}

// Function to create a new user
function createUser($name, $email, $pwd, $isAdminUser)
{
    global $conn;
    $sql = $isAdminUser ? "INSERT INTO admins (name, email, password) VALUES (?, ?, ?);" :
        "INSERT INTO clinic_users (name, email, password) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        return false;
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPwd);
    $executeResult = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    return $executeResult;
}


// Function to verify admin code
function isCorrectAdminCode($adminCode) {
    $storedHash = fetchAdminCode();
    
    if ($storedHash !== false) {
        return password_verify($adminCode, $storedHash);
    }

    return false;
}


function fetchAdminCode(){
    global $conn;
    $sql = "SELECT admin_code FROM admin_codes ORDER BY create_date DESC LIMIT 1";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:../register-and-login.php?action=register");
        exit();
    }

    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        mysqli_stmt_close($stmt);
        return $row['admin_code']; // Return the actual admin code hash
    } else {
        mysqli_stmt_close($stmt);
        return false; // Return false if no data is found
    }
}

// Function to check if login inputs are empty
function emptyInputLogin($username, $pwd)
{
    $result = empty($username) || empty($pwd);
    return $result;
}

// Function to log in the user
function loginUser($email, $pwd, $isAdminUser)
{
    global $conn;
    $isUsernameExist = isExistEmail( $email,$isAdminUser);

    if ($isUsernameExist === false) {
        header("location:../register-and-login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $isUsernameExist["password"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location:../register-and-login.php?error=wronglogin");
        exit();
    } else {
        session_start();
        $_SESSION["userid"] = $isUsernameExist["user_id"];
        $_SESSION["useruid"] = $isUsernameExist["username"];
        $_SESSION["username"] = $isUsernameExist["name"];
        $_SESSION['isAdmin'] = $isAdminUser;
        header("location:../index.php");
        exit();
    }
}
?>