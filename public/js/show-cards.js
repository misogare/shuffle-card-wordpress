jQuery(document).ready(function ($) {

    // Function to initialize the carousel for each set
    function initCarousel() {
        $('.card-set').each(function () {
            var $set = $(this);
            var $cards = $set.find('.card1');
            var currentIndex = 0; // Start with the first card

            // Adjust visibility based on screen size
            adjustCardVisibility($cards, currentIndex);

            // Next button click handler
            $set.siblings('.card-navigation-buttons').find('.next-button').click(function () {
                if (currentIndex < $cards.length - 1) {
                    currentIndex++;
                } else {
                    currentIndex = 0;
                }
                adjustCardVisibility($cards, currentIndex);
            });

            // Prev button click handler
            $set.siblings('.card-navigation-buttons').find('.prev-button').click(function () {
                if (currentIndex > 0) {
                    currentIndex--;
                } else {
                    currentIndex = $cards.length - 1;
                }
                adjustCardVisibility($cards, currentIndex);
            });
        });
    }
    function adjustCardVisibility($cards, currentIndex) {
        if ($(window).width() > 600) {
            // On larger screens, show all cards
            $cards.show();
        } else {
            // On smaller screens, show only the current card
            $cards.hide().eq(currentIndex).show();
        }
    }
    function handleCardClick() {
        $('.card1').off('click').on('click', function () {
            if ($(window).width() <= 600) {
                var $card = $(this);
                var $front = $card.find('.front1');
                var $back = $card.find('.back1');

                console.log('Toggling card face...');
                // Toggle visibility of front and back on small screens
                $front.toggle();
                $back.toggle();
            } else {
                var clickedIndex = parseInt($(this).css('--i'), 10); // Get the current index
                $('.card1').each(function () {
                    var currentIndex = parseInt($(this).css('--i'), 10);
                    if (currentIndex > clickedIndex) {
                        $(this).css('--i', currentIndex - 1);
                    }
                });
                $(this).css('--i', $('.card1').length - 1); // Move clicked card to the front
            }
        });
    }

 var lastSelectedPileIndex = null; // Track the last selected pile
 var clickedcards2 = {}; // Object to keep track of clicked cards

 // Event handler for selecting a pile
$('body').on('click', '.select-pile', function () {
    var setIndex = $(this).data('set');

    if (lastSelectedPileIndex !== setIndex) {
        lastSelectedPileIndex = setIndex; // Update the last selected pile index
        clickedcards2 = {}; // Resetting the tracking object
        $('.card-set-container').removeClass('classified');

        // Fade out and hide the selected pile
        $('#set-' + setIndex).closest('.card-set-container').fadeOut('slow', function() {
            $(this).hide();
        });

        // Classify the other two piles
        $('.card-set-container').each(function (index) {
            if (index !== lastSelectedPileIndex) {
                $(this).addClass('classified');
            }
        });

        var cardIDs = [];
        $('#set-' + setIndex + ' .card1').each(function () {
            cardIDs.push($(this).data('id'));
        });

        $('.picked-cards-container').html('');

        // AJAX call remains the same
        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'picked_card',
                card_ids: cardIDs // Send the array of IDs
            },
            success: function (response) {
                console.log('Pile selected successfully.');
                $('.picked-cards-container').append(response);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('AJAX error: ' + textStatus + ' : ' + errorThrown);
            }
        });
    } else {
        console.log('This pile is already selected.');
    }
});

 $('#cards-display').on('click', '.classified .card1', function () {
     var card_id = $(this).data('id');
     console.log('Card ID: ' + card_id + ' from a classified pile.'); // Log the card ID

     // If the card has not been clicked before or is from a classified pile
     if (!clickedcards2[card_id]) {
         clickedcards2[card_id] = true;

         $.ajax({
             url: ajax_object.ajax_url,
             type: 'POST',
             data: {
                 action: 'picked_card',
                 card_id: card_id,
                 is_from_classified: true // Indicate it's from a classified pile
             },
             success: function (response) {
                 console.log('Response: ' + response); // Log the response
                 // Append to the second row/container for classified pile cards
                 $('.picked-cards-container-second-row').append(response);
             },
             error: function (jqXHR, textStatus, errorThrown) {
                 console.log('AJAX error: ' + textStatus + ' : ' + errorThrown); // Log any AJAX error
             }
         });
     } else {
         console.log('Card ' + card_id + ' has already been clicked.');
     }
 });

 // Use event delegation for dynamically added .card1 elements
 $('#cards-display').on('click', '.card1', function () {

     var card_id = $(this).data('id');
     var isFromClassifiedPile = $(this).closest('.card-set-container').hasClass('classified');
     var container = isFromClassifiedPile ? '.picked-cards-container-second-row' : '.picked-cards-container';
     console.log('Card ID: ' + card_id + '; From classified pile: ' + isFromClassifiedPile);

     // Check if the card is from the main pile or a classified pile
     // Note: This condition now allows adding cards from the main pile back to the container
     // by removing the check that prevented re-adding previously clicked cards from the main pile.
     clickedcards2[card_id] = true; // Mark card as clicked, regardless of its previous state


     // If the card has not been clicked before
     if (!clickedcards2[card_id]) {
         clickedcards2[card_id] = true;

         $.ajax({
             url: ajax_object.ajax_url,
             type: 'POST',
             data: {
                 action: 'picked_card',
                 card_id: card_id,
                 is_from_classified: isFromClassifiedPile // Indicate if it's from a classified pile
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
    if (ajax_object.is_user_logged_in === 'yes' && ajax_object.is_admin === 'yes') {
    $('#show-cards').click(function () {
	$('.card-set-container1').fadeOut();
        $.ajax({
            url: ajax_object.ajax_url,
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
} else {
    $('#show-cards').click(function (e) {
        e.preventDefault(); // Prevent any default button action
        openDialog(); // Open the dialog instead of redirecting
    });
}


     $('body').on('click', '.remove-card', function () {
     var card_id = $(this).parent().data('id'); // Get the card ID
     delete clickedcards2[card_id]; // Remove the card from clickedcards
     $(this).parent().remove(); // Remove the card from the DOM
     console.log('Card ' + card_id + ' has been removed.'); // Log that the card has been removed
 });
    $(document).ready(function () {
        console.log('Document is ready...');

        // Attach the click event handler to all cards
        $('.card1').on('click', handleCardClick);

        initCarousel(); // Initialize the carousel
    });

    // Optional: Reinitialize carousel on window resize if needed
    var resizeId;
    $(window).resize(function () {
        console.log('Window resized...');

        clearTimeout(resizeId);
        resizeId = setTimeout(function () {
            console.log('Reinitializing carousel after resize...');
            $('.card1').on('click', handleCardClick);
            initCarousel();
        }, 100); // Adjusted delay to avoid excessive calls
    });

    // Force a resize event trigger to ensure consistent initialization
    $(window).trigger('resize');
});