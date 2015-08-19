/*

  Custom js by Shaun Parkison @ brightmindedmedia.com

*/

(function($){

	$( document ).ready(function() {

		/**
		 *	Animation function
		 *
		 *	To use add 'animation' class and 'data-animation=' to desired div. When in view, velocity animation will be applied
		 * 	For list of animations, see: http://julian.com/research/velocity/
		 * 	Example: <div class="animation" data-animation="slideUpBigIn">
		 */
		$(function() {
			$('.animate').each(function() {
				// Only animate once, if want to call each time in view, change 'one' to 'bind'
				$(this).one('inview', function(event, isInView, visiblePartX, visiblePartY) {
  					if (isInView) {
  						// console.log($(this));
  						var animation = $(this).data("animation");
  						$(this).addClass('visible');
  						$(this).velocity('transition.' + animation, { stagger: 75 });
  					}// End isInView
				});
			});
		});
		// END Animation function


	}); // End doc ready function

})(jQuery);