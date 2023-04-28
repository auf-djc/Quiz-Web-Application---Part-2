<?php

namespace App;

use App\Question;

class QuestionManager
{
    protected $question_bank;
    protected $answers;

    public function __construct()
    {
        $this->question_bank = [];
        $this->answers = [
            null,
            'c', //1
            'd', //2
            'a', //3
            'd', //4
            'c', //5
            'd', //6
            'c', //7
            'c', //8
            'c', //9
            'c' //10
        ];
    }

    public function initialize()
    {
        try {
            $questions_file = 'questions.json';
            $questions = file_get_contents($questions_file);
            $questions = json_decode($questions);

            foreach ($questions as $item) {
                $question = new Question(
                    $item->number,
                    $item->question,
                    $item->choices
                );
                array_push($this->question_bank, $question);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public function retrieveQuestion($number)
    {
        if ($number > count($this->question_bank)) {
            return null;
        }

        if ($number < 0) {
            return null;
        }

        return $this->question_bank[$number - 1];
    }

    public function getQuestionSize()
    {
        return count($this->question_bank);
    }

    public function computeScore($answers)
    {
        $score = 0;

        foreach ($answers as $number => $answer) {
            if ($answer == $this->answers[$number]) {
                $score++;
            }
        }

        return $score;
    }

	/**
	 * @return mixed
	 */
	public function getAnswers() {
		return $this->answers;
	}
}