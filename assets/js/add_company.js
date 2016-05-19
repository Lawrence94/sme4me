$(document).ready(function(){	
  var jb_this;
  $('.expire').hover(function() {
        jb_this = $(this);
    });
  $('.expire').click(function() {
    var expButton = $(jb_this).html();
    var theUrl = $(jb_this).data('url');
    var theSecondUrl = $(jb_this).data('uri');
    var id = $(jb_this).data('id');

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
                        $(jb_this).html('Activate');
                    }else{
                        $(jb_this).html('Expire');
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
                        $(jb_this).html('Expire');
                    }else{
                        $(jb_this).html('Activate');
                    }
      });
    }
  });
});