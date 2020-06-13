var $j = jQuery.noConflict();

var $productImageUpload = $j('input[name="wau_file_addon"]');
var $productImg = $j('img.wp-post-image');

$j(document).ready(function() {
    "use strict";
    // Drop down search
    renderPictureCart_ExclusiveForYouProduct();

});



function renderPictureCart_ExclusiveForYouProduct() {
    "use strict"

    var $productThumbnail = $j('td');
    var $productName = $j('td.product-name a');
    console.log($productName);

    console.log($j('.product-name a'));

    $j.each($productName, function(index, value) {
        console.log(index);
        console.log(value);
        if ("Exclusive For You" == value.text()) {
            alert(" i am here");
            $productThumbnail.hide();
        } else {
            alert("i am in else");
        }
    })


}