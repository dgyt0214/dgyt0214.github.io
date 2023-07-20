$("#menu-toggle").click(function(e) {
  e.preventDefault();
  $("#sidebar-wrapper").width("250px");
  $("#page-content-wrapper").css("padding-left", "250px");
});

$("#sidebar-wrapper").click(function(e) {
  $(this).width("0");
  $("#page-content-wrapper").css("padding-left", "100px");
});

$(document).mouseup(function(e) {
  var sidebar = $("#sidebar-wrapper");

  if (!sidebar.is(e.target) && sidebar.has(e.target).length === 0) {
      sidebar.width("0");
      $("#page-content-wrapper").css("padding-left", "100px");
  }
});


