jQuery(document).ready(function($) {
    // Create a dialog
    var dialog = $('<div id="dialog" title="Shuffled cards"></div>').dialog({
        autoOpen: false,
        modal: true,
        width: 'auto',
        height: '500',
        show: {
            effect: "blind",
            duration: 1000
        },
        hide: {
            effect: "explode",
            duration: 1000
        }
    });

    $('#shuffle-button').on('click', function () {
        var pickedCardIds = $('.picked-card').map(function () {
            return $(this).data('id');
        }).get(); // This will create an array of picked card IDs

        console.log("Picked Card IDs: ", pickedCardIds); // Log the picked card IDs

        $.ajax({
            url: card_shuffle.ajax_url,
            type: 'post',
            data: {
                action: 'card_shuffle',
                picked_card_ids: pickedCardIds // Send picked card IDs with the request
            },
            beforeSend: function () {
                console.log("Sending request with data: ", pickedCardIds);
            },
            success: function (response) {
                console.log("Response: ", response); // Log the response

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

            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("AJAX error: ", textStatus, errorThrown); // Log AJAX error details
            }
        });
    });
	

});
