document.addEventListener('DOMContentLoaded', (event) => {
    // Open a new window
    // Handle button clicks
    var showCardsWindow = document.getElementById('show-cards-window');
    if (showCardsWindow) {
        showCardsWindow.addEventListener('click', function () {
     if (ajax_object.is_user_logged_in === 'yes' && ajax_object.is_admin === 'yes') {
            var newWindow = window.open('', 'Picked Cards', 'width=600,height=400');

            // Fetch the contents of your containers
            var mainContainerContent = document.querySelector('.picked-cards-container').innerHTML;
            var secondRowContainerContent = document.querySelector('.picked-cards-container-second-row').innerHTML;

            // Construct the HTML to display in the new window
            var newWindowContent = `
        <html>
            <head>
                <title>Picked Cards</title>
                <!-- Your existing styles... -->
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
           <style>
                    /* Add any styles you want for the new window here */
                    .picked-cards-container, .picked-cards-container-second-row {
                        display: flex;
                        overflow-x: auto;
                    }
                    /* Ensure cards are displayed correctly */
                    .card {
                        margin: 5px; /* Adjust based on your styling */
                    }
                    .picked-cards-container {
    display: flex !important;
    overflow-x: auto !important;
}

.picked-card {
    position: relative; /* Add this line */
}

.remove-card {
  display:none;
}
.picked-card .back {
    display: none;
}
#slot-container, #slot-container1 {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
#slot-container {
    margin-bottom: 20px; /* Adjust as needed */
        padding: 0 50px; /* Adjust as needed */

}
#slot-container1 {
    padding: 0 300px; /* Adjust as needed */
}
.card {
    position: relative;
    width: auto; /* Adjust based on your card size */
    height: auto; /* Adjust based on your card size */
}

.card-slot {
        position: relative; /* Add this line */

    width: auto; /* Adjust based on your card size */
    height: auto; /* Adjust based on your card size */
    border: 1px solid #000;
    margin: 5px;
    margin-bottom: 20px; /* Add some bottom margin to create space between the slots and the cards */
}
.remove-card1 {
    position: absolute;
    top: 0;
    right: 0;
    background: #fff;
    color: #000;
    border: none;
    cursor: pointer;
    z-index: 1;
    display: none;
}

                </style>
            </head>
            <body>
                <div class="picked-cards-container">${mainContainerContent}</div>
                <div class="picked-cards-container-second-row">${secondRowContainerContent}</div>
                <div id="slot-container">
               <div id="slot-1" class="card-slot"><button class="remove-card1">Remove</button></div>
<div id="slot-2" class="card-slot"><button class="remove-card1">Remove</button></div>
<div id="slot-3" class="card-slot"><button class="remove-card1">Remove</button></div>
                </div>
                  <div id="slot-container1">
               <div id="slot-4" class="card-slot"><button class="remove-card1">Remove</button></div>
<div id="slot-5" class="card-slot"><button class="remove-card1">Remove</button></div>
                    
                </div>

  <script>
                   // Initialize variables
var slotCounter1 = 1;
var slotCounter2 = 4;
var clickedcards1 = {};
var clickedcards2 = {};

$(document).on('click', '.picked-cards-container .picked-card', function () {
    var card = $(this); // Store a reference to the clicked card
    var card_id = card.data('id');
    var card_img = card.find('img').attr('src'); // Get the card's image URL

    // If the card is not already in a slot
    if (!clickedcards1[card_id]) {
        clickedcards1[card_id] = true;

        // Find an available slot
        var slotFound = false;
        for (var i = 1; i <= 3; i++) {
            if ($('#slot-' + i).children('img').length === 0) {
                // Update the available slot
                $('#slot-' + i).html('<img  class="card" src="' + card_img + '" alt="Card ' + card_id + '"><button class="remove-card1" style="display: block;">X</button>');
                slotFound = true;
                break;
            }
        }

        // If no available slot was found, replace the first slot
       if (!slotFound) {
    // Get the card that's about to be replaced
    var replacedCard = $('#slot-' + slotCounter1).children('img');
    var replacedCardId = replacedCard.attr('alt').split(' ')[1]; // Extract the card id from the alt attribute

    // Update the clickedcards1 or clickedcards2 object to reflect that the replaced card is no longer in a slot
    if (clickedcards1[replacedCardId]) {
        delete clickedcards1[replacedCardId];
    } else if (clickedcards2[replacedCardId]) {
        delete clickedcards2[replacedCardId];
    }

    // Replace the card in the slot
    $('#slot-' + slotCounter1).html('<img  class="card" src="' + card_img + '" alt="Card ' + card_id + '"><button class="remove-card1" style="display: block;">X</button>');
    slotCounter1++; // Increment the slot counter
    if (slotCounter1 > 3) {
        slotCounter1 = 1; // Reset the slot counter
    }
}
    }
});

// Handle card clicks in picked-cards-container-second-row
$(document).on('click', '.picked-cards-container-second-row .picked-card', function () {
    var card = $(this); // Store a reference to the clicked card
    var card_id = card.data('id');
    var card_img = card.find('img').attr('src'); // Get the card's image URL

    // If the card is not already in a slot
    if (!clickedcards2[card_id]) {
        clickedcards2[card_id] = true;

        // Find an available slot
        var slotFound = false;
        for (var i = 4; i <= 5; i++) {
            if ($('#slot-' + i).children('img').length === 0) {
                // Update the available slot
                $('#slot-' + i).html('<img class="card" src="' + card_img + '" alt="Card ' + card_id + '"><button class="remove-card1" style="display: block;">X</button>');
                slotFound = true;
                break;
            }
        }

        // If no available slot was found, replace the first slot
        if (!slotFound) {
              var replacedCard = $('#slot-' + slotCounter2).children('img');
    var replacedCardId = replacedCard.attr('alt').split(' ')[1]; // Extract the card id from the alt attribute

    // Update the clickedcards1 or clickedcards2 object to reflect that the replaced card is no longer in a slot
    if (clickedcards1[replacedCardId]) {
        delete clickedcards1[replacedCardId];
    } else if (clickedcards2[replacedCardId]) {
        delete clickedcards2[replacedCardId];
    }
            $('#slot-' + slotCounter2).html('<img  class="card" src="' + card_img + '" alt="Card ' + card_id + '"><button class="remove-card1" style="display: block;">X</button>');
            slotCounter2++; // Increment the slot counter
            if (slotCounter2 > 5) {
                slotCounter2 = 4; // Reset the slot counter
            }
        }
    }
});

$(document).on('click', '.remove-card1', function () {
    var card = $(this).siblings('img'); // Get the sibling img element of the clicked button
    var card_id = card.attr('alt').split(' ')[1]; // Extract the card id from the alt attribute

    // Remove the card from the clickedcards1 or clickedcards2 object
    if (clickedcards1[card_id]) {
        delete clickedcards1[card_id];
    } else if (clickedcards2[card_id]) {
        delete clickedcards2[card_id];
    }

    // Remove the card image and button from the slot
    $(this).parent().empty();
});


                </script>
            </body>
        </html>
    `;


            // Write the content to the new window
            newWindow.document.open();
            newWindow.document.write(newWindowContent);
            newWindow.document.close();

	}
	else{
	  showCardsWindow.style.display = 'none';

            // Show a message
                    alert("You are not allowed to view this content.");

	}
        });
    }
});