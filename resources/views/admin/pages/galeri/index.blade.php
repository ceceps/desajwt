@extends('admin.layouts.layout_admin')
@php header("Cache-Control", "no-cache, no-store, must-revalidate");
@endphp
@section('topbar')
<!-- begin top dashboard -->
<div class="dashboard-top">
    <div class="container-fluid">
        <div class="top-entry">
            <div class="top-status">
                <h3>{!! isset($title_page)?$title_page:'&nbsp;'; !!}</h3>
                <!-- for single action page remove this breadcrumb-->
                <nav class="dashboard-breadcrumb">
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{ url('dashboard.index') }}">
                                <i class="mdi mdi-home"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <i class="mdi mdi-chevron-right"></i> {!! isset($title_page)?$title_page:'&nbsp;'; !!}
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="top-option">
                {!! date('d-m-Y H:i:s') !!}
            </div>
        </div>
    </div>
</div>
<!-- end top dashboard -->
@endsection
@section('content')
<div class="dashboard-content">
    <div class="container-fluid">
       <section class="base-content">
                <h4>Galeri</h4>
                <p class="title-helper">Semua foto dan video</p>

                <div class="panel clean">
                    <!-- begin default table style ---->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Preview</th>
                                <th scope="col"  width="15%">Judul</th>
                                <th scope="col"  width="15%">Tgl</th>
                                <th scope="col">Oleh</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($currentPageSearchResults))
                                @foreach ($currentPageSearchResults as $gal)
                                  @switch($gal->parent_table)
                                      @case('r_desawisata')
                                          @if($gal->extensi !='mp4')
                                            @php
                                            $url = config('desawisata.PATH_IMAGE_DESAWISATA').'thumb/'.$gal->img; @endphp
                                          @else
                                            @php
                                             $url = config('desawisata.PATH_IMAGE_VIDEO').'cover/'.$gal->img; @endphp
                                          @endif
                                       @break
                                      @case('r_profildesa')
                                        @if($gal->extensi !='mp4')
                                         @php
                                           $url = config('desawisata.PATH_IMAGE_PROFILDESA').'thumb/'.$gal->img;  @endphp
                                         @else
                                         @php $url = config('desawisata.PATH_IMAGE_VIDEO').'cover/'.$gal->img; @endphp
                                       @endif
                                       @break
                                      @case('r_desawisata_atraksi')
                                       @if($gal->extensi !='mp4')
                                         @php
                                            $url = config('desawisata.PATH_IMAGE_ATRAKSI').'thumb/'.$gal->img;  @endphp
                                       @else
                                         @php $url = config('desawisata.PATH_IMAGE_VIDEO').'cover/'.$gal->img; @endphp
                                       @endif
                                          @break
                                      @case('r_desawisata_fasilitas')
                                       @if($gal->extensi !='mp4')
                                         @php $url = config('desawisata.PATH_IMAGE_FASILITAS').'thumb/'.$gal->img; @endphp
                                       @else
                                         @php $url = config('desawisata.PATH_IMAGE_VIDEO').'cover/'.$gal->img; @endphp
                                       @endif
                                          @break
                                      @case('r_desawisata_kelsos')
                                        @if($gal->extensi !='mp4')
                                            @php $url = config('desawisata.PATH_IMAGE_KELSOS').'thumb/'.$gal->img; @endphp
                                        @else
                                            @php $url = config('desawisata.PATH_IMAGE_VIDEO').'cover/'.$gal->img; @endphp
                                        @endif
                                          @break
                                      @case('r_desawisata_jenis_usaha')
                                        @if($gal->extensi !='mp4')
                                            @php $url = config('desawisata.PATH_IMAGE_USPAR').'thumb/'.$gal->img; @endphp
                                        @else
                                            @php $url = config('desawisata.PATH_IMAGE_VIDEO').'cover/'.$gal->img; @endphp
                                        @endif
                                       @break
                                      @case('r_artikel')
                                        @if($gal->extensi !='mp4')
                                            @php $url = config('desawisata.PATH_IMAGE_ARTIKEL').'thumb/'.$gal->img; @endphp
                                        @else
                                            @php $url = config('desawisata.PATH_IMAGE_VIDEO').'cover/'.$gal->img; @endphp
                                        @endif
                                       @break
                                      @case('r_desawisata_penghargaan')
                                        @if($gal->extensi !='mp4')
                                            @php $url = config('desawisata.PATH_IMAGE_PENGHARGAAN').'thumb/'.$gal->img; @endphp
                                        @else
                                            @php $url = config('desawisata.PATH_IMAGE_VIDEO').'cover/'.$gal->img; @endphp
                                        @endif
                                       @break
                                      @default
                                         @php
                                             $url = 'images/noimage.jpg';
                                         @endphp
                                      @break
                                  @endswitch

                                  @php $img = @getimagesize($url)>0?$url:'images/noimage.jpg'; @endphp
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td><img src="{{ asset($img) }}" alt="{{ $gal->filename }}" width="125px"></td>
                                        <td>{{ $gal->title }}</td>
                                        <td>{{ \Carbon\Carbon::parse($gal->created_at)->format('d-m-Y h:i:s') }}</td>
                                        <td>{{ $gal->user['name'] }}</td>
                                        <td>{{ ($gal->status==1)?'Aktif':'Tidak Aktif' }}</td>
                                        <td class="text-center">
                                            <div class="button-group">
                                                <button class="btn btn-warning btn-sm">
                                                    <i class="mdi mdi-lead-pencil"></i> Edit
                                                </button>
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="mdi mdi-delete-empty"></i> Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                @endforeach
                                @php $i++ @endphp
                             @endif
                        </tbody>
                    </table>
                    <!-- end table style ---->
                    {!! $entries->appends(Input::except('page'))->render() !!}
                </div>
        </section>
    </div>
</div>

@endsection

@section('script')
<script>
    function changeProfile() {
        $('#file').click();
    }
    $('#file').change(function () {
        if ($(this).val() != '') {
            upload(this);

        }
    });
    function upload(img) {
        var form_data = new FormData();
        form_data.append('file', img.files[0]);
        form_data.append('_token', '{{csrf_token()}}');
        $('#loading').css('display', 'block');
        $.ajax({
            url: "{{url('ajax-image-upload')}}",
            data: form_data,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.fail) {
                    $('#preview_image').attr('src', '{{asset('images/noimage.jpg')}}');
                    alert(data.errors['file']);
                }
                else {
                    $('#file_name').val(data);
                    $('#preview_image').attr('src', '{{asset('uploads')}}/' + data);
                }
                $('#loading').css('display', 'none');
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
                $('#preview_image').attr('src', '{{asset('images/noimage.jpg')}}');
            }
        });
    }
    function removeFile() {
        if ($('#file_name').val() != '')
            if (confirm('Are you sure want to remove profile picture?')) {
                $('#loading').css('display', 'block');

            }
    }

    //cara lain modal popup dg colorbox
    //Custom Confirm Window using colorbox
    $(document).on('click','.btn-delete',function(){
                bootbox.confirm({
                    message: "Apakah Anda akan menghapus Desa Wisata ini ?",
                    buttons: {
                        confirm: {
                            label: 'Ya',
                            className: 'btn-success'
                        },
                        cancel: {
                            label: 'Tidak',
                            className: 'btn-danger'
                        }
                    },
                    callback: function (result) {
                        if(result==true){
                            var form_data = new FormData();
                            form_data.append('_method', 'DELETE');
                            form_data.append('_token', '{{csrf_token()}}');
                            $.ajax({
                                url: "ajax-remove-image/" + $('#file_name').val(),
                                data: form_data,
                                type: 'POST',
                                contentType: false,
                                processData: false,
                                success: function (data) {
                                    $('#preview_image').attr('src', '{{asset('images/noimage.jpg')}}');
                                    $('#file_name').val('');
                                    $('#loading').css('display', 'none');
                                },
                                error: function (xhr, status, error) {
                                    alert(xhr.responseText);
                                }
                            });
                        }
                    }
                });
           });
</script>

@endsection
