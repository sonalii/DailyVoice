

$('.vote-stats').on('click', '.voter', function (e) {
	e.preventDefault();

	var voter = $(this);

	if (voter.hasClass('disabled')) {
		console.log('already voted');
		return false;
	}

	voter.addClass('disabled');
	href = voter.attr('href');

	$.ajax({
		url: href,
		success: function(data) {
			//console.log('voted');
			$('.vote-stats').html(data);
		}
	});

});