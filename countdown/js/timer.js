(function($) {
	$.fn.timer = function(options) {
		// Default options
		var defaultOptions = {
			animation:			"none",
			day1Selector:		"#d1",
			day2Selector:		"#d2",
			hour1Selector:		"#h1",
			hour2Selector:		"#h2",
			minute1Selector:	"#m1",
			minute2Selector:	"#m2",
			second1Selector:	"#s1",
			second2Selector:	"#s2",
			daysColor:			"blue",
			hoursColor:			"pink",
			minutesColor:		"green",
			secondsColor:		"orange"
		};
		options = $.extend(defaultOptions, options);
		
		// Assign timer animation class
		$(this).addClass(options.animation);
		
		// Start the ticking process
		options.firstRun = true;
		$(this).attr('data-time', Math.round((options.target.getTime() - (new Date()).getTime()) / 1000)).timerTick(options);
	};
	
	$.fn.timerTick = function(options) {
		var obj		= $(this);
		
		// Get current time
		var oTime	= parseInt(obj.attr('data-time'));
		var cTime	= Math.round((options.target.getTime() - (new Date()).getTime()) / 1000);
		
		// Compare current time & timer time & update only then
		if (cTime < oTime && cTime >= 0) {
			// Split date into useful values
			var od	= Math.floor(oTime / 86400);
			var od1	= Math.floor(od / 10);
			var od2	= od % 10;
			var oh	= Math.floor((oTime - od * 86400) / 3600);
			var oh1	= Math.floor(oh / 10);
			var oh2	= oh % 10;
			var om	= Math.floor((oTime - od * 86400 - oh * 3600) / 60);
			var om1	= Math.floor(om / 10);
			var om2	= om % 10;
			var os	= oTime - od * 86400 - oh * 3600 - om * 60;
			var os1	= Math.floor(os / 10);
			var os2	= os % 10;
			var cd	= Math.floor(cTime / 86400);
			var cd1	= Math.floor(cd / 10);
			var cd2	= cd % 10;
			var ch	= Math.floor((cTime - cd * 86400) / 3600);
			var ch1	= Math.floor(ch / 10);
			var ch2	= ch % 10;
			var cm	= Math.floor((cTime - cd * 86400 - ch * 3600) / 60);
			var cm1	= Math.floor(cm / 10);
			var cm2	= cm % 10;
			var cs	= cTime - cd * 86400 - ch * 3600 - cm * 60;
			var cs1	= Math.floor(cs / 10);
			var cs2	= cs % 10;
			
			// Update timer images
			if (od1 != cd1 || options.firstRun) {
				$(options.day1Selector)
					.find('img.old').remove().end()
					.find('img.new').removeClass('new').addClass('old').end()
					.append('<img src="./images/number-' + options.daysColor + '-' + cd1 + '.png" alt="" />');
				setTimeout(function() {
					$(options.day1Selector).find('img:last-child').addClass('new');
				}, 10);
			}
			if (od2 != cd2 || options.firstRun) {
				$(options.day2Selector)
					.find('img.old').remove().end()
					.find('img.new').removeClass('new').addClass('old').end()
					.append('<img src="./images/number-' + options.daysColor + '-' + cd2 + '.png" alt="" />');
				setTimeout(function() {
					$(options.day2Selector).find('img:last-child').addClass('new');
				}, 10);
			}
			if (oh1 != ch1 || options.firstRun) {
				$(options.hour1Selector)
					.find('img.old').remove().end()
					.find('img.new').removeClass('new').addClass('old').end()
					.append('<img src="./images/number-' + options.hoursColor + '-' + ch1 + '.png" alt="" />');
				setTimeout(function() {
					$(options.hour1Selector).find('img:last-child').addClass('new');
				}, 10);
			}
			if (oh2 != ch2 || options.firstRun) {
				$(options.hour2Selector)
					.find('img.old').remove().end()
					.find('img.new').removeClass('new').addClass('old').end()
					.append('<img src="./images/number-' + options.hoursColor + '-' + ch2 + '.png" alt="" />');
				setTimeout(function() {
					$(options.hour2Selector).find('img:last-child').addClass('new');
				}, 10);
			}
			if (om1 != cm1 || options.firstRun) {
				$(options.minute1Selector)
					.find('img.old').remove().end()
					.find('img.new').removeClass('new').addClass('old').end()
					.append('<img src="./images/number-' + options.minutesColor + '-' + cm1 + '.png" alt="" />');
				setTimeout(function() {
					$(options.minute1Selector).find('img:last-child').addClass('new');
				}, 10);
			}
			if (om2 != cm2 || options.firstRun) {
				$(options.minute2Selector)
					.find('img.old').remove().end()
					.find('img.new').removeClass('new').addClass('old').end()
					.append('<img src="./images/number-' + options.minutesColor + '-' + cm2 + '.png" alt="" />');
				setTimeout(function() {
					$(options.minute2Selector).find('img:last-child').addClass('new');
				}, 10);
			}
			if (os1 != cs1 || options.firstRun) {
				$(options.second1Selector)
					.find('img.old').remove().end()
					.find('img.new').removeClass('new').addClass('old').end()
					.append('<img src="./images/number-' + options.secondsColor + '-' + cs1 + '.png" alt="" />');
				setTimeout(function() {
					$(options.second1Selector).find('img:last-child').addClass('new');
				}, 10);
			}
			if (os2 != cs2 || options.firstRun) {
				$(options.second2Selector)
					.find('img.old').remove().end()
					.find('img.new').removeClass('new').addClass('old').end()
					.append('<img src="./images/number-' + options.secondsColor + '-' + cs2 + '.png" alt="" />');
				setTimeout(function() {
					$(options.second2Selector).find('img:last-child').addClass('new');
				}, 10);
			}
			
			// Update timer time
			obj.attr('data-time', cTime);
			options.firstRun = false;
		}
		
		// Callback
		setTimeout(function() { obj.timerTick(options); }, 50);
	};
})(jQuery);
