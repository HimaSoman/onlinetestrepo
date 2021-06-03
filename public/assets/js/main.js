$(function () {

	$(document).on('click', '[data-trigger="question-select"]:checked', function () {
		$(document).find('.has_parent').addClass('d-none');
		var child_question = $(this).data('question');
		var $targetEle = $('#accordion-'+child_question);
		$(document).find('#accordion-'+child_question).removeClass('d-none');
		$('html, body').animate({
		  scrollTop: $targetEle.offset().top
		}, 1000);
	});





});


function formReset(form_id) {
	$('form#'+form_id)[0].reset();
}