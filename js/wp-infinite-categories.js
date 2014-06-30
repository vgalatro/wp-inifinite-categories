(function ($) {
  
  $(window).scroll(function(){
 
    var top = $(window).scrollTop(), 
      docheight = $(document).height(), 
      winheight = $(window).height(),
      percentage;
      
      percentage = top/(docheight-winheight);
      $(window).trigger('wic_percentage_change', {'percentage': percentage});
  });
  $(document).ready( function() {
    $(window).on('wic_percentage_change', function (e, data) {
      if (data.percentage > .95) {
        /* Increment paged variable */
        if (ajax_data.query_vars.paged == 0) {
          ajax_data.query_vars.paged = 2
        } else {
          ajax_data.query_vars.paged += 1;
        }
        console.dir(ajax_data);
        var data = {
          'action': 'wpic_load_next_page',
          'query': ajax_data.query_vars
        };
        $.post(ajax_data.url, data, function(response) {
          $('#content').append(response);
        });
      }
    });
  });
  
})(jQuery);
