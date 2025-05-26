@extends('layouts.layoutnew_admin')
@php
    header("Cache-Control", "no-cache, no-store, must-revalidate");
@endphp
@section('topbar')
<!-- begin top dashboard -->
<div class="dashboard-top">
        <div class="container-fluid">
         <div class="top-entry">
          <div class="top-status">

          <h3>{!! '&nbsp;'; !!}</h3>

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
                  <a href="index.html">
                    <i class="mdi mdi-chevron-right"></i>
                    {!! isset($title_page)?$title_page:'&nbsp;'; !!}
                  </a>
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
<div class="container-fluid">
        <section class="base-content">
                    <h3>{!! isset($title_page)?$title_page:'&nbsp;'; !!}</h3>
                    <p><a href="{{ route('backend/desawisata.create') }}" class="btn btn-success"> Tambah Data</a></p>
                <div class="table-responsive">
                        <table id="dtable-desawisata" class="table table-striped table-hover table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Lokasi</th>
                            <th>Kategori</th>
                            <th>Tgl Update</th>
                            <th>Oleh</th>
                            <th width="5%">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($desawisata))
                            @foreach($desawisata['data'] as $data)
                                @php
                                        $linkEdit =  route('backend/desawisata.show',['id'=>$data['id']]);
                                        $linkDetil =  route('backend/desawisata.edit',['id'=>$data['id']]);
                                        $linkDelete =  route('backend/desawisata.destroy',['id'=>$data['id']] );

                                    $tglModif = \DateTime::createFromFormat('Y-m-d H:i:s', $data['tgl_modif']);
                                $update = $tglModif->format('d-m-Y H:i:s');
                                @endphp
                                <tr>
                                    <td>{{ $data['nama_desawisata'] }}</td>
                                    <td>{{  ucwords(strtolower($data['nama_kab'])).', Kec. '.ucwords(strtolower($data['nama_kec'])) }}</td>
                                    <td>{{ $data->Category['catname']  }}</td>
                                    <td>{{ $update  }} </td>
                                    <td>{!! 'Cecep' !!}</td>
                                    <td>
                                            <div class="btn-group" data-toggle="buttons">
                                                    <span class="badge badge-primary ">
                                                            <a href="{{ $linkEdit  }}"  role="button" aria-pressed="true"><i class="mdi mdi-square-edit-outline"></i> Edit</a>
                                                    </span>
                                                    <span class="badge badge-info">
                                                            <a href="{{ $linkDetil  }}"  role="button" aria-pressed="true"><i class="mdi mdi-eye"></i> Lihat</a>
                                                    </span>
                                                    <span class="badge badge-danger ">
                                                      <a href="{{ $linkDelete  }}"  role="button" aria-pressed="true"><i class="mdi mdi-trash-can-outline"></i> Hapus</a>
                                                    </span>
                                                  </div>

                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">Data Tidak Ditemukan</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
        </section>
    </div>

@endsection
@section('script')
<script src="{{ asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js')}}"></script>

@endsection
