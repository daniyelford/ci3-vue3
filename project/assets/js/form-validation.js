$(function() {
	'use strict'
	$(document).ready(function() {
		$('.select2').select2({
			placeholder: 'انتخاب'
		});
		$('.select2-no-search').select2({
			minimumResultsForSearch: Infinity,
			placeholder: 'انتخاب'
		});
	});
	$('#selectForm').parsley();
	$('#selectForm2').parsley();
});