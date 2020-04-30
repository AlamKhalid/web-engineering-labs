/* jQuery to handle events in grocery store */

$("docuemnt").ready(function () {
  $(window).on("scroll", function () {
    if ($("#footer").offset().top - $(this).scrollTop() - 500 >= 500) {
      $("#slideAd").css("right", "-235");
    } else {
      $("#slideAd").css("right", "0");
    }
  });
});
