// review error message
var errorContainer = $(".error_container"),
    errorButton = $('.error_button'),
    errorMessage = $('.error_message');

$(function(){
    errorButton.click(function(){
        errorContainer.fadeOut();
    });
});

$(window).on('load', function(){
    if (errorMessage.text().length > 0)
            errorContainer.fadeIn();
})