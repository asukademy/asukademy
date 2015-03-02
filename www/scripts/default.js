jQuery(document).ready(function($) {

	// Logo
	var logo = $('.home #big-logo.uk-navbar-brand img');

	if (logo) {
		logo.attr('src', 'media/img/asukademy-logo-horz-white.png');
	}

	// Logo
	var logo = $('.home #small-logo.uk-navbar-brand img');

	if (logo) {
		logo.attr('src', 'media/img/asukademy-logo-home.png');
	}

	// Table style
	var tables = $('table');

	tables.addClass('uk-table uk-table-striped');
});