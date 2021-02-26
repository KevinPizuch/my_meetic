/*Partie slide profil trouvé*/
let slideIndex = 2;
$(document).ready(function() {
  showSlides(slideIndex);
});

function plusDivs(n) {
  showSlides(slideIndex += n);
}

function showSlides(n) {
  let i;
  let slides = $(".card-c");
  if (n > slides.length + 1) {
    slideIndex = 2
    n = 2
  }
  if (n < 2) {
    slideIndex = slides.length + 1;
    n = slides.length + 1;
  }
  $(slides).css('display', 'none');
  $(".card-c:nth-child(" + n + ")").css("display", "block");
}

function delete_func(n) {
  console.log(n);
  n.parentNode.parentNode.removeChild(n.parentNode);
}

function hiddenfunc() {
  let myInput = "";
  $('.p-city-container').each(function(i, el) {
    x = $(el).find(".p-input").text();
    myInput += x + "|";
  });
  myInput = myInput.slice(0, -1);
  $(".city_content_input").append("<input type=\"hidden\" name=\"city\" value=\"" + myInput + "\">");
}
$(window).keydown(function(event) {
  if (event.keyCode == 13) {
    event.preventDefault();
    if ($("#ville").val() != "") {

      let input = $("#ville").val();
      $("input[name=\"ville\"]").val("");
      $(".city_content_input").append("<div class=\"all-city\"><div class=\"p-city-container\"><p class=\"p-input\">" + input +
        "</p><a class=\"delete-input-city\" onclick=\"delete_func(this)\" href=\"#\">x</a></div></div>");

    }
  }
});
