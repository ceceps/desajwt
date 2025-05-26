@extends('admin.layouts.layout_admin')
@php
    header("Cache-Control", "no-cache, no-store, must-revalidate");
@endphp

@section('topbar')
    <!-- begin top dashboard -->
    <div class="dashboard-top">
        <div class="container-fluid">
            <div class="top-entry">
                <div class="top-status">
                    <h3>{!! isset($title_page)?$title_page:'&nbsp'; !!}</h3>
                    <!-- for single action page remove this breadcrumb-->
                    <nav class="dashboard-breadcrumb">
                        <ul class="list-unstyled">
                            <li>
                                    <a href="{{ route('dashboard') }}">
                                    <i class="mdi mdi-home"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                              <a href="{{ route('kategoriartikel.index') }}">
                                    <i class="mdi mdi-home"></i>
                                    Kategori Artikel
                                </a>
                            </li>
                            <li>
                                <i class="mdi mdi-chevron-right"></i>
                                {!! isset($title_page)?$title_page:'&nbsp;'; !!}
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
            <div class="panel clean">
                <!-- begin form style ---->
                <div class="form-based">
                    <div class="top-form">
                        <h4 class="form-title">{{ $title_page }}</h4>
                        <p class="title-helper">Harap masukan semua input</p>
                    </div>

                    @if (session('error'))
                    <div class="alert alert-danger  alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p>@php
                           $error = json_decode(session('error'));
                           $i=0;
                           foreach($error as $er){
                             echo($er[$i]);
                             $i++;
                           }
                           @endphp
                        </p>
                    </div>
                    @endif @if (session('success'))
                    <div class="alert alert-success  alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        <p>{{ session('success') }}</p>
                    </div>
                    @endif
                <form class="form-custom" action="{{ route('kategoriartikel.update',$kategori->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label class="control-label">Nama Kategori<em class="asterix">*</em></label>
                            <input type="text" class="form-control" placeholder="contoh: batununggal" name="nama" value="{{ isset($kategori->nama)?$kategori->nama:'' }}">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Slug <em class="asterix">*</em></label>
                            <input type="text" class="form-control" placeholder="contoh: batununggal" name="slug" value="{{ isset($kategori->slug)?$kategori->slug:'' }}"">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="id" value="{{ isset($kategori->id)?$kategori->id:'' }}">
                            <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                            <button type="button" class="btn">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>

@endsection
@section('script')
<script>
    $(".alert").alert();
  </script>
@endsection
