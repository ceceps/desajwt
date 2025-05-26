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
                    {!! date('d-m-Y H:i:s') !!}
                </div>
            </div>
        </div>
    </div>
    <!-- end top dashboard -->
@endsection

@section('content')
<div class="container-fluid">
    <section class="base-content">
        <p>
            <a href="{{ route('kategoriartikel.create') }}" class="btn btn-success"> Tambah Kategori</a>
        </p>
        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
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
        <div class="table-responsive">
            <table id="dtable-kategoriartikel" class="table table-striped table-hover table-bordered datatables" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th class="text-center">Nama Kategori</th>
                        <th class="text-center">Slug</th>
                        <th width="5%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($kategoriartikel))
                        @php $i=0; @endphp
                    @foreach($kategoriartikel as $data)
                    @php
                        $linkEdit = url('backend/kategoriartikel/'.$data['id'].'/edit');
                        $linkDelete = url('backend/kategoriartikel/destroy',['id'=>$data['id']]);

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
                        <td>{{ $data['nama'] }}</td>
                        <td>{!! $data['slug'] !!}</td>
                        <td>
                            <div class="btn-group">
                                <span class="badge badge-info">
                                  <a href="{{ $linkEdit  }}"><i class="mdi mdi-square-edit-outline"></i> Edit</a>
                                </span>
                                &nbsp;
                                <span class="badge badge-warning">
                                  <a href="{{ $linkDelete  }}" class="button"><i class="mdi mdi-trash-can-outline"></i> Hapus</a>
                                </span>
                            </div>
                        </td>
                    </tr>
                    @endforeach {{ $kategoriartikel->render() }} @else
                    <tr>
                        <td colspan="6">
                            <div class="text-center">Data kategori Artikel Masih Kosong</div>
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

<script>
    $(".alert").alert();

    $(document).on('click', '.button', function (e) {
    e.preventDefault();
    var id = $(this).data('id');

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
        // swal({
        //     title: "Anda Yakin?",
        //     text: "Kategori ini akan dihapus",
        //     type: "warning",
        //     showCancelButton: true,
        //     confirmButtonClass: "btn-danger",
        //     confirmButtonText: "Ya, Hapus saja!",
        //     cancelButtonText: "Tidak, batal hapus",
        //     closeOnConfirm: false,
        //     closeOnCancel: false
        //     },
        //     function(isConfirm) {
        //     if (isConfirm) {
        //         $.ajax({
        //                     type: "DELETE",
        //                     url: "{{ url('backend/kategoriartikel') }}"+id, // since your route has /{id}
        //                     success: function (data) {
        //                         swal("Deleted!", "Your imaginary file has been deleted.", "success");
        //                     }
        //                 });

        //     }
        //     });

    });

    });


  </script>
@endsection
