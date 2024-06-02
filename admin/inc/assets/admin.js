(function ($) {
  "use strict";

  $(document).ready(function () {

    var import_running = false;
    $(document).on("click", ".btn-import-xml.Import", function(e){
      e.preventDefault();  
      if (import_running) return false;
      var el = $(this);
      var xml = el.data('xml');
      var frontpage = el.data('front');
      var demo_holder = el.parent().parent();
      
      var importqueue = [],
        processqueue = function () {
          if (importqueue.length != 0) {
            var importaction = importqueue.shift();
            $.ajax({

              type: 'POST',
              url: thepack_site_data.ajax_url,
              data: {
                action: importaction,
                nonce: wpApiSettings.nonce,
                xml: xml,
                frontpage: frontpage,
              },
              success: processqueue,

            });
          }
          else {
            demo_holder.removeClass('running');
            setTimeout(function () { window.open(thepack_site_data.site_url, '_blank'); }, 2000);
            import_running = false;
          }
        };

      importqueue.push('the_pack_import_xml');
      if (importqueue.length == 0) return false;

      import_running = true;
      demo_holder.addClass('running');
      processqueue();

      return false;
    });

    var contain = $('.demo-inner');
    contain.imagesLoaded(function () {
      contain.masonry({
        itemSelector: '.demo',
        isAnimated: false,
        transitionDuration: '7.5s'
      });
    });


    $(document).on('click', '.page-link', function (e) {
      e.preventDefault();
      $('.xlimwrap').addClass('loading');
      var filter = $(this).parents('.xlimwrap').find('.filter-cat .active').data('filter');
      var page_no = $(this).data('page-number');
      var opt_table = $('.demo-inner').data('table');
      var ajax_data = {
        page: page_no,
        filter: filter,
        table: opt_table,
      };
      process_demo_tab(ajax_data);
    });

    $(document).on('click', '.filter-cat li', function(e) {
      e.preventDefault();
      $(this).addClass("active").siblings().removeClass("active");
      $('.xlimwrap').addClass('loading');
      var filter = $(this).data('filter');
      var opt_table = $('.demo-inner').data('table'); 
      var ajax_data = {
        filter: filter,
        table: opt_table,
      };
      process_demo_tab(ajax_data);
  });

    function process_demo_tab($data) {
      $.ajax({
        type: 'POST', 
        url: thepack_site_data.ajax_url,
        data: {
          action: 'display_import_page',
          nonce: wpApiSettings.nonce,
          data: $data,
        },

        beforeSend: function () {

          $(".xlimwrap").animate({ scrollTop: 0 }, "slow");
        },

        success: function (data, textStatus, XMLHttpRequest) {

          $('.xlimwrap').removeClass('loading');
          $('.tp-container').html(data);
          $('.tp-container .header').html('');

          $('.demo-inner').masonry({
            itemSelector: '.demo',
            isAnimated: false,
            transitionDuration: 0
          });

          $('.demo-inner').masonry('reloadItems');

          $('.demo-inner').imagesLoaded(function () {
            $('.demo-inner').masonry('layout');
          });

        },

      });
    }

      $(document).on('click', '.reload-lib', function(e) {
          $.ajax({
              type: 'POST',
              url: thepack_site_data.ajax_url,
              data: {
                action: 'tp_reload_template',
                nonce: wpApiSettings.nonce,
              },
              success: function(data, textStatus, XMLHttpRequest) {
                  location.reload(true);
              },
            });
      });

      $(".clean-db").on("click", function(e) {
        e.preventDefault();
        $('#wpcontent').addClass('running');
        var data = {
          action: 'thepack_clean_site',
          nonce: wpApiSettings.nonce,
        };     
   
        $.ajax({
          type: "POST",
          url: ajaxurl,
          data: data,
          success: function(result) {
            console.log(result);
            alert('Site is cleaned !');
          }
          
        });

      });

  });

})(jQuery);
