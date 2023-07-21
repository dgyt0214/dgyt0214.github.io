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
  
  const btn = document.querySelector('#div1');
  btn.addEventListener('click', (e) => {
      btn.setAttribute('class', btn.getAttribute("class") === "active" ? "" : "active");
          setTimeout(() => {
        window.location.href = 'buymeacoffe.html';
    }, 2000); // 2000 milliseconds = 2 seconds
});


