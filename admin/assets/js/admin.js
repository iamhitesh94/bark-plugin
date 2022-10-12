jQuery(document).on('click', '.service-meta-box .options-blocks .add-new-option a', function (e) {
    e.preventDefault();
    var ele = jQuery(this);
    var cloneEle = jQuery(this).closest(".options-blocks").find('.options .can-clone').last()
    var clone = cloneEle.clone();
    clone.find(".input-text").val('');
    clone.insertAfter(cloneEle);

    if (jQuery(this).closest(".options-blocks").find('.options .can-clone').length > 1) {
        jQuery(this).closest(".options-blocks").find('.options').addClass("multiple")
    }
})

jQuery(document).on('click', '.service-meta-box .options-blocks a.remove-options', function (e) {
    e.preventDefault();
    var parentOptions = jQuery(this).closest(".options");
    jQuery(this).closest(".can-clone").remove();
    if (parentOptions.find('.can-clone').length <= 1) {
        parentOptions.removeClass("multiple")
    }
});

jQuery(document).on('keyup', '.service-meta-box .options-blocks [name="options[]"]', function (e) {
    generate_options_select(jQuery(this).closest('.options'));
});

function generate_options_select(ele) {
    var options = '<option value="">Select option</option>';
    if (ele.find("[name='options[]']").length > 0) {
        ele.find("[name='options[]']").each(function () {
            var optionText = jQuery(this).val();
            console.log('===>'+optionText)
            if(optionText != ''){
                options = options + '<option>' + optionText + '</option>';
            }
        })
    }
    ele.closest(".options-blocks").find("select").html(options);
}