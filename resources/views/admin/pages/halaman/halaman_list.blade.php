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
            <a href="{{ url('backend/halaman/create') }}" class="btn btn-success"> Tambah halaman</a>
        </p>
      @include('admin.partial.message')
        <div class="table-responsive">
            <table id="dtable-halaman" class="table table-striped table-hover table-bordered datatables" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Judul</th>
                        <th class="text-center">Tgl Update</th>
                        <th class="text-center">Oleh</th>
                        <th class="text-center">Status</th>
                        <th width="5%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($halaman) && $halaman!=null)
                        @php $i=0; @endphp
                    @foreach($halaman as $data)
                    @php
                        $linkEdit = url('backend/halaman/'.$data['id'].'/edit');
                        $linkDetil = url('/halaman/'.$data['slug']);
                        $linkDelete = url('backend/halaman/destroy',['id'=>$data['id']]
                        );

                        $tglUpdate = new DateTime($data['updated_at']);
                        $update = $tglUpdate->format('d-m-Y H:i:s');
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
                        <td>{{ $update }} </td>
                        <td>{!! $data->User['name'] !!}</td>
                        <td>{{ __($status) }}</td>
                        <td>
                            <div class="btn-group">

                                    <span class="badge badge-info">
                                        <a href="{{ $linkDetil }}"  target="blank">  <i class="mdi mdi-eye"></i> Lihat   </a>
                                    </span>

                                <span class="badge badge-primary ">
                                   <a href="{{ $linkEdit  }}"><i class="mdi mdi-square-edit-outline"></i> Edit</a>
                                 </span>

                                <form action="{{ route('halaman.destroy', $data['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="badge badge-danger button"><i class="mdi mdi-trash-can-outline"></i> Hapus</button>
                                </form>

                            </div>

                        </td>
                    </tr>
                    @endforeach {{ $halaman->render() }} @else
                    <tr>
                        <td >
                            <div class="text-center">Data halaman Masih Kosong</div>
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
        var urlproduk = '{{ route('halaman.index') }}'
        $('.tbl_halaman').DataTable({
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
    $('.button').on('click',function(){
        Swal.fire({
            title: 'Anda Yakin?',
            text: 'Apakah Anda yakin akan menghapus Kategori ini',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
            }).then((result) => {
            if (result.value) {
                Swal.fire(
                'Terhapus!',
                'Apakah Anda yakin akan menghapus Kategori ini',
                'success'
                )
            // For more information about handling dismissals please visit
            // https://sweetalert2.github.io/#handling-dismissals
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
                )
            }
            });

    });
    $(".alert").alert();
  </script>
@endsection
