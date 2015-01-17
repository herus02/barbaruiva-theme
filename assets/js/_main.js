/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can 
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {

  
// Use this variable to set up the common and page specific functions. If you 
// rename this variable, you will also need to rename the namespace below.
var Roots = {
  // All pages
  common: {
    init: function() {

/*
      // Show Search if form is not active // event.preventDefault() is important, this prevents the form from submitting
      $(document).on('click', '.navbar-collapse form[role="search"]:not(.active) button[type="submit"]', function(event) {
        event.preventDefault();
        var $form = $(this).closest('form'),
          $input = $form.find('input');
        $form.addClass('active');
        $input.focus();
      });
      // ONLY FOR DEMO // Please use $('form').submit(function(event)) to track from submission
      // if your form is ajax remember to call `closeSearch()` to close the search container
      $(document).on('click', '.navbar-collapse form[role="search"].active button[type="submit"]', function(event) {
        event.preventDefault();
        var $form = $(this).closest('form'),
          $input = $form.find('input');
        $('#showSearchTerm').text($input.val());
          $form.find('input').val('');
          $form.removeClass('active');
      });
*/
      // JavaScript to be fired on all pages
      $('#slider, #album_gallery').carousel({
        interval: 5000
      });

      $('#carousel-text').html($('#slide-content-0').html());
      $('#carousel-selector-0').addClass("active");


      //Handles the carousel thumbnails
      $('[id^=carousel-selector-]').click( function(){
              var id_selector = $(this).attr("id");
              var idx = id_selector.substr(id_selector.length -1);
              var id = parseInt(idx);
              $('#slider, #album_gallery').carousel(id);
      });


      // When the carousel slides, auto update the text
      $('#slider, #album_gallery').on('slid.bs.carousel', function (e) {
              $('[id^=carousel-selector-]').removeClass('active');
              var id = $('.item.active').data('slide-number');
              $('#carousel-text').html($('#slide-content-'+id).html());
              $('#carousel-selector-'+id).addClass("active");
      });
    } 
  },
  // Home page
  home: {
    init: function() {
      // JavaScript to be fired on the home page
    }
  },
  // About us page, note the change from about-us to about_us.
  about_us: {
    init: function() {
      // JavaScript to be fired on the about us page
    }
  }
};

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = Roots;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {
    UTIL.fire('common');

    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });
  }
};

$(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
