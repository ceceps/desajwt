@extends('admin.layouts.layout_admin') @php header("Cache-Control", "no-cache, no-store, must-revalidate");
@endphp
@section('topbar')
<!-- begin top dashboard -->
<div class="dashboard-top">
    <div class="container-fluid">
        <div class="top-entry">
            <div class="top-status">
                <h3> {!! isset($title_page)?$title_page:'&nbsp;'; !!}</h3>
                <!-- for single action page remove this breadcrumb-->
                <nav class="dashboard-breadcrumb">
                    <ul class="list-unstyled">
                        <li>
                            <a href="index.html">
                    <i class="mdi mdi-home"></i>
                    Beranda
                  </a>
                        </li>

                        <li>
                            <i class="mdi mdi-chevron-right"></i> {!! isset($title_page)?$title_page:'&nbsp;'; !!}
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

@section('script')
<link rel="stylesheet" href="{{ asset('styles/dataTables.bootstrap4.min.css')}} ">
<link rel="stylesheet" href="{{ asset('styles/dataTables.material.min.css')}} ">
@endsection

@section('content')
<div class="container-fluid">
    <section class="base-content">
        <p>
            <a href="{{ url('backend/artikel/create') }}" class="btn btn-success"> Tambah Artikel</a>
            <a href="{{ url('backend/kategoriartikel/') }}" class="btn btn-info"> Kategori Artikel</a>
        </p>
      @include('admin.partial.message')
        <div class="table-responsive">
            <table id="dtable-artikel" class="table table-striped table-hover table-bordered datatables" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Judul</th>
                        <th class="text-center">Kategori</th>
                        <th class="text-center">Tgl Update</th>
                        <th class="text-center">Oleh</th>
                        <th class="text-center">Status</th>
                        <th width="5%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($artikel))
                        @php $i=0; @endphp
                    @foreach($artikel as $data)
                    @php
                        $linkEdit = url('backend/artikel/'.$data['id'].'/edit');
                        $linkDetil = url('/artikel/'.$data['slug']);
                        $linkDelete = url('backend/artikel/destroy',['id'=>$data['id']]
                        );

                        $tglUpdate = new DateTime($data['updated_at']);
                        // $updateTgl = $tglUpdate->format('d M Y');
                        // $updateJam = $updateTgl->format('h:i:s');
                        $update = $tglUpdate->format('d-m-Y H:i:s'); //dd($updateTgl);
                        if($data->status==0)
                           $status = 'Draft';
                        else if($data->status==2)
                          $status = 'Trash';
                        else
                         $status = 'Aktif';
                    @endphp
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $data['judul'] }}</td>
                        <td>{{ ucwords(strtolower($data->kategori_artikel['nama'])) }}</td>
                        <td>{{ $update }} </td>
                        <td>{!! $data->User['name'] !!}</td>
                        <td>{{ __($status) }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ $linkDetil }}"  target="blank">
                                    <span class="badge badge-info">
                                        <i class="mdi mdi-eye"></i> Lihat
                                    </span>
                                </a>
                                <span class="badge badge-primary ">
                                  <a href="{{ $linkEdit  }}"><i class="mdi mdi-square-edit-outline"></i> Edit</a>
                                </span>
                                <span class="badge badge-danger ">
                                    <a href="#" {{ $linkDelete  }}  data-toggle="modal" data-target="#modelId"><i class="mdi mdi-trash-can-outline"></i> Hapus</a>
                                </span>

                                <!-- Modal -->
                                <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Hapus Artikel</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                            </div>
                                            <div class="modal-body">
                                                Apa Anda yakin akan menghapus Artikel ini ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn" data-dismiss="modal">Tidak</button>
                                                <button type="button" class="btn btn-info">Ya</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                    @endforeach {{ $artikel->render() }} @else
                    <tr>
                        <td colspan="6">
                            <div class="text-center">Data Artikel Masih Kosong</div>
                        </td>
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

<script>
    var setDataTable = function(){
        var urlproduk = '{{ route('artikel.index') }}'
        $('.tbl_artikel').DataTable({
            "pageLength": 10,
            "ajax":{
            "url": urlproduk,
            "type": "GET"
            },
            "columns": [
                objNomor,
                { "data": "r_produk__nhm" },
                { "data": "r_produk__id" },
                { "data": "r_produk__matname" }
            ],
            "columnDefs": [
                { "width": "2%", "targets": 0 },
                { "width": "5%", "targets": 1 },
                { "width": "10%", "targets": 2 },
                { "width": "83%", "targets": 3 }
            ]
        });
    }

    setDataTable();

</script>
@endsection
@section('script')
<script>
    $(".alert").alert();
  </script>
@endsection
