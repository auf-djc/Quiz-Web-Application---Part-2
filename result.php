<?php

require "vendor/autoload.php";

session_start();

// 4. In this code, it is used to resume the existing session so that data stored in the $_SESSION superglobal array can be accessed. 
// Data like "user_fullname," "email," "birthdate," and "answers" are among the items in the $_SESSION variable that are set using the superglobal $_SESSION. 
// The user's name, email address, score, and answers are then shown using these variables. 

use App\QuestionManager;

$score = null;

try {
    $manager = new QuestionManager;
    $manager->initialize();

    if (!isset($_SESSION['answers'])) {
        throw new Exception('Missing answers');
    }
    $_SESSION['user_score'] = $score = $manager->computeScore($_SESSION['answers']);
    
    $allAnswers = '';
    foreach ($_SESSION['answers'] as $index => $userAnswer) {
        $correctAnswers = $manager->getAnswers()[$index];
        $validation = ($userAnswer == $correctAnswers) ? '<span style="color:blue"> (correct) </span>' : '<span style="color:red"> (incorrect) </span>';
        $allAnswers .= '<li>' . $userAnswer . ' ' . $validation .'<br>' . '</li>' ;
        $_SESSION['all_answers'] = '<ol>' . $allAnswers . '</ol>';
    }



    
} catch (Exception $e) {
    echo '<h1>An error occurred:</h1>';
    echo '<p>' . $e->getMessage() . '</p>';
    exit;
}

?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz</title>
</head>

<body>

    <h1>Thank You!</h1>

    <p style="color: gray">
        You've completed the exam.
    </p>

    <h3>
        Congratulations
        <?php echo $_SESSION['user_fullname']; ?> 
        (<?php echo $_SESSION['email']; ?>) <br>
        Your score is
        <span style="color:blue"> <?php echo $score; ?> </span> out of
        <?php echo $manager->getQuestionSize(); ?> <br>
    </h3>

    <p>
        Your Answers
        <ol> 
            <?php echo $allAnswers; ?>
        </ol>
    </p>


    <button type="submit" onclick="window.location.href='download.php'">Click here to download the results.</button>


</body>



</html>




<!-- DEBUG MODE -->
<pre>
<?php
var_dump($_SESSION);
?>
</pre>

