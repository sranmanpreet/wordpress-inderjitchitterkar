jQuery(function($) {

    // Variable type options are valid for variable workshop.
    $('.show_if_variable:not(.hide_if_exclusive_for_you)').addClass('show_if_exclusive_for_you');

    // Trigger change
    $('select#product-type').change();

    // Show variable type options when new attribute is added.
    $(document.body).on('woocommerce_added_attribute', function(e) {

        $('#product_attributes .show_if_variable:not(.hide_if_exclusive_for_you)').addClass('show_if_exclusive_for_you');

        var $attributes = $('#product_attributes').find('.woocommerce_attribute');

        if ('exclusive_for_you' == $('select#product-type').val()) {
            $attributes.find('.enable_variation').show();
        }
    });

    // Show variable type options when product type is changed.
    $(document.body).on('woocommerce-product-type-change', function(e) {

        $('#product_attributes .show_if_variable:not(.hide_if_exclusive_for_you)').addClass('show_if_exclusive_for_you');

        var $attributes = $('#product_attributes').find('.woocommerce_attribute');

        if ('exclusive_for_you' == $('select#product-type').val()) {
            $attributes.find('.enable_variation').show();
        }
    });

});