jQuery(function($){
  var thScroll;
  var lastScrollTop = 0;
  var delta = 5;
  var navbarHeight = $('.top-header').outerHeight();

  $(window).scroll(function(event){
    thScroll = true;
  });

  setInterval(function() {
    if (thScroll) {
      hasScrolled();
      thScroll = false;
    }
  }, 250);

  function hasScrolled() {
    var st = $(this).scrollTop();
    if(Math.abs(lastScrollTop - st) <= delta)
      return;
    if (st > lastScrollTop && st > navbarHeight){
      $('.top-header').removeClass('is-down').addClass('is-up');
    } else {
      if(st + $(window).height() < $(document).height()) {
        $('.top-header').removeClass('is-up').addClass('is-down');
      }
    }

    lastScrollTop = st;
  }

  $('.goto').on('click', 'a[href^="#"]', function(e) {
    var id = $(this).attr('href');
    var $id = $(id);
    if ($id.length === 0) {
      return;
    }
    e.preventDefault();
    var pos = $id.offset().top;
    $('body, html').animate({scrollTop: pos});
  });


  //filter
  $('.btn-filter').on('click', function () {
    $(this).toggleClass('active').siblings('.btn-filter').removeClass('active');
    var $target = $(this).data('target');
    if ($target != 'all') {

      $('.filter-box').css('display', 'none');
      $('.filter-box[data-status="' + $target + '"]').fadeIn('slow');

    } else {

      $('.filter-box').css('display', 'none').fadeIn('slow');

    }
  });

  // mobile view
  $('.mob-menu, .mob-close').on('click', function(){
    $('.mobile-menu, body').toggleClass('mobile-on');
  })


  $('.media-sub').on('click', function(){
    $('.mobmenu, .mobside-bottom').toggleClass('hidden');
    $('.mob-submenu').toggleClass('active');
  })





});





