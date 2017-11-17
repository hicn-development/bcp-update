(function ( $ ) {
	"use strict";

	$(function () {
		
	});

	$(document).ready(function( $ ){
		$('.post-row').masonry({
		  	itemSelector: '.grid-item',
		  	columnWidth: '.grid-item',
  			percentPosition: true
		});
	});

}(jQuery));