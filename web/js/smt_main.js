$(function(){
  $('#smt-switch')
    .show()
    .click(function() {
      document.cookie = "disable_smt=1";
      location.href = $(this).attr('href');
    });
});
