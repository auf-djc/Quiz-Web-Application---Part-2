<?php
require "vendor/autoload.php";
use App\QuestionManager;
session_start();
$manager = new QuestionManager;

// Save results text to file
$content_name = 'Complete Name: ' . $_SESSION['user_fullname'];
$content_email = 'Email: ' . $_SESSION['email'];
$content_birthdate = 'Birthdate: ' . $_SESSION['birthdate'];
$content_score = 'Score: ' . $_SESSION['user_score'] . ' out of 10';
$content_userAnswers = "Answers:\n";

foreach ($_SESSION['answers'] as $number => $answer) {
    $isCorrect = ($answer == $manager->getAnswers()[$number]) ? "(correct)" : "(incorrect)";
    $content_userAnswers .= "$number. $answer $isCorrect\n";
}

$fileContent = $content_name . "\n" . $content_email . "\n" . $content_birthdate . "\n" . $content_score . "\n" . $content_userAnswers;
$fileName = "results.txt";

file_put_contents($fileName, $fileContent);

// Send file to user for download
header('Content-disposition: attachment; filename=results.txt');
header('Content-type: text/plain');
readfile('results.txt');
