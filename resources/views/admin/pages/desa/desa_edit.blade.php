@extends('admin.layouts.layout_admin') @php header("Cache-Control", "no-cache, no-store, must-revalidate");
@endphp
@section('style')
<link rel="stylesheet" href="{{ asset('scripts/lib/datatable/editor.dataTables.min.css') }}" />
<link rel="stylesheet" href="{{ asset('scripts/lib/datatable/responsive.bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('scripts/lib/datatable/select.dataTables.min.css') }}" />
@endsection

@section('topbar')
<!-- begin top dashboard -->
<div class="dashboard-top">
    <div class="container-fluid">
        <div class="top-entry">
            <div class="top-status">
                <h3>{!! isset($title_page)?$title_page:'&nbsp;'; !!}</h3>
                <!-- for single action page remove this breadcrumb -->
                <nav class="dashboard-breadcrumb">
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{ route('dashboard') }}">
                                <i class="mdi mdi-home"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profildesa.index') }}">
                                <i class="mdi mdi-chevron-right"></i> Profil Desa
                            </a>
                        </li>
                        <li>
                            <i class="mdi mdi-chevron-right"></i> {!! isset($title_page)?$title_page:'&nbsp;'; !!}
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="top-option">{!! date('d-m-Y') !!}</div>
        </div>
    </div>
</div>
<!-- end top dashboard -->
@endsection

@section('content')
@if($profdesa!=null)
@php
$url =
isset($profdesa->filenameURL)?URL::to('/').'/'.config('desawisata.PATH_IMAGE_profdesa').$profdesa->filename:public_path('images/noimage.jpg');
$foto = getimagesize($url)!=false?$url:'images/noimage.jpg';
$foto = isset($profdesa['foto'])?'storage/data-profdesa/'.$profdesa['foto']:'images/noimage.jpg';
@endphp
@else
<p>Data Desa Tidak Tersedia</p>
@endif

<!-- begin dashboard content -->
<div class="dashboard-content">
    <div class="dashboard-inner">
        <div class="container-fluid">
            @include('admin.partial.message')
            <form class="form-custom has-category" action="{{ route('profildesa.update',$profdesa) }}" method="post"
                id="form-desawisata" enctype="multipart/form-data">
                @csrf
                @method('put')
                <ul class="nav nav-tabs responsive" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="profil-tab" data-toggle="tab" href="#profil" role="tab"
                            aria-controls="profil" aria-selected="true">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="penduduk-tab" data-toggle="tab" href="#penduduk" role="tab"
                            aria-controls="penduduk" aria-selected="false">Penduduk & Pendidikan</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="penghargaan-tab" data-toggle="tab" href="#penghargaan" role="tab"
                            aria-controls="penghargaan" aria-selected="false">Penghargaan</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="profil" role="tabpanel" aria-labelledby="profil-tab">
                       @include('admin.pages.desa.desa_profil_edit')
                    </div>
                    <div class="tab-pane fade" id="penduduk" role="tabpanel" aria-labelledby="penduduk-tab">
                        @include('admin.pages.desa.pendidikan')
                        @include('admin.pages.desa.penduduk')
                    </div>
                    <div class="tab-pane fade " id="penghargaan" role="tabpanel" aria-labelledby="penghargaan-tab">
                        @include('admin.pages.desa.penghargaan')
                    </div>
                </div>
                <div class="button-action outer">
                        <button type="submit" class="btn btn-default brand">
                          Simpan
                        </button>
                        <button type="button" class="btn btn-default btn-flat">
                          Batal
                        </button>
                      </div>

            </form>
        </div>
    </div>
    @endsection


    @section('script')
    <script src="{{ asset('scripts/lib/tinymce/tinymce.min.js')}}"></script>
    <script src="{{ asset('scripts/lib/tinymce/langs/id.js')}}"></script>
    <script src="{{ asset('scripts/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('scripts/lib/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('scripts/lib/formvalidation/js/formValidation.min.js') }}"></script>
    <script src="{{ asset('scripts/lib/formvalidation/js/framework/bootstrap4.min.js') }}"></script>
    <script src="{{ asset('scripts/lib/formvalidation/js/language/id_ID.js') }}"></script>
    <script>
        tinymce.init({
        selector: '#deskripsi',
        height: 300,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor textcolor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code help wordcount'
        ],
        toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | code | wodcount | help',
        content_css: [
            '{{ asset('styles/fonts.css') }}',
            '{{ asset('styles/codepen.min.css') }}']
    });

    $(function($){
        $('.select2').select2();

         $.get('{{ route('desa.get.pendidikan',$profdesa->id) }}',function(res){
        console.log(res);

        });
    });

         // Activate an inline edit on click of a table cell



    </script>
    @endsection
