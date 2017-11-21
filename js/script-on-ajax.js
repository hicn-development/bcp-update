(function ( $ ) {
	"use strict";

	var canBeLoaded = true,
		canBeMorePage = true,
	    bottomOffset = 1000;
	function MasonryStart(){
		var msnry = new Masonry('.post-row', {
			itemSelector: '.grid-item',
	  		columnWidth: '.grid-item',
			percentPosition: true,
			isInitLayout: false,
			hiddenStyle: {
		      transform: 'translateY(100px)',
		      opacity: 0
		    },
		    visibleStyle: {
		      transform: 'translateY(0px)',
		      opacity: 1
		    }
		});
		msnry._isLayoutInited = true;
		msnry.layout();
	}
	function BcpAjaxLoadmore(){
		var data = {
			'action': 'lmr',
			'query': mlp.posts,
			'page' : mlp.current_page
		};
 
		$.ajax({
			url : mlp.bcp_ajaxurl,
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				canBeLoaded = false;
			},
			success : function( data ){
				if( data ) { 
					$('#main').find('article:last-of-type').after( data );
					canBeLoaded = true;
					mlp.current_page++;
					if(mlp.current_page == mlp.max_page){
						canBeMorePage = false;
					}
				} else {
					canBeMorePage = false;
				}
			},
			complete : function(data){
				MasonryStart();
			}
		});
	}

	$(document).ready(function( $ ){
		MasonryStart();
		if(canBeMorePage){
			// on scrolling
			$(window).scroll(function(){
				if( $(document).scrollTop() > ( $(document).height() - bottomOffset ) && canBeLoaded == true ){
					BcpAjaxLoadmore();
				}
			});
			// eof on scrolling
		}
		
	});

}(jQuery));