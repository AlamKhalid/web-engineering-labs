/* jQuery to handle events in grocery store */

function changeParagraph(item, event) {
  let status = "available";
  if (item == "honey" || item == "pine nuts") status = "important";
  $("p").html(`Item: ${item} <br>Status: ${status} <br>Event: ${event}`);
}

$("docuemnt").ready(function () {
  $("li").click(function (event) {
    changeParagraph($(this).text(), event.type);
  });
  $("li").mouseover(function (event) {
    changeParagraph($(this).text(), event.type);
  });
});
