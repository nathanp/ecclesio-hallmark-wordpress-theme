(function($) {
  // Selective refresh on Church Info
  wp.customize("ecclesio_part_church_phone", function(value) {
    value.bind(function(to) {
      jQuery(".ecclesio-part-phone").html(to);
    });
  }); //wp.customize
  wp.customize("ecclesio_part_church_services_heading", function(value) {
    value.bind(function(to) {
      jQuery(".ecclesio-part-services-heading").html(to);
    });
  }); //wp.customize
  wp.customize("ecclesio_part_church_service_times", function(value) {
    value.bind(function(to) {
      jQuery(".ecclesio-part-service-times").html(to);
    });
  }); //wp.customize

  //Selective refresh on Footer
  wp.customize("ecclesio_part_church_footer_cta_text", function(value) {
    value.bind(function(to) {
      jQuery(".ecclesio-part-cta-text").html(to);
    });
  }); //wp.customize

  // function to convert hex to rgb
  function hexToRGB(hex, alpha) {
    var r = parseInt(hex.slice(1, 3), 16),
      g = parseInt(hex.slice(3, 5), 16),
      b = parseInt(hex.slice(5, 7), 16);
    if (alpha) {
      return "rgba(" + r + ", " + g + ", " + b + ", " + alpha + ")";
    } else {
      return "rgb(" + r + ", " + g + ", " + b + ")";
    }
  } //hexToRGB

  // BRAND COLOR - PRIMARY
  // Selective refresh the site's main color
  wp.customize("ecclesio_color_main", function(value) {
    value.bind(function(to) {
      // Background color
      var color_main_bg =
        '.off-canvas, .footer-top, input[type="submit"], button.hamburger .hamburger-inner, button.hamburger .hamburger-inner:after, button.hamburger .hamburger-inner:before, button.hamburger .hamburger-inner:hover .hamburger-inner, button.hamburger .hamburger-inner:hover .hamburger-inner:after, button.hamburger .hamburger-inner:hover .hamburger-inner:before, .off-canvas #menu-main-menu, .timeline__content-title, .nav-pills .nav-link.active, .nav-pills .show>.nav-link, .page-item.active .page-link { background-color:' +
        to +
        "}";
      // Text color
      var color_main_txt =
        "a, #listing article .card .btn:active, .btn-outline-light:active, .btn-outline-light:focus, .btn-outline-light:hover, #listing article .card .btn:focus, #listing article .card .btn:hover, #top-bar-menu .desktop .nav li a:hover, #top-bar-menu .desktop .nav > li.active > a, .tabs-sermon .link-title .nav-link.active, .page-link, .page-link:hover { color:" +
        to +
        "}";
      // Border color
      var color_main_border =
        '.gform_wrapper input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]):focus, .gform_wrapper input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]):active, .gform_wrapper textarea:active, .gform_wrapper textarea:focus, .timeline-item:before, .timeline-item:nth-child(even):before, .page-item.active .page-link {  border-color: ' +
        to +
        " transparent transparent; }";
      // Dropdown arrow
      var color_main_dropdown =
        "#top-bar-menu .desktop .nav li .dropdown-toggle::after { border-top-color:" +
        to +
        "}";

      //Put in the preview-only CSS
      $("#ecclesio-customizer-preview").append(color_main_bg);
      $("#ecclesio-customizer-preview").append(color_main_txt);
      $("#ecclesio-customizer-preview").append(color_main_border);
      $("#ecclesio-customizer-preview").append(color_main_dropdown);
    });
  }); //wp.customize

  // BRAND COLOR - SECONDARY
  // Selective refresh the site's accent color
  wp.customize("ecclesio_color_accent", function(value) {
    value.bind(function(to) {
      // Background color
      var color_accent_bg =
        ".home #banner .button-group li a.button:hover, .home #banner .button-group li a.button:focus, .home #banner .button-group li a.button:active, #sermon-latest .text-container h5, #sermon-latest .text-container .button:hover, #sermon-latest .text-container .button:active, #sermon-latest .text-container .button:focus, button.hamburger:hover .hamburger-inner, button.hamburger:hover .hamburger-inner:after, button.hamburger:hover .hamburger-inner:before, #sermon-latest .text-container .btn:active, #sermon-latest .text-container .btn:focus, #sermon-latest .text-container .btn:hover, .page-template-template-home #banner .btn-group a.btn:active, .page-template-template-home #banner .btn-group a.btn:focus, .page-template-template-home #banner .btn-group a.btn:hover { background-color:" +
        to +
        "}";
      // Text color
      var color_accent_color = "a:focus, a:hover { color: " + to + "; }";
      // Border color
      var color_accent_border =
        "#purpose, #sermon-latest .text-container .button {  border-color: " +
        to +
        "; }";
      //Put in the preview-only CSS
      $("#ecclesio-customizer-preview").append(color_accent_color);
      $("#ecclesio-customizer-preview").append(color_accent_bg);
      $("#ecclesio-customizer-preview").append(color_accent_border);
    });
  }); //wp.customize

  // BANNER COLOR
  // Selective refresh the site's banner color
  wp.customize("ecclesio_color_banner", function(value) {
    value.bind(function(to) {
      var color_banner =
        "#banner .overlay { background: " + hexToRGB(to, 0.75) + "; }";
      //Put in the preview-only CSS
      $("#ecclesio-customizer-preview").append(color_banner);
    });
  }); //wp.customize

  // FOOTER COLOR
  // Selective refresh the site's footer color
  wp.customize("ecclesio_color_footer", function(value) {
    value.bind(function(to) {
      // Background color
      var color_footer_bg =
        "footer.footer, .off-canvas .navbar-nav .dropdown-menu { background: " +
        to +
        "; }";
      // Text color
      var color_footer_color =
        ".footer-top .social a:hover { color: " + to + "; }";
      //Put in the preview-only CSS
      $("#ecclesio-customizer-preview").append(color_footer_bg);
      $("#ecclesio-customizer-preview").append(color_footer_color);
    });
  }); //wp.customize
})(jQuery);
