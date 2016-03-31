$(document).ready(function(){	
  var jb_this;
  $('.exp').hover(function() {
        jb_this = $(this);
    });
  $('.expire').click(function() {
    var theUrl = $(this).data('url');
    var id = $(this).data('id');
    var async1 = $.ajax({
                  url: theUrl,
                  type: 'GET'
                })
                .done(function(data) {
                  console.log(data);
                })
                .fail(function() {
                  console.log("error");
                })
                .always(function() {
                  console.log("complete");
                });
    

    $.when(async1).done(function(result) {
    // ... do this when it's are successful ...
      //console.log(jQuery.parseJSON(result));
      var options = "";
        if(JSON.stringify(result).indexOf('true') > -1){
                $(jb_this).html('Expired');  
            }else{
              var data = jQuery.parseJSON(result);
              var base_url = "";
              $.each(data, function(index, val) {
                    //console.log();
                    base_url = val['baseUrl'];
                    //<img src="" alt="">
                    //alert(val['objFollow']);
                    
              });
              options = "<a class='expire' data-id='"+ id +"' data-url='" + base_url +"Admin/Dashboard/expire/" + id +"' href='#' data-toggle='tab'>Expire</a>";
              $(jb_this).html(options);;
            }
    });
  });
});