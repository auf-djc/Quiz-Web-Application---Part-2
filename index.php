<?php

require "vendor/autoload.php";

// 1. What does this function session_start() do to the application?
// It starts a session or resumes a current one based on a session identifier supplied via
// GET, POST, or passed via cookie.

session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
</head>
<body>

    <h1>Analogy Exam Registration</h1>
    <h3>Kindly register your basic information before starting the exam.</h3>

    <form method="POST" action="register.php">
        Enter your full name:<br />
        <input type="text" name="fullname" placeholder="Full Name" required />
        <br />
        
        Email:<br />
        <input type="email" name ="email" placeholder="Email" required />
        <br />

        Birthdate:<br />
        <input type="date" name ="birthdate" required />
        <br />

        <br />
        <input type="submit">
        <br />
    </form>

</body>
</html>

<!-- DEBUG MODE -->
<pre>
<?php
var_dump($_SESSION);
?>
</pre>
