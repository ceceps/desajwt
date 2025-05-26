jQuery(function($){

  $('.side-compact').on('click', function(){
    $('.dashboard').toggleClass('full');
    $('.header-logo').toggleClass('hidden');
  })

  if($('.select-category').length){
     $('.select-category').select2({
        placeholder: 'Pilih kategori'
      });
  }

  if($('.select-kota').length){
    $('.select-kota').select2({
        placeholder: 'Pilih Kota atau kabupaten'
      });
  }

  if($('.select-kecamatan').length){
    $('.select-kecamatan').select2({
        placeholder: 'Pilih Kecamatan'
      });
  }

  if($('.select-desa').length){
       $('.select-desa').select2({
        placeholder: 'Pilih Desa atau Kelurahan'
      });
  }

  if($('.select-year').length){
    $('.select-year').select2({
        placeholder: 'Pilih Tahun'
      });
  }



  $('.select2-results__options').slimScroll({
    color: '#105190',
    size: '4px',
    height: '240px',
    alwaysVisible: false
  });

 if($('#dtable').length){
    $('#dtable').DataTable( {
        responsive: true
      });
 }



  



    $(".btn-media").click(function () {
      var theModal = $(this).data("target"),
        videoSRC = $(this).attr("data-video"),
        videoSRCauto = videoSRC;
      $(theModal + ' iframe').attr('src', videoSRCauto);
      $(theModal + ' button.close').click(function () {
        $(theModal + ' iframe').attr('src', '');
      });
    });


  $('#mediaModal').on('hidden.bs.modal', function (e) {
    $('#mediaModal').find('iframe').attr('src', '');
  });

  $('.btn-grid').on('click', function(){
    $(this).toggleClass('active').siblings().removeClass('active');
    $('.grid-list').removeClass('list-view');
  })

  $('.btn-list').on('click', function(){
    $(this).toggleClass('active').siblings().removeClass('active');
    $('.grid-list').toggleClass('list-view');
  })


/*  $('.dashboard-user-activity').hcSticky({
    stickTo: '.dashboard-content',
    bottomEnd: 90
  });*/





});





