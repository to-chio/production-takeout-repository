"use strict";

$(function(){

  $(document).ready(function() {
    $('.home').on('click', function(){
      location.reload();
    });
  });

  $('.home').click(function() {
    $(window).scrollTop(0);
  })

  let min_height = 100;
  let ani_duration = 300;

  $('.matter_wrap').each(function(index) {
    if ($(this).height()>min_height + 50) {
      $(this).height(min_height).append('<div class="matter_more"></div>');
    }
  });

  $('.matter_more').click(function() {
    let athis = $(this);
    let show_text = athis.parent('.matter_wrap');
    let original_height = show_text.css({height : 'auto'}).height();

    if(show_text.hasClass('is-open')){

      let scroll_offset = $("html,body").scrollTop() - original_height + min_height;

      $("html,body").animate({ scrollTop: scroll_offset }, ani_duration);
      show_text.animate({height:min_height}, ani_duration, function() {
      });
      show_text.removeClass('is-active').removeClass('is-open');
    }else {
        show_text.height(min_height).animate({height:original_height},ani_duration, function() {
        show_text.height('auto').addClass('is-open');
      });
      show_text.addClass('is-active');
    }
  });

  $(".open_btn").click(function() {
    $(".in .menu").remove();
    $(this).toggleClass("active");
    $(".burger_bg").toggleClass("open");
    $(".burger_menu").toggleClass("in");
    $(".in .burger_content").html($(".icon_box").html());
    return false;
});

});


// $(".in a").click(function(){
//   $(".in .menu").remove();
//   $(".open_btn").toggleClass("active");
//   $(".burger_bg").toggleClass("open");
//   $(".burger_menu").toggleClass("in");
//   return false;
// });
