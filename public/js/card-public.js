jQuery(document).ready(function ($) {
      var numcards = 79; // The total number of cards
   var totalAngle = 360; // The total angle in degrees
   var angleStep = totalAngle / numcards; // The angle step for each card

   $('.card').each(function (index) {
       var rotationAngle = -180 + index * angleStep; // Calculate the rotation angle for this card
       $(this).css('animation', 'card_ani 0.7s ease-in-out forwards'); // Set the animation
       $(this).css('--rotate', rotationAngle + 'deg'); // Set the rotation angle as a CSS variable
       console.log('Card ' + (index + 1) + ': rotation angle = ' + rotationAngle);
   });

   function rotateCards(setIndex, direction) {
       var cardsInSet = $('.card-set').eq(setIndex).find('.card1');
       var angleIncrement = direction === 'next' ? -angleStep : angleStep;

       cardsInSet.each(function () {
           var currentRotation = parseInt($(this).css('--rotate'), 10);
           var newRotation = currentRotation + angleIncrement;
           $(this).css('--rotate', newRotation + 'deg');
       });
   }
   function applyRotationAngles() {
       $('.card').each(function (index) {
           var rotationAngle = -180 + index * angleStep;
           $(this).css('animation', 'card_ani 0.7s ease-in-out forwards');
           $(this).css('--rotate', rotationAngle + 'deg');
       });
   }

   $("#shuffle-cards-button").click(function () {
       
       $.ajax({
           url: ajax_object.ajax_url, // Ensure this is defined correctly
           type: "POST",
           data: {
               action: "shuffle_cards",
           },
           success: function (response) {
               console.log(response)
               $('[data-id="b4df76c"] .elementor-widget-container').html(response);
               applyRotationAngles(); // Call a function to reapply rotation angles to the new set of cards
           }

       });
   });

   // Event listener for "Next" button


   var clickedcards = {}; // Object to keep track of clicked cards
  
   $(document).on('click', '.cards-container .card', function () {
       var card_id = $(this).data('id');
       console.log('Card ID: ' + card_id); // Log the card ID
       var currentCardCount = $('.picked-cards-container .picked-card').length;

       // If there are already 3 cards, do not add more
       if (currentCardCount >= 3) {
           alert('You can only pick a maximum of 3 cards.');
           return; // Exit the function early
       }
       // If the card has not been clicked before
       if (!clickedcards[card_id]) {
           // Add the card_id to clickedcards
           clickedcards[card_id] = true;

           $.ajax({
               url: ajax_object.ajax_url,
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
        .html('You must be registered to use this feature. Please <a href="../register">register</a> or log in. <br><br> <button onclick="closeDialog()">Close</button>')
        .dialog({
            autoOpen: false,
            modal: true,
            title: 'Registration Required',
            width: 'auto'
        });

    // Function to open the dialog
    function openDialog() {
        $dialog.dialog('open');
    }

    // Function to close the dialog
    window.closeDialog = function () {
        $dialog.dialog('close');
    }
   $('#pick-seven-cards-button').click(function () {
    var num_cards = 3; // default number of cards
    console.log('Number of cards to pick: ' + num_cards); // Log the number of cards
    console.log('Sending AJAX request with num_cards: ' + num_cards); // Log the number of cards

    $.ajax({
        url: ajax_object.ajax_url,
        type: 'POST',
        data: {
            action: 'picked_card',
            'pick-seven-cards-button': true,
            'num_cards': num_cards
        },
        success: function (response) {
            console.log('AJAX success: ' + response); // Log the AJAX success response
            $('.picked-cards-container').html(response); // Replace the content with the new cards
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('AJAX error: ' + textStatus + ' : ' + errorThrown);
        }
    });
});

 


    // Delegate the click event handler to the remove buttons
    $('.picked-cards-container').on('click', '.remove-card', function () {
        var card_id = $(this).parent().data('id'); // Get the card ID
        delete clickedcards[card_id]; // Remove the card from clickedcards
        $(this).parent().remove(); // Remove the card from the DOM
        delete clickedcards[card_id]; // Also remove the card from clickedcards
        console.log('Card ' + card_id + ' has been removed.'); // Log that the card has been removed
    });

});
