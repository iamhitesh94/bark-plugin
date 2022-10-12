(function( $ ) {
	'use strict';
    var ajaxurl = bark_front_obj.ajaxurl;
    var ajax;
    $(document).ready(function(){
        $( ".bark-search-form" ).autocomplete({
            classes: {
              "ui-autocomplete": "bark-suggestions",
            },
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
                var title = ui.item.title;
                var image = ui.item.image;
                var id    = ui.item.id;
                var types = ui.item.types;
                var ele   = $('.bark-search-form input[name="term"]');
                ele.closest('form').find('textarea[name="service-types"]').html('');
                if(types != undefined){
                  var keys = Object.keys(types);
                  var typesHtml = '';
                  if(keys.length > 0){
                    for (let index = 0; index < keys.length; index++) {
                      var key = keys[ index ];
                      var type = types[key];
                      typesHtml = typesHtml+'<div class="radio"><input type="radio" name="type" id="type-'+key+'" value="'+type+'"><label for="type-'+key+'">'+type+'</label></div>';

                      if((index + 1) == keys.length){
                        ele.closest('form').find('textarea[name="service-types"]').html(typesHtml);
                      }

                    }
                  }
                }

                ele.val(title);
                ele.closest('form').find('input[name="service-id"]').val(id);
                ele.closest('form').find('input[name="service-image"]').val(image);
                
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

    $("form.bark-search-form").submit(function(e){
      e.preventDefault();
      var id = $('input[name="service-id"]').val();
      if(id == ''){

      }else{
        var imageURl = $('input[name="service-image"]').val();
        var typesHtml = $('textarea[name="service-types"]').html();
        $("#bark-search-modal form input[name='service-id'] ").val(id);
        if(typesHtml != ''){
          var stepHtml = '<div><div class="step step-0 active"><div class="title">Project Type</div><div class="radios">'+typesHtml+'</div></div></div>';
          stepHtml = stepHtml.replaceAll("&lt;", "<");
          stepHtml = stepHtml.replaceAll("&gt;", ">");
          stepHtml = jQuery(stepHtml);
          $("#bark-search-modal .steps .step").removeClass('active');
          $("#bark-search-modal .steps").prepend(stepHtml.html());
        }
        $("#bark-search-modal .service-image").css({"background-image": "url('"+imageURl+"')"});
        $("#bark-search-modal").addClass("show-modal");
      }
      
    })
    

    $(document).on('click', '.bark-modal .continue-btn', function(e){
      e.preventDefault();
      $(".bark-modal input").removeClass('error');
      var activeStep = $('.bark-modal .steps .step.active');
      var nextStep = $('.bark-modal .steps .step.active').next();
      if( (activeStep.find("input[type='radio']").length > 0 && activeStep.find("input[type='radio']:checked").length <= 0) ){
        activeStep.find("input[type='radio']").addClass('error');
      }else if(activeStep.find("input[type='text']").length > 0 && activeStep.find("input[type='text']").val() == '' ){
        activeStep.find("input[type='text']").addClass('error');
      }else{
        activeStep.removeClass('active');
        nextStep.addClass('active');
        if(nextStep.is(':last-child')){
          nextStep.closest('.search-form').addClass('last-step-active');
        }
      }
    })

    $(document).on('click', '.bark-modal .bark-modal-header .bark-close-button', function(e){
      $(this).closest(".bark-modal").removeClass("show-modal")
    });

    $(document).on('submit', '#bark-search-form', function(e){
      e.preventDefault();
      var data = $(this).serialize();
      var ele = $(this);
      data = data+'&action=bark_filtered_service_providers';
      data = data+'&nounce='+bark_front_obj.bark_service_providers;
        ajax = $.ajax( {
          url: ajaxurl,
          type: 'POST',
          dataType: 'json',
          data: data,
          beforesend:function(){
            ele.find("input[type='submit']").val("Wait...")
          },
          complete:function(){
            ele.find("input[type='submit']").val("Submit")
          },
          success: function( data ) {
            if(!data.error){
              alert(data.msg);
              location.reload();
            }else{
              alert(data.msg);
            }
          }
        } );
    })


})( jQuery );