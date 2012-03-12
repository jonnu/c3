/* Highclare */
Cufon.replace('.swiss-th, .page-content h1', { fontFamily: 'Swis721 Th BT' });
Cufon.replace('.swiss-lt, .box h2, .title, #slider a', { fontFamily: 'Swis721 Lt BT', hover: true });
Cufon.replace('.swiss-md, .page-content h1 strong', { fontFamily: 'Swis721 Md BT' })
Cufon.replace('.swiss-bd, .page-content h2', { fontFamily: 'Swis721 Bd BT' })

$(function() {
	
	// User-Friendly Search
	$('.search-box').focus(function() {
		
		if($(this).val() == 'Search') {
			$(this).val('');
		}
		
	}).blur(function() {
		
		if($(this).val() == '') {
			$(this).val('Search');
		}
		
	});
	
	// Page-Curl Effect
	$('#prospectus').fold({
		side: 'right',
		directory: '/skins/highclare/assets/images',
		turnImage: 'fold.png',
		maxHeight: 140,
		startingWidth: 80,
		startingHeight: 80,
		autoCurl: true
	});
	
	
	
	// Menu
	$('header nav > ul li').hover(function() {
		$(this).has('ul').addClass('selected');
	}, function() {
		$(this).removeClass('selected');
	});
	
	// Slider
	$('#gallery').nivoSlider({
		effect: 'random',
		slices: 15,
		boxCols: 8,
		boxRows: 4,
		animSpeed: 1000,
		pauseTime: 8000,
		startSlide: 0,
		directionNav: false,
		directionNavHide: true,
		controlNav: false,
		controlNavThumbs: false,
		controlNavThumbsFromRel: false,
		controlNavThumbsSearch: '.jpg',
		controlNavThumbsReplace: '_thumb.jpg',
		keyboardNav: false,
		pauseOnHover: true,
		manualAdvance: false,
		captionOpacity: 0.8,
		prevText: 'Prev',
		nextText: 'Next',
		randomStart: false,
		beforeChange: function() {
			
			// Slider disappears
			$('#slider ul').stop().animate({ left: '-284px' }, 250);
			
			data = $(this).data('nivo:vars');
			
		},
		afterChange: function() {
			
			// Slider re-appears
			$('#slider ul').stop().animate({ left: 0 }, 250);
			
			data = $(this).data('nivo:vars');
			
			$('#slider ul').attr('class', $(data.currentImage[0]).data('tab'));
		},
		slideshowEnd: function() {},
		lastSlide: function() {},
		afterLoad: function() {}
	});
	
	
	pageCurlWaggle = function() {
		obj = $('#turn_object');
		obj.animate({ width: 100, height: 100 }, 1500, 'easeOutCubic').delay(500).animate({ width: 80, height: 80 }, 750, 'easeInCubic', function() {
			pageCurlWaggle();
		});
	}
	
	$('#turn_object').hover(function() {
		$(this).stop(true, true);
	});
	
	pageCurlWaggle();
});