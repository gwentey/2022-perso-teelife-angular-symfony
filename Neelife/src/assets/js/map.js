


function mapVille() {
  highlight(".hover");
  highlight("li a");
}

function highlight(selector) {
  $(selector).mouseenter(function () {
    var classLink = $(this).attr('class').split(' ')[1];
    $("." + classLink).addClass('over');
    $(".section-" + classLink).stop().fadeIn();
  }).mouseleave(function () {
    var classLink = $(this).attr('class').split(' ')[1];
    $("." + classLink).removeClass('over');
    $(".section-" + classLink).stop().fadeOut();
  });

};


