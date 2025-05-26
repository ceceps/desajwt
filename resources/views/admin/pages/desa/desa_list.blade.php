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
                  <a href="index.html">
                    <i class="mdi mdi-home"></i>
                    Dashboard
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
             {!! date('d-m-Y') !!}
           </div>
         </div>
        </div>
      </div>
      <!-- end top dashboard -->
@endsection


@section('content')
       <!-- begin dashboard content -->
       <div class="dashboard-content">
            <div class="dashboard-inner-entry">
              <div class="container-fluid">
                <div class="panel-title has-option">
                   <h3>&nbsp;</h3>
                  <div class="top-option">
                    <div class="button-group">
                      <button class="btn btn-clean btn-list" type="button">
                        <i class="mdi mdi-view-list"></i>
                      </button>
                      <button class="btn btn-clean btn-grid active" type="button">
                        <i class="mdi mdi-view-grid"></i>

                    </div>
                <a href="{{ $urlCreate }}" class="btn btn-brand btn-add">
                      <i class="mdi mdi-plus"></i> Tambah Desa
                    </a>
                  </div>
                </div>
                <div class="grid-list" id="gridkonten">
                    @if(isset($profildesa))
                        @foreach($profildesa as $data)
                            @php if(count($data->media)){

                                   $foto = public_path(config('desawisata.PATH_IMAGE_PROFILDESA').'/thumb/'.$data->media[0]['filename'])!=false?URL::to('/').'/'.config('desawisata.PATH_IMAGE_PROFILDESA').'thumb/'.$data->media[0]['filename']:'images/noimage.jpg';
                                  }else
                                   $foto = 'images/noimage.jpg';

                                 $urlDetil = route('profildesa.show',$data->slug);
                                 $urlEdit = route('profildesa.edit',$data->id);
                            @endphp
                            <div class="item-thumbnail">
                                <div class="item-detail">
                                    <div class="top-thumbnail">
                                        <div class="thumbnail-title">
                                            <h3>{{ $data->Kelurahan['nama'] }}</h3>
                                        </div>
                                        <img src="{{ asset($foto) }}" alt="" class="img-fluid">
                                    </div>
                                    <div class="item-detail-text">
                                        <small>Tgl Update: {!! \Carbon\Carbon::parse($data['created_at'])->format('d-m-Y H:i:s') !!}</small><br>
                                        {{ str_replace('&nbsp;',' ',strip_tags(substr($data['deskripsi'],0,72))) }}
                                   </div>
                                    <div class="item-option">
                                        <div class="button-group">
                                            <button type="button" class="btn btn-default" onclick="location.href='{!! $urlDetil !!}'">Detil</>
                                            <button type="button" class="btn btn-default" onclick="location.href='{!! $urlEdit !!}'">Edit</button>
                                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modelId">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                 {{ $profildesa->render() }}
              </div>
            </div>


          </div>
          <!-- end dashboard content -->
@endsection
<!-- Button trigger modal -->
<button type="button" >
  Launch
</button>

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Hapus</h5></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                Apa Anda yakin akan menghapus data Profil Desa ini ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-info">OK</button>
            </div>
        </div>
    </div>
</div>
