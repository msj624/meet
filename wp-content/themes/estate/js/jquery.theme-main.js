/**
 * Main theme Javascript - (c) Greg Priday, freely distributable under the terms of the GPL 2.0 license.
 */
jQuery(function($){
    // Initialize the flex slider
    $('.flexslider').not('#home-page-slider .flexslider').flexslider({});

    // The home page slider works slightly differently
    $('#home-page-slider .flexslider').flexslider({
        before: function(args){
            // Remove the old text stuff
        },
        after: function(args){

        }
    });
    
    /* Setup fitvids for entry content and panels */
    $('.entry-content, .entry-content .panel' ).fitVids();
});