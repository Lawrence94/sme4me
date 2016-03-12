$(document).ready(function() {
  $('.button').on('click', function() {
    $('.button').removeClass('active');
    $(this).toggleClass('active');
  });
});