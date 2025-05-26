function readURL(input, imgpreview) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(imgpreview).attr('src', e.target.result).attr('class', 'img-posting');
        }
        console.log(input.files[0]);
        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function () {
    var store = store || {};
    store.setJWT = function(data){
        this.JWT = data;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var token = document.head.querySelector('meta[name="csrf-token"]');

    var $loading = $('#loadingDiv').hide();

    $(document).ajaxStart(function () {
        $loading.show();
    }).ajaxStop(function () {
        $loading.hide();
    });

     //Halaman Login dan Register
     $('#btnPassword').on('click', function () {
        showPassword('password');
    });

    $('#formbackendlogin').submit(function(e){
        e.preventDefault();
        var $this = $('.btn');
        $this.button('loading');

        $.ajax({
            url: loginUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function(data){
               window.location = '/backend';
               $this.button('reset');
            },
            error: function(jqXhr, json, errorThrown){// this are default for ajax errors
                var errors = jqXhr.responseJSON;
                var errorsHtml = '';
                $.each(errors['errors'], function (index, value) {
                    errorsHtml += '<ul class="list-group"><li class="list-group-item alert alert-danger">' + value + '</li></ul>';
                });

                swal({
                    title: "Kesalahan",// + jqXhr.status + ': ' + errorThrown, this will output "Error 422: Unprocessable Entity"
                    html: errorsHtml,
                    width: 'auto',
                    confirmButtonText: 'Coba Lagi',
                    cancelButtonText: 'Batal',
                    confirmButtonClass: 'btn',
                    cancelButtonClass: 'cancel-class',
                    showCancelButton: true,
                    closeOnConfirm: true,
                    closeOnCancel: true,
                    type: 'error'
                }, function(isConfirm) {
                    if (isConfirm) {
                         $('#openModal').click();//this is when the form is in a modal
                    }
                    $this.button('reset');
                });
            }
        });

        // $.post(loginUrl,$('#formbackendlogin').serialize(),function(resp){

        //     if(resp.error == null){
        //             Cookies.set('desawisataapps', resp.token, { expires: 1 });
        //             store.setJWT(resp.token);

        //             // window.location = dashboardUrl+'?token='+store.JWT;
        //             window.location = dashboardUrl;


        //     }else{
        //         let pesan = '<div class="alert alert-danger" role="alert"><strong>Error</strong> '+resp.error+'</div>';
        //         $('#pesan').html(pesan);
        //     }

        // });
    });

    var addTokenURL = function(token){
        var querystring = 'token='+token;
        $('a').each(function() {
            var href = $(this).attr('href');
            if (href) {
                    href += (href.match(/\?/) ? '&' : '?') + querystring;
                    $(this).attr('href', href);
                }
        });
    }

    //toogle grid
    $('.btn-grid').on('click', function () {
        $(this).toggleClass('active').siblings().removeClass('active');
        $('#gridkonten').removeClass('grid-list');
    });

    $('.btn-grid').on('click', function () {
        $(this).toggleClass('active').siblings().removeClass('active');
        $('#gridkonten').toggleClass('grid-list');
    });

    if($('.select-year').lenght){
        $('.select-year').select2({
            placeholder: 'Pilih Tahun',
            autoCLose: true
        });
    }

    if($('.select-category').length){
        $('.select-category').select2({
            placeholder: 'Pilih kategori'
        });

        $('.select-kota').select2({
            placeholder: 'Pilih Kota atau kabupaten',
            autoClose: true
        });

        $('.select-kecamatan').select2({
            placeholder: 'Pilih Kecamatan',
            autoClose: true
        });

        $('.select-desa').select2({
            placeholder: 'Pilih Desa atau Kelurahan',
            autoClose: true
        });




        $('.select2-results__options').slimScroll({
            color: '#105190',
            size: '4px',
            height: '240px',
            alwaysVisible: false
        });

        if ($('.dtable').length) {
            $('.dtable').DataTable({
                responsive: true
            });
        }

        if ($('.select2').length) {
            $('.select2').select2({

                autoClose: true
            });
        }
        if ($('.select-category').length) {
            $('.select2').select2({
                placeholder: 'Pilih Kategori',
                autoClose: true
            });
        }
    }



});
