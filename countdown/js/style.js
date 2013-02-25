$(document).ready(function() {
	// Attach timer
	$('#timer').timer({
		animation: 'scale',
		target: new Date("March 25, 2013 00:00:00")
	});
	
	// Progress update (to support animation)
	$('.progress').each(function() {
		var bar = $(this).find('.bar');
		var tip = $(this).find('.tooltip');
		var per = parseInt(bar.attr('data-progress'));
		bar.width(per + '%');
		tip.css('margin-left', (3.4 * per) - 31);
		tip.bind('refresh', function() {
			tip.html(Math.round((parseInt(tip.css('margin-left')) + 31) * 100 / 340) + '%');
			setTimeout(function() { tip.trigger('refresh'); }, 25);
		}).trigger('refresh');
	});
});
