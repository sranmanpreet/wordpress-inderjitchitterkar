var $j = jQuery.noConflict();

var $productImageUpload = $j('input[name="wau_file_addon"]');
var $productImg = $j('img.wp-post-image');

$j(document).ready(function() {
    "use strict";
    // Drop down search
    $productImageUpload.prop('required', true);
    renderPictureSingleProduct_ExclusiveForYouProduct();

});


function renderPictureSingleProduct_ExclusiveForYouProduct() {
    "use strict"

    $productImageUpload.change(function() {
        readURL(this);
    });

}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $productImg.attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}