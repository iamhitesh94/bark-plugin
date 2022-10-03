(function( $ ) {
	'use strict';
    var ajaxurl = bark_front_obj.ajaxurl;
    var ajax;
    $(document).ready(function(){
        $( ".bark-search-form" ).autocomplete({
            source: function( request, response ) {
                ajax = $.ajax( {
                  url: ajaxurl,
                  type: 'POST',
                  data: {
                    term: $('.bark-search-form input[name="term"]').val(),
                    'action': 'bark_get_service_suggestions',
                    'nounce': bark_front_obj.bark_service_suggections
                  },
                  success: function( data ) {
                    data = JSON.parse(data);
                    console.log(data)
                    response(data.suggections);
                  }
                } );
              },
              minLength: 2,
              select: function( event, ui ) {
              }
        }).autocomplete( "instance" )._renderItem = function( ul, item ) {
            return $( "<li data-service-id='"+item.image+"' data-service-img='"+item.image+"' >" )
                    .text(item.title)
                    .appendTo( ul );
        };
    })

    $('.bark-search-form input[name="term"]').keyup(function(e){
        e.preventDefault();
        var val = $(this).val();
        if(val.length <= 0){
            ajax.abort()
            jQuery('.ui-autocomplete.ui-front').html('').hide();
        }
    })

})( jQuery );