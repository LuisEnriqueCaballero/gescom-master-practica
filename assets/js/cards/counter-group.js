// -----------------------------------------------------------------------------
// Titles: Active Sessions, Add to cart, Newsletter Sign Ups, Total Revenue
// Location: index.html
// -----------------------------------------------------------------------------

(function(window, document, $, undefined) {
  "use strict";
  $(function() {
    $(".progress-active-sessions .progress-bar").animate({
      width: "100%"
    }, 400);
    $(".progress-add-to-cart .progress-bar").animate({
      width: "0%"
    }, 400);
    $(".progress-new-account .progress-bar").animate({
      width: "90%"
    }, 400);
    $(".progress-total-revenue .progress-bar").animate({
      width: "10%"
    }, 400);

  });

})(window, document, window.jQuery);
