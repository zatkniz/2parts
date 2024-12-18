$(document).ready(function () {
	$("li.dropdown.dropdown-user").on("click", function () {
		$(this).toggleClass("open");
	});

	
	$('span.current-day').text(moment().locale('el').format('dddd, D MMMM YYYY'));

	$('ul.page-sidebar-menu.page-header-fixed.page-sidebar-menu-light li').each(function () {
		if ($(this).find('a').attr('href') === window.location.href) {
			$(this).addClass('active open');
			$(this).find('a').append('<span class="selected"></span>');
			if ($(this).parent().parent().hasClass('has-sub-menu')) {
				$(this).parent().parent().find('a').trigger('click')
			}
		}
	})

	//Datepicker
	$('.input-daterange input').each(function () {
		$(this).datepicker({
			format: 'dd/mm/yyyy',
			orientation: 'bottom',
			language: 'el',
			todayHighlight: true,
			todayBtn: 'linked',
		});
	});

	$('#hiring-date').datepicker({
		format: 'dd/mm/yyyy',
		orientation: 'bottom',
		language: 'el',
		todayHighlight: true,
		todayBtn: 'linked',
	});

	$('#printDate').datepicker({
		format: 'mm/yyyy',
		orientation: 'bottom',
		language: 'el',
		viewMode: "months", 
		minViewMode: "months",
		todayHighlight: true,
		todayBtn: 'linked',
	});

	$('#firing-date').datepicker({
		format: 'dd/mm/yyyy',
		orientation: 'bottom',
		language: 'el',
		todayHighlight: true,
		todayBtn: 'linked',
	});

	setTimeout(function () {
		if (window.location.href.indexOf('from=') > -1) {
			var dateFrom = window.location.href.substr(window.location.href.indexOf('from=') + 5, 10).split('-');
			$('#dateFrom').val(dateFrom[2] + '/' + dateFrom[1] + '/' + dateFrom[0]);

			var dateTo = window.location.href.substr(window.location.href.indexOf('&to=') + 4, 10).split('-');
			if (parseInt(dateFrom[2]) + '/' + dateFrom[1] + '/' + dateFrom[0] != (parseInt(dateTo[2]) - 1) + '/' + dateTo[1] + '/' + dateTo[0]) {
				$('#dateTo').val((parseInt(dateTo[2]) - 1) + '/' + dateTo[1] + '/' + dateTo[0]);
			}
		}
	}, 200);

	$('button#dateFromBtn').click(
		function () {
			$('input#dateFrom').val('')
		})

	$('.remove').click(
		function () {
			$('select').select2('close');
		})

	$('button#dateToBtn').click(
		function () {
			$('input#dateTo').val('')
		}
	)

	$('input.select2-search__field').keypress(function (event) {
		setTimeout(function () {
			console.log($('input.select2-search__field').val().length)
		}, 50);

	})
	$('div#incomes-portlet').on('mouseover' , function(){$('[data-toggle="popover"]').popover();})
	$('#prints-select').select2();
})
