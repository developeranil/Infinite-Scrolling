//Checking the element is in viewport
jQuery.fn.isInViewport = function() {
    var elementTop = jQuery(this).offset().top;
    var elementBottom = elementTop + jQuery(this).outerHeight();
    var viewportTop = jQuery(window).scrollTop();
    var viewportBottom = viewportTop + jQuery(window).height();
    return elementBottom > viewportTop && elementTop < viewportBottom;
};
// Run load content function while scroll
function windowOnScroll() {
       jQuery(window).on("scroll", function(e){
        if (jQuery('.blog-sidebar').isInViewport() == true){
            infinitScroll();
        }
    });
}
//Run main scroll function
function infinitScroll() {
    var count = 1;
    // End of the document reached?
    var noPost = jQuery('.w-100:last-child').find('.col-sm-12').attr('id');
    if (jQuery('.blog-sidebar').isInViewport() == true && noPost == undefined && count == 1) {
        jQuery(window).off('scroll');
        count = 2;
        var showed_posts = jQuery('.blog-page-item').length;
        jQuery('.loader').show();
        console.log('hello--'+ count);
        
		jQuery.ajax({    //create an ajax request to display.php
        type: "GET",
        data: 'p=' + showed_posts,
        url: "<?php bloginfo('template_url');?>/ajax-post2.php",
        dataType: "html",   //expect html to be returned
        success: function(response){
                jQuery("#responsecontainer").append(response);
                //var scroolTil = jQuery(".loaded_post_"+showed_posts).position().top;
                //scroolTil = scroolTil - 130;
                //jQuery("html, body").animate({ scrollTop: scroolTil }, 1500);
                jQuery('.loader').hide();
                windowOnScroll();
                return;
			}
		});
    }
};

//Start scroll event
jQuery(document).ready(function(){
    windowOnScroll();
});
