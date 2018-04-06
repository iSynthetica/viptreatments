;(function($){
    $(document).ready(function(){
        $('.et_pb_toggle_title').click( function(){
            //var parentWrapper = $(this).parent('.child-service-wrapper');
            var parrentWrapperId = $(this).attr('data-id');
            console.log(parrentWrapperId);

            $('.child-prod-data-wrapper').fadeOut();
            setTimeout(function() {
                $('#child-prod-'+parrentWrapperId+'-data').fadeIn();
            }, 500);
        });
    });
})(jQuery);/**
 * Created by Vlad on 09.08.2016.
 */
