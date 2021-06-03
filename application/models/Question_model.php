<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Question_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function get_questions($status='1') {
		$result_array = array();
		$this->db->select('question_id, question, answer_type, answer_options, child_questions, parent_question_id, readonly');
		$this->db->from('online_test');
		$this->db->where('status', $status);
		$this->db->order_by('question_id', 'ASC');
		$result_data = $this->db->get()->result();

		$i = 0;
		foreach ($result_data as $data) {
			$result_array[] = $data;

            $result_array[$i]->answer_options_array = '';
            if ( !empty($data->answer_options) ) {
                $answer_options_text = $data->answer_options;
                $answer_options = explode('|', $answer_options_text);
                $result_array[$i]->answer_options_array = $answer_options;
            }
			$i++;
		}

        return $result_array;
	}






}

