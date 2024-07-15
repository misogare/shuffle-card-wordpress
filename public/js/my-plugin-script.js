jQuery(document).ready(function ($) {
    // Function to show the selection modal
    function showSelectionModal() {
        $('#my-plugin-modal').show();
    }

    // Handle button click to trigger the modal
    $('#trigger-modal').on('click', function () {
        showSelectionModal();
    });

    // Use event delegation for the confirmation button click
    $(document).on('click', '#confirm-selection', function () {
        var userOption = $('#user-option').val();
        // Hide the modal after selection
        $('#my-plugin-modal').hide();

        $.ajax({
            url: myPluginParams.ajaxurl,
            type: 'POST',
            data: {
                action: 'load_content_based_on_selection',
                option: userOption,
            },
            success: function (response) {
                // Load the response into the page
                // You can process the response here as needed
            }
        });
    });
});
