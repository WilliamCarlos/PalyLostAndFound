// Quick Table Search
//This is a very generic Regular Expression Search algorithm and is not original code, I plan to later write my own algorithm
//that will be better suited for this website
$('#search').keyup(function() {
  var regex = new RegExp($('#search').val(), "i");
  var rows = $('displayTable tr:gt(0)');
  rows.each(function (index) {
    title = $(this).children("#searchKey").html()
    if (title.search(regex) != -1) {
      $(this).show();
    } else {
      $(this).hide();
    }
  });
});

