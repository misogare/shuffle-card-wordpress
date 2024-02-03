jQuery(document).ready(function($) {
    // Create a dialog
    var dialog = $('<div id="dialog" title="Shuffled Cards"></div>').dialog({
        autoOpen: false,
        modal: true,
        width: 'auto',
        height: 'auto',
        show: {
            effect: "blind",
            duration: 1000
        },
        hide: {
            effect: "explode",
            duration: 1000
        }
    });

    $('#shuffle-button').on('click', function() {
        $.ajax({
            url: card_shuffle.ajax_url,
            type: 'post',
            data: { action: 'card_shuffle' },
            success: function(response) {
                // Update the dialog with the response and open it
                dialog.html(response).dialog('open');
				var btn = $('<button id="email-button">Send to Email</button>');
        dialog.append(btn);
				// Inside the success callback of the shuffle button AJAX call
			btn.on('click', function() {
				var email = $('#user-email').val();
                    // Simple email validation
                    if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                        alert('Please enter a valid email address.');
                        return;
                    }
			var cardIds = [];
			$('.shuffled-card').each(function() {
			cardIds.push($(this).data('card-id'));
			});

			$.ajax({
			url: card_shuffle.ajax_url,
			type: 'post',
			data: {
				action: 'send_cards_to_email',
				email: email, // replace with the actual email
				card_ids: cardIds // Pass the card IDs to the backend
			},
			success: function(response) {
				alert('Email sent!');
			}
			});
		});

            }
        });
    });
	

});
