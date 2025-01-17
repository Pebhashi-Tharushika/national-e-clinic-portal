<?php
require_once 'dbh.inc.php';

// Function to check if any input field is empty
function emptyInputSignup($name, $email, $pwd, $pwdRepeat)
{
    return empty($name) || empty($email) || empty($pwd) || empty($pwdRepeat);
}

// Function to validate the username
function isValidUsername($username)
{
    return preg_match("/^[a-zA-Z0-9]+$/", $username);
}

// Function to validate the email
function isValidEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to check if the passwords match
function isMatchedPwd($pwd, $pwdRepeat)
{
    return $pwd === $pwdRepeat;
}

// Function to check if the username or email already exists in the system
function isExistUsernameOrEmail($conn, $username, $email, $isAdminUser)
{
    $sql = $isAdminUser ? "SELECT * FROM admins WHERE username = ? OR email = ?;" : "SELECT * FROM clinic_users WHERE username = ? OR email = ?;";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:../register-and-login.php?action=register&error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
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
function createUser($conn, $name, $email, $username, $pwd, $isAdminUser)
{
    $sql = $isAdminUser ? "INSERT INTO admins (name, email, username, password) VALUES (?, ?, ?, ?);" :
        "INSERT INTO clinic_users (name, email, username, password) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:../register-and-login.php?action=register&error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:../register-and-login.php?error=none");
    exit();
}

// Function to check if login inputs are empty
function emptyInputLogin($username, $pwd)
{
    $result = empty($username) || empty($pwd);
    return $result;
}

// Function to log in the user
function loginUser($username, $pwd, $conn,$isAdminUser)
{
    $isUsernameExist = isExistUsernameOrEmail($conn, $username, $username,$isAdminUser);

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