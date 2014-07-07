(function($) {

  $(window).scroll(function(){
    /* Calculate percentage scrolled and then trigger event, passing the percentage */
    var top = $(window).scrollTop(), 
      docheight = $(document).height(), 
      winheight = $(window).height(),
      percentage;
      
      percentage = top/(docheight-winheight);
      $(window).trigger('wic_percentage_change', {'percentage': percentage});
  });
  $(document).ready( function() {
    /* Initialize conditional we will need later */
    var loading = false;
    var current_page_title = $(document).find("title").text();
    $(window).on('wic_percentage_change', function (e, data) {
      /* Only try to load when near the bottom of the page */
      if (data.percentage > .99 && loading == false) {
        /* Increment paged variable */
        if (ajax_data.query_vars.paged == 0) {
          ajax_data.query_vars.paged = 2
        } else {
          ajax_data.query_vars.paged += 1;
        }
        /* Data for ajax call */
        var data = {
          'action': 'wpic_load_next_page',
          'query': ajax_data.query_vars
        };
        /* Prevent race condition between waiting for request and user scrolling*/
        loading = true;
        /* Make ajax request */
        $.post(ajax_data.url, data, function(response) {
          if (response) {
            $(response).appendTo('.wp_inf_scrl_init').hide().fadeIn(2000);
            loading = false;
            History.pushState({page: ajax_data.query_vars.paged}, current_page_title + ' | Page ' + ajax_data.query_vars.paged, '?ipage=' + ajax_data.query_vars.paged);
          }
        });
      }
    });
  });
  
})(jQuery);
