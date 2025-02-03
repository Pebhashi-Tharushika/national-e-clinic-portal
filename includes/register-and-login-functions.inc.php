<?php
require_once 'dbh.inc.php';


// Function to check if the username or email already exists in the system
function isExistEmail($email, $isAdminUser, $isRegister)
{
    global $conn;
    $sql = "SELECT * FROM " . ($isAdminUser ? "admins" : "clinic_users") . " WHERE email = ?;";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo json_encode([
            'status' => 'error',
            'message' => $isRegister ? 'Error during registration.' : 'Error during login.',
        ]);
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
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
    $table = $isAdminUser ? "admins" : "clinic_users";
    $sql = "INSERT INTO $table (name, email, password) VALUES (?, ?, ?);";

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
function isCorrectAdminCode($adminCode)
{
    $storedHash = fetchAdminCode();

    if ($storedHash !== false) {
        return password_verify($adminCode, $storedHash);
    }

    return false;
}


function fetchAdminCode()
{
    global $conn;
    $sql = "SELECT admin_code FROM admin_codes ORDER BY create_date DESC LIMIT 1";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Error during registration.',
        ]);
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


// function to check if username exists in db
function ExistUser($email)
{
    $adminRow = isExistEmail($email, true, false);
    if ($adminRow !== false) {
        return ['role' => 'admin', 'email' => $adminRow['email']];
    }

    $userRow = isExistEmail($email, false, false);
    if ($userRow !== false) {
        return ['role' => 'user', 'email' => $userRow['email'], 'user_id' => $userRow['user_id']];
    }

    return [];
}


// Function to check if password is correct
function isCorrectPassword($pwd, $username, $isAdminUser)
{
    $fetchedPassword = fetchPassword($username, $isAdminUser);
    if ($fetchedPassword !== false) {
        return password_verify($pwd, $fetchedPassword);
    }

    return false;
}

function fetchPassword($username, $isAdminUser)
{
    global $conn;
    $sql = "SELECT `password` FROM " . ($isAdminUser ? "admins" : "clinic_users") . " WHERE email = ?;";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Error during login.',
        ]);
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        mysqli_stmt_close($stmt);
        return $row['password'];
    } else {
        mysqli_stmt_close($stmt);
        return false;
    }
}

?>