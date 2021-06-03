<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../../../../favicon.ico">
		<title>Online Questionnaire</title>
		<!-- Bootstrap core CSS -->
		<link href="<?php echo base_url();?>public/assets/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Custom styles for this template -->
		<link href="<?php echo base_url();?>public/assets/vendor/bootstrap/docs/4.0/examples/navbar-fixed/navbar-top-fixed.css" rel="stylesheet">
		<link href="<?php echo base_url();?>public/assets/css/style.css" rel="stylesheet">
	</head>
	<body>
		<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
			<div class="container">
				<a class="navbar-brand" href="<?php echo base_url();?>">Online Test</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarCollapse">
					<ul class="navbar-nav mr-auto">
					</ul>
				</div>
			</div>
		</nav>
		<div class="container-fluid bg-light">
			<div class="row">
				<div class="col-12 col-sm-8 mx-auto" style="min-height: 75rem;">
					<div class="row">
						<section class="col-6">
							<h3 class="font-weight-bold text-dark">ONLINE TEST</h3>
						</section>
						<section class="col-6">
							<button class="btn btn-info btn-sm float-right mb-4" onclick="formReset('questionnaire-form');">Reset Form</button>
							<div class="clearfix"></div>
						</section>
					</div>

					<div class="accordion" id="accordion-questionnaire">
					<?php
					$attributes = array('class' => 'form', 'id' => 'questionnaire-form');
					echo form_open('question/store', $attributes);
					if ( !empty($questions) ) {
						$count = 1;
						foreach ($questions as $question) {
							$class = '';
							$hide_class = '';
							if ( !empty($question->parent_question_id) ) {
								$hide_class = 'd-none';
								$class = 'has_parent';
							}
					?>

							<div class="card mb-3 <?php echo $hide_class.' '.$class;?>" id="accordion-<?php echo $question->question_id;?>">
								<div class="card-header bg-dark" id="acc-heading-<?php echo $question->question_id;?>">
									<h2 class="mb-0">
									<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-<?php echo $question->question_id;?>" aria-expanded="true" aria-controls="collapse-<?php echo $question->question_id;?>">
										<h5 class="text-uppercase text-white card-header__title"><?php echo '<span>Q</span> - '. $question->question;?></h5>
									</button>
									</h2>
								</div>
								<div id="collapse-<?php echo $question->question_id;?>" class="collapse show" aria-labelledby="acc-heading-<?php echo $question->question_id;?>" data-parent="#accordion-questionnaire">
									<div class="card-body">

										<div class="form-group">
										<?php
										switch ($question->answer_type) {
											case 'text':
												$data = array(
											        'name'  => $question->answer_type,
											        'id'    => $question->question_id,
											        'class' => 'form-control'
												);
												echo form_input($data);
												break;
											case 'number':
												$data = array(
											        'type'  => 'number',
											        'name'  => $question->answer_type,
											        'id'    => $question->question_id,
											        'class' => 'form-control w-25'
												);
												echo form_input($data);
												break;
											case 'checkbox':
												$i = 0;
												foreach ($question->answer_options_array as $option) {
													echo '<div class="form-check">';
													$data = array(
												        'name'  => 'question-'.$question->question_id.'answer[]',
												        'id'    => 'question-'.$question->question_id.'answer-'.$i,
												        'class' => 'form-check-input',
												        'value'    => $option
													);
														echo form_checkbox($data);
														echo form_label($option, 'question-'.$question->question_id.'answer-'.$i, array('class' => 'form-check-label'));
													echo '</div>';
													$i++;
												}
												break;
											case 'dropdown':
												$options = array();
												foreach ($question->answer_options_array as $option) {
													$options[$option] = $option;
												}
												echo form_dropdown('Question', $options, '', array('class' => 'form-control w-25'));
												break;
											case 'radio':
												if ( !empty($question->child_questions) ) {
													$child_questions = explode('|', $question->child_questions);
												}
												$i = 0;
												foreach ($question->answer_options_array as $option) {
													$attr = '';
													if ( !empty($child_questions) ) {
														$attr = ' data-trigger="question-select" data-question="'.$child_questions[$i].'"';
													}
													echo '<div class="form-check">';
													$data = array(
												        'name'  => 'question-'.$question->question_id.'answer',
												        'id'    => 'question-'.$question->question_id.'answer-'.$i,
												        'class' => 'form-check-input',
												        'value'    => $option
													);
														echo form_radio($data, '', '', $attr);
														echo form_label($option, 'question-'.$question->question_id.'answer-'.$i, array('class' => 'form-check-label'));
													echo '</div>';
													$i++;
												}
												break;

											default:
												$data = array(
											        'name'  => $question->answer_type,
											        'id'    => $question->answer_type,
											        'class' => 'form-control'
												);
												echo form_input($data);
												break;
										}
										?>
										</div>

									</div>
								</div>
							</div>

					<?php
						$count++;
						}
					}
					echo form_close();
					?>
					</div>

				</div>
			</div>
		</div>
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
		<script src="<?php echo base_url();?>public/assets/vendor/jquery/jquery-3.6.0.min.js"></script>
		<script>window.jQuery || document.write('<script src="<?php echo base_url();?>public/assets/vendor/bootstrap/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
		<script src="<?php echo base_url();?>public/assets/vendor/bootstrap/assets/js/vendor/popper.min.js"></script>
		<script src="<?php echo base_url();?>public/assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>public/assets/js/main.js"></script>
	</body>
</html>