jQuery(document).ready(function ($) {
    var clickedCards = {}; // Object to keep track of clicked cards

    $('.card').click(function () {
        var card_id = $(this).data('id');
        console.log('Card ID: ' + card_id); // Log the card ID

        // Always add the card_id to clickedCards when a card is clicked
        clickedCards[card_id] = true;

        // If the card has not been clicked before
        if ($('.picked-card[data-id="' + card_id + '"]').length === 0) {
            $.ajax({
                url: ajax_object.ajax_url,
                type: 'POST',
                data: {
                    action: 'picked_card',
                    card_id: card_id
                },
                success: function (response) {
                    console.log('Response: ' + response); // Log the response
                    // Display the picked card
                    $('.picked-cards-container').append(response);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('AJAX error: ' + textStatus + ' : ' + errorThrown); // Log any AJAX error
                }
            });
        }
    });

    // Delegate the click event handler to the remove buttons
    $('.picked-cards-container').on('click', '.remove-card', function () {
        var card_id = $(this).parent().data('id'); // Get the card ID
        delete clickedCards[card_id]; // Remove the card from clickedCards
        $(this).parent().remove(); // Remove the card from the DOM
    });
});
