(function ($) {

    "use strict";
    
    // Disable "Stretch Row" and "Stretch Row and Content"
    // on Row Options for Modals
    $('#wpb_visual_composer').ajaxComplete(function () {
        $('.wpb_vc_param_value.full_width .stretch_row').remove();
        $('.wpb_vc_param_value.full_width .stretch_row_content').remove();
        //console.log('VC Editor opened and Values removed');
    });

})(jQuery);






