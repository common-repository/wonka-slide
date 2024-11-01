( function() {
'use strict'

	var slider, controls, indicators, imgs,
	resize_time, slide_time, current_indicator,
	prev_indicator, next_indicator, selected_indicator,
	first_indicator, last_indicator, el, prev_el,
	next_el, selected_el, first_el, last_el;

	
	window.onload = function () {
		if ( document.getElementById( 'wonka-slider-main' ) ) {
			slider = document.getElementById( 'wonka-slider-main' );
			set_wonka_slide_height();
			start_interval(4000);
			if ( document.getElementsByClassName( 'slide-control' ).length ) { set_controls(); }
			if ( document.getElementsByClassName( 'wonka-slide-indicators-item' ).length ) { set_indicators(); }
			slider.onmouseover = function () { clearInterval(slide_time); };
			slider.onmouseleave = function () { start_interval(2000); };
		}
	};
		
	window.onresize = function () {
		if ( document.getElementById( 'wonka-slider-main' ) ) {
			clearTimeout( resize_time );
			resize_time = setTimeout( function () { set_wonka_slide_height(); }, 2000 );
		}
	}


	// This is for the slide setup
	function slide_interval(direction) {
		clearInterval( slide_time );
		direction = (( direction ) ? direction: 'next');
		selected_indicator = document.getElementById('slide-indicator-' + direction );
		selected_el = document.getElementById('slide-' + direction );
		var slider_items = document.getElementsByClassName( 'wonka-slider-item' );
		for (var i = 0; i < slider_items.length; i++) {
				var n = i + 1, p = i - 1, last = slider_items.length - 1;
				current_indicator = document.getElementById( 'slide-indicator-' + n );
				prev_indicator = document.getElementById( 'slide-indicator-' + (n - 1) );
				next_indicator = document.getElementById( 'slide-indicator-' + (n + 1) );
				first_indicator = document.getElementById( 'slide-indicator-' + 1 );
				last_indicator = document.getElementById( 'slide-indicator-' + slider_items.length );
				el = slider_items[i];
				prev_el = slider_items[p];
				next_el = slider_items[n];
				first_el = slider_items[0];
				last_el = slider_items[last];
			if ( i == slider_items.length-1 && el.classList.contains( 'active' ) && direction == 'next' ) {
				wonka_queue( el, first_el, current_indicator, first_indicator, direction, 150 );
				break;
			} else if ( el.classList.contains( 'active' ) && direction == 'next' ) {
				wonka_queue( el, next_el, current_indicator, next_indicator, direction, 150 );
				break;
			}
			if ( i == 0 && el.classList.contains( 'active' ) && direction == 'prev' ) {
				wonka_queue( el, last_el, current_indicator, last_indicator, direction, 150 );
				break;
			} else if ( el.classList.contains( 'active' ) && direction == 'prev' ) {
				wonka_queue( el, prev_el, current_indicator, prev_indicator, direction, 150 );
				break;
			}
			if ( el.classList.contains( 'active' ) && !isNaN( direction ) && el.getAttribute( 'data-slide' ) < direction ) {
				direction = 'next';
				wonka_queue( el, selected_el, current_indicator, selected_indicator, direction, 150 );
				break;
			} else if ( el.classList.contains( 'active' ) && !isNaN( direction ) && el.getAttribute( 'data-slide' ) > direction ) {
				direction = 'prev';
				wonka_queue( el, selected_el, current_indicator, selected_indicator, direction, 150 );
				break;
			}
		}
	}

	// Slide action
	function wonka_queue( cur_el, x_el, cur_ind, x_ind, direction, time ) {
		var moving = (( direction === 'next' ) ? 'left': 'right');
		var from = (( direction === 'next' ) ? 'right': 'left');
		setTimeout( function(){
			cur_el.classList.add( moving + '-slide-out' ); 
			cur_el.classList.remove( 'active' ); 
			if ( from === 'right' ) {
				cur_el.style.right = '0%';
			} else {
				cur_el.style.left = '0%';
			}
			setTimeout( function(){
				if ( from === 'right' ) { cur_el.style.right = '105%'; } else { cur_el.style.left = '105%'; }
				if ( cur_ind != null ) { cur_ind.classList.remove( 'active-indicator' ); }
					setTimeout(function(){
						cur_el.classList.remove( moving + '-slide-out' ); 
						x_el.classList.add( from + '-slide-in' );
						if ( moving === 'left' ) { x_el.style.left = '105%'; } else { x_el.style.right = '105%'; }
						setTimeout(function(){
							if ( moving === 'left' ) { x_el.style.left = '0%'; } else { x_el.style.right = '0%'; }
							if ( x_ind != null ) { x_ind.classList.add( 'active-indicator' ); }
							setTimeout( function(){
								x_el.classList.remove( from + '-slide-in' ); 
								x_el.classList.add( 'active' ); 
								setTimeout( function(){
									cur_el.removeAttribute( 'style' ); 
									x_el.removeAttribute( 'style' );
									setTimeout( function(){
										clearInterval( slide_time );
										start_interval(4000);
									}, time);
								}, time);
							}, time);	
						}, time);
					}, time);
			}, time);
		}, time);

	}

	function start_interval(time) {
		clearInterval( slide_time );
		slide_time = setInterval( slide_interval, time );
	}

	function set_controls() {
		controls = document.getElementsByClassName( 'slide-control' );
		for (var i = 0; i < controls.length; i++) {
			controls[i].addEventListener( 'click', function() {
			slide_interval( this.getAttribute( 'data-direction' ) );
		});
		}
	}

	function set_indicators() {
		indicators = document.getElementsByClassName( 'wonka-slide-indicators-item' );
		for (var i = 0; i < indicators.length; i++) {
			indicators[i].addEventListener( 'click', function() {
				slide_interval( this.getAttribute( 'data-slide-indicator' ) );
			});
		}
	}

	function set_wonka_slide_height() {
		imgs = document.getElementsByClassName( 'wonka-slide-img' );
		var img_height = 0;
		for (var i = 0; i < imgs.length; i++) {
			if ( i == 0 && imgs[i].height > img_height ) {
				img_height = imgs[i].height;
			}
			if ( img_height > imgs[i].height && i != 0 ) {
				img_height = imgs[i].height;
			}
		}
		slider.style.height = img_height + 'px';
	}

})();