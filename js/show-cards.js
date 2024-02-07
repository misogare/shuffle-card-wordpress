jQuery(document).ready(function ($) {
    $('.card1').click(function () {
        var clickedIndex = parseInt($(this).css('--i'), 10); // Get the current index
        $('.card1').each(function () {
            var currentIndex = parseInt($(this).css('--i'), 10);
            if (currentIndex > clickedIndex) {
                $(this).css('--i', currentIndex - 1);
            }
        }); 
        $(this).css('--i', $('.card1').length - 1); // Move clicked card to the front
    });
    $('.card1').hover(function () {
    var $this = $(this); // Store the hovered card
    $this.css('transform', 'translateX(calc(var(--i) * 20px)) translateY(calc(var(--i) * -10px)) rotateY(0deg) translateZ(100px)'); // Flip the card
    setTimeout(function () {
        $this.css('transform', 'translateX(calc(var(--i) * 15px)) translateY(calc(var(--i) * -5px)) rotateY(180deg)'); // Flip the card back after 5s
    }, 5000); // Set timeout to 5s
});


    var clickedcards2 = {}; // Object to keep track of clicked cards

    // Use event delegation for dynamically added .card1 elements
    $('#cards-display').on('click', '.card1', function () {
        var card_id = $(this).data('id');
        console.log('Card ID: ' + card_id); // Log the card ID

        // If the card has not been clicked before
        if (!clickedcards2[card_id]) {
            clickedcards2[card_id] = true;

            $.ajax({
                url: ajax_object.ajax_url, // Make sure ajax_object.ajax_url is defined
                type: 'POST',
                data: {
                    action: 'picked_card',
                    card_id: card_id
                },
                success: function (response) {
                    console.log('Response: ' + response); // Log the response

                    // Check if the card is already in the picked cards container
                    if ($('.picked-cards-container .card[data-id="' + card_id + '"]').length === 0) {
                        // If not, append the new card
                        $('.picked-cards-container').append(response);

                    } else {
                        console.log('Card ' + card_id + ' is already picked.');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('AJAX error: ' + textStatus + ' : ' + errorThrown); // Log any AJAX error
                }
            });
        } else {
            console.log('Card ' + card_id + ' has already been clicked.'); // Log that the card has already been clicked
        }
    });
    var $dialog = $('<div></div>')
        .html('You must be admin to use this button  <br><br> <button onclick="closeDialog()">Close</button>')
        .dialog({
            autoOpen: false,
            modal: true,
            title: 'premisson required',
            width: 'auto'
        });
    function openDialog() {
        $dialog.dialog('open');
    }
    window.closeDialog = function () {
        $dialog.dialog('close');
    }
    if (ajax_object.is_user_logged_in !== 'yes' && ajax_object.is_admin !== 'yes') {
        $('#show-cards').click(function (e) {
            e.preventDefault(); // Prevent any default button action
            openDialog(); // Open the dialog instead of redirecting
        });
    }
    else {
        $('#show-cards').click(function () {
            $.ajax({
                url: ajax_object.ajax_url, // ajaxurl is a variable automatically provided by WordPress
                type: 'POST',
                data: {
                    action: 'display_cards_in_sets_ajax',
                },
                success: function (response) {
                    $('#cards-display').html(response);

                    // After cards are displayed, add click event for the shining effect
                    $('.card-set').click(function () {
                        // Remove the shining effect from all sets
                        $('.card-set').removeClass('shining-effect');

                        // Apply the shining effect to the clicked set
                        $(this).addClass('shining-effect');
                    });
                }
            });
        });
    }
    $('.picked-cards-container').on('click', '.remove-card', function () {
        var card_id = $(this).parent().data('id'); // Get the card ID
        delete clickedcards2[card_id]; // Remove the card from clickedcards
        $(this).parent().remove(); // Remove the card from the DOM
        console.log('Card ' + card_id + ' has been removed.'); // Log that the card has been removed
    });
});
