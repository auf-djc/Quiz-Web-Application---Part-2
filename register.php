<?php

require "vendor/autoload.php";

session_start();
// 2. Why do you think the session variable assignments are wrapped inside an if-else and try-catch statements?
// Before starting the quiz, the if-else and try-catch sections make sure that all necessary user data is present. 
// If the required data is submitted via $_POST, the if statement determines whether it is there and stores it in session variables. 
// An exception is thrown if the information is missing, and the try-catch block catches any exceptions and informs the user of the problem.

try {
    if (isset($_POST['fullname'])) {
        $_SESSION['user_fullname'] = $_POST['fullname'];
        //$_SESSION['user_gender'] = $_POST['gender'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['birthdate'] = $_POST['birthdate'];

        header('Location: quiz.php');
        exit;
    } else {
        throw new Exception('Missing the basic information.');
    }

} catch (Exception $e) {
    echo '<h1>An error occurred:</h1>';
    echo '<p>' . $e->getMessage() . '</p>';
}
