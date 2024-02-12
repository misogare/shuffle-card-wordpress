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