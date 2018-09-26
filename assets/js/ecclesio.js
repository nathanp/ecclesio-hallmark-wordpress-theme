/*
 * Replace all SVG images with inline SVG so we can manipulate via CSS
 */
jQuery(function() {
  jQuery("img.svg").each(function() {
    var $img = jQuery(this);
    var imgID = $img.attr("id");
    var imgClass = $img.attr("class");
    var imgURL = $img.attr("src");

    jQuery.get(
      imgURL,
      function(data) {
        // Get the SVG tag, ignore the rest
        var $svg = jQuery(data).find("svg");

        // Add replaced image's ID to the new SVG
        if (typeof imgID !== "undefined") {
          $svg = $svg.attr("id", imgID);
        }
        // Add replaced image's classes to the new SVG
        if (typeof imgClass !== "undefined") {
          $svg = $svg.attr("class", imgClass + " replaced-svg");
        }

        // Remove any invalid XML tags as per http://validator.w3.org
        $svg = $svg.removeAttr("xmlns:a");

        // Check if the viewport is set, else we gonna set it if we can.
        if (
          !$svg.attr("viewBox") &&
          $svg.attr("height") &&
          $svg.attr("width")
        ) {
          $svg.attr(
            "viewBox",
            "0 0 " + $svg.attr("height") + " " + $svg.attr("width")
          );
        }

        // Replace image with new SVG
        $img.replaceWith($svg);
      },
      "xml"
    );
  });

  /*
     * Style header on scroll
     */
  var $window = jQuery(window);
  var nav = jQuery(".header");
  $window.scroll(function() {
    if ($window.scrollTop() >= 300) {
      nav.addClass("scroll");
    } else {
      nav.removeClass("scroll");
    }
  });

  /*
  ** Hamburgers navigation
  **/
  var $hamburger = jQuery(".hamburger");
  var $offCanvasMenu = jQuery("#off-canvas");

  $hamburger.on("click", function(e) {
    $hamburger.toggleClass("is-active");
    $offCanvasMenu.toggleClass("is-open");
  });
  jQuery(".js-off-canvas-overlay").on("click", function(e) {
    $hamburger.toggleClass("is-active");
  });

  /*
  ** Timeline
  **/
  function isOnScreen(elem) {
    // if the element doesn't exist, abort
    if (elem.length == 0) {
      return;
    }
    var $window = jQuery(window);
    var viewport_top = $window.scrollTop();
    var viewport_height = $window.height();
    var viewport_bottom = viewport_top + viewport_height - 320;
    var $elem = jQuery(elem);
    var top = $elem.offset().top;
    var height = $elem.height();
    var bottom = top + height;

    return (
      (top >= viewport_top && top < viewport_bottom) ||
      (bottom > viewport_top && bottom <= viewport_bottom) ||
      (height > viewport_height &&
        top <= viewport_top &&
        bottom >= viewport_bottom)
    );
  }

  (function($) {
    $.fn.timeline = function() {
      var selectors = {
        id: $(this),
        item: $(this).find(".timeline-item"),
        activeClass: "timeline-item--active",
        img: ".timeline__img"
      };

      window.addEventListener("scroll", function(e) {
        selectors.item.each(function(i) {
          if (isOnScreen(jQuery($(this)))) {
            /* Pass element id/class you want to check */
            $(this).addClass(selectors.activeClass);
          } else {
            $(this).removeClass(selectors.activeClass);
          }
        });
      });
    };
  })(jQuery);

  //jQuery(".timeline-container").timeline();
});
