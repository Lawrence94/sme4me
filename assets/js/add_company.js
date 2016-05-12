$(document).ready(function(){	
  var jb_this;
  $('.exp').hover(function() {
        jb_this = $(this);
    });
  $('.expire').click(function() {
    var expButton = $(this).html();
    var theUrl = $(this).data('url');
    var theSecondUrl = $(this).data('uri');
    var id = $(this).data('id');

    if(expButton.indexOf("Expire") > -1){
      var async1 = $.ajax({
                    url: theUrl,
                    type: 'GET'
                  })
                  .done(function(data) {
                    //console.log(data);
                  })
                  .fail(function() {
                    //console.log("error");
                  })
                  .always(function() {
                    //console.log("complete");
                  });
      

      $.when(async1).done(function(result) {
            // ... do this when things are successful ...
                if(JSON.stringify(result).indexOf('true') > -1){
                        $('.expire').html('Activate');
                    }else{
                        $('.expire').html('Expire');
                    }
      });
    }else{
      var async1 = $.ajax({
                    url: theSecondUrl,
                    type: 'GET'
                  })
                  .done(function(data) {
                    //console.log(data);
                  })
                  .fail(function() {
                    //console.log("error");
                  })
                  .always(function() {
                    //console.log("complete");
                  });
      

      $.when(async1).done(function(result) {
            // ... do this when things are successful ...
                if(JSON.stringify(result).indexOf('true') > -1){
                        $('.expire').html('Expire');
                    }else{
                        $('.expire').html('Activate');
                    }
      });
    }
  });
});