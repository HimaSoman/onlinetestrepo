<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller {
	public function __construct() {
    	parent::__construct();
    	$this->load->model('Question_model');
  	}

	public function question_form()
	{
		$model_question = new Question_model;
		$data['questions'] = $model_question->get_questions();
				// echo '<pre>';
				// print_r($data['questions']);
				// exit;
		$this->load->view('question_form', $data);
	}
}
