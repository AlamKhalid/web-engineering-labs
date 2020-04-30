/* jQuery to handle events in grocery store */

$("docuemnt").ready(function () {
  $("li").click(function (event) {
    let dateObj = new Date();
    const date = dateObj.toString().substring(0, 15);
    const time = `${dateObj.getHours()}:${dateObj.getMinutes()}:${dateObj.getSeconds()}`;
    $(this).find("span").html(`Clicked on ${date} at ${time}`);
  });
});
