/**
 * Part of asukademy project.
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

;(function($)
{
	"use strict";

	window.Invoice = window.Invoice || {
		init: function()
		{
			var self = this;

			$(document).ready(function()
			{
				self.input = $('#invoice-input');

				$('#invoiceModal').on('show.bs.modal', function ()
				{
					$('#invoice-input').focus();
				})
				.on('hidden.bs.modal', function ()
				{
					self.clear();
				});
			});
		},

		clear: function()
		{
			this.input.val('');
			this.url = null;
		},

		prepare: function(invoice, url)
		{
			this.url = url;
			this.input.val(invoice);
		}
	}
})(jQuery);
