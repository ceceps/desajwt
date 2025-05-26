jQuery(function($){

    $('.btn-chat-back').on('click', function(){
        $('.chat-user-content.dropmessage').toggleClass('slidein');
        $('.chat-user-content.main-chat').toggleClass('slidein');
      })

      $('.btn-offline').on('click', function(){
        $('.chat-user-content.main-chat').toggleClass('slidein');
        $('.chat-user-content.dropmessage').removeClass('slidein');
        $('.chat-user-content.dropmessage').removeClass('hidden');
      })

      $('.btn-online').on('click', function(){
        $('.chat-user-content.main-chat').toggleClass('slidein');
        $('.chat-user-content.chatonline').removeClass('slidein');
        $('.chat-user-content.chatonline').removeClass('hidden');
      })

      $('.for-chat, .btn-minimize').on('click', function(){
        $('.user-chat').toggleClass('onChat');
      })

      $('#floatChat').slimScroll({
        position: 'right',
        height: '264px',
        railVisible: false,
        alwaysVisible: false,
        color: '#2C8BFF'
      });



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


    // mobile view
    $('.mob-menu, .mob-close').on('click', function(){
     $('.mobile-menu, body').toggleClass('mobile-on');
    })




    $('.media-sub').on('click', function(){
      $('.mobmenu, .mobside-bottom').toggleClass('hidden');
      $('.mob-submenu').toggleClass('active');
    })



    // feature slide
    if($(".owl-carousel").length){
        $(".owl-carousel").on("initialized.owl.carousel", function () {
            setTimeout(function () {
              $(".owl-item.active .owl-slide-animated").addClass("is-transitioned");
              $("section").show();
            }, 500);
          });

          var $owlCarousel = $(".owl-carousel").owlCarousel({
            items: 1,
            loop: true,
            nav: true,
            lazyLoad: true,
            dots: false,
            autoplay: true,
            navText: [
              "<i class='icon icon-back'></i>","<i class='icon-next'></i>"] });

          $owlCarousel.on("changed.owl.carousel", function (e) {
            $(".owl-slide-animated").removeClass("is-transitioned");

            var $currentOwlItem = $(".owl-item").eq(e.item.index);
            $currentOwlItem.find(".owl-slide-animated").addClass("is-transitioned");

            var $target = $currentOwlItem.find(".owl-slide-text");
            doDotsCalculations($target);
          });

          $owlCarousel.on("resize.owl.carousel", function () {
            setTimeout(function () {
              setOwlDotsPosition();
            }, 50);
          });


          $owlCarousel.trigger("refresh.owl.carousel");

          setOwlDotsPosition();

          function setOwlDotsPosition() {
            var $target = $(".owl-item.active .owl-slide-text");
            doDotsCalculations($target);
          }

          function doDotsCalculations(el) {
            var height = el.height();var _el$position =
              el.position(),top = _el$position.top,left = _el$position.left;
            var res = height + top + 20;

            $(".owl-carousel .owl-dots").css({
              top: res + "px",
              left: left + "px" });
          }
    }


    $('.btn-search').on('click', function(){
      $('.top-search').toggleClass('active');
    })

  });
