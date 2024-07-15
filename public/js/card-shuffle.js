jQuery(document).ready(function($) {
    // Create a dialog
    var dialog = $('<div id="dialog" title="Cards"></div>').dialog({
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
                picked_card_ids: pickedCardIds, // Send picked card IDs with the request
                                user_option: $('#user-option').val() // Include the selected option in the request

            },
            beforeSend: function () {
                console.log("Sending request with data: ", pickedCardIds);
            },
            success: function (response) {
                console.log("Response: ", response); // Log the response

                // Update the dialog with the response and open it
                dialog.html(response).dialog('open');
var btn = $('<div class="elementor-button-wrapper"><button id="email-button" class="btn hypnotic-btn elementor-button elementor-button-link elementor-size-sm"><span class="elementor-button-content-wrapper"><span class="elementor-button-text">Send to Email</span></span></button></div>');
        dialog.append(btn);
var emailSendingInProgress = false;

				// Inside the success callback of the shuffle button AJAX call
	btn.off('click').on('click', function() {

        var email = $('#user-email').val();
        var first_name = $('#first_name').val();
    // Simple email validation
    if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        alert('Please enter a valid email address.');
        return;
    }
  if (emailSendingInProgress) {
        return; // Exit the function if an email sending process is already in progress
    }
    emailSendingInProgress = true;

    var cardIds = [];
    $('.shuffled-card').each(function() {
        cardIds.push($(this).data('card-id'));
    });

    // Disable the button
    $(this).prop('disabled', true);

    $.ajax({
        url: card_shuffle.ajax_url,
        type: 'post',
        data: {
            action: 'send_cards_to_email',
            email: email, // replace with the actual email
            first_name: first_name,
            card_ids: cardIds, // Pass the card IDs to the backend
            user_option: $('#user-option').val() // Include the selected option in the request
        },
        success: function(response) {
            alert('Email sent!');
        },
        complete: function() {
        emailSendingInProgress = false;

            // Enable the button again
            btn.prop('disabled', false);
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
