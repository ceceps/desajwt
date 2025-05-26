$(document).ready(function () {

  // $('.select2').select2();

    var htmlkec = "<option>--Kecamatan--</option>";
    var htmlkel = "<option>--Kelurahan/Desa--</option>";

    $("select#kabupaten_id").change(function(){
        var id = $("select#kabupaten_id option:selected").attr("value");

        $.ajax({
            url:rest_url+"kecamatan/kabupaten/"+id,
            crossDomain: true,
            dataType: 'json', // Notice! JSONP <-- P (lowercase)
            timeout: 5000,
            contentType : "text/plain",
            success:function(data){
                // var jdata = JSON.parse(data);
                $("select#kecamatan_id").empty();
                $("select#kelurahan_id").empty().html(htmlkel);
                var html = htmlkec;
                $.each(data.kecamatan, function(i, entry) {
                    html += "<option value=\'"+entry.id+"\'>"+entry.nama+"</option>";

                });
                $("select#kecamatan_id").append(html);
            },
            error: function (parsedjson, textStatus, errorThrown) {
                console.log("parsedJson: " + JSON.stringify(parsedjson));
           }
        });

    });

    $("select#kecamatan_id").change(function(){
        var id = $("select#kecamatan_id option:selected").attr("value");
        $.ajax({
            url:rest_url+"kelurahan/kecamatan/"+id,
            crossDomain: true,
            dataType: 'json',
            timeout: 5000,
            contentType : "text/plain",
            success:function(data){
                $("select#kelurahan_id").empty();
                var html = "<option>--Kelurahan/Desa--</option>";
                $.each(data.kelurahan, function(i, entry) {
                    html += "<option value=\'"+entry.id+"\'>"+entry.nama+"</option>";
                });
                $("select#kelurahan_id").append(html);
            },
            error: function (parsedjson, textStatus, errorThrown) {
                console.log("parsedJson: " + JSON.stringify(parsedjson));
            }
        });

    });


});
