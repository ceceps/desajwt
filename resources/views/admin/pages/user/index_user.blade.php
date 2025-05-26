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
                            <a href="{{ route('dashboard') }}">
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
    <a href="{{ route('backend.user.create') }}" class="btn btn-success"> Tambah Pengguna</a>
        <p class="title-helper">&nbsp</p>
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                <strong>Berhasil</strong>
                {{ session('success') }}
            </div>
        @endif

        <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Aktif</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Tidak Aktif</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Diblokir</a>
                </li>

              </ul>

              <div class="tab-content">
                <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <!-- begin datatable style ---->
                    <div class="panel-clean">
                    <table id="c" class="table table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Hak Akses</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Telp</th>
                                <th class="text-center">Tgl Terdaftar</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($users)) @foreach ($users as $usr) @php switch($usr->status){ case 0: $staus = 'Tidak Aktif'; break; case 1: $status
                            = 'Aktif'; break; case 2: $status = 'Diblokir'; break; } $role=[]; if(count($usr->roles)>0){ foreach($usr->roles
                            as $roles){ $role[] = ucwords(strtolower(str_replace('_',' ',$roles->name))); } }
                             @endphp
                            <tr>
                                <td>{{ $usr->name }}</td>
                                <td>{{ implode(', ',$role) }}</td>
                                <td>{{ $usr->email }}</td>
                                <td>{{ $usr->telp }}</td>
                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $usr->created_at)->format('d-m-Y H:i:s') }}</td>
                                <td>{{ $status }}</td>
                                <td>
                                    <button type="button" class="badge badge-pill badge-info" onclick="window.location='{{ route('backend.user.edit',$usr->id) }}'">Edit</button>
                                    @if(!in_array('Superadmin',$role))
                                        <form action="{{route('backend.user.softdelete', $usr->id)}}" method="post">
                                            @csrf
                                            <button class="badge badge-pill badge-danger" type="submit" data-name="{{ $usr->name }}" id="deleteButton">Hapus</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach @else
                            <tr>
                                <td colspan="7" class="text-center">Data User belum Tersedia</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <!-- end datatable style ---->

                     </div>
                </div>
                <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                      <!-- begin datatable style ---->
                    <table class="dtable table table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Hak Akses</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Telp</th>
                                    <th class="text-center">Tgl Terdaftar</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($userstdkaktif))
                                     @foreach ($userstdkaktif as $usrta)
                                     @php
                                        switch($usrta->status){ case 0: $status = 'Tidak Aktif'; break; case 1: $status
                                = 'Aktif'; break; case 2: $status = 'Diblokir'; break;
                                        }
                                        $role=[];
                                        if(count($usrta->roles)>0){
                                            foreach($usrta->roles
                                            as $roles){ $role[]= ucwords($roles->name);
                                            }
                                        }
                                    @endphp
                                <tr>
                                    <td>{{ $usrta->name }}</td>
                                    <td>{{ implode(', ',$role) }}</td>
                                    <td>{{ $usrta->email }}</td>
                                    <td>{{ $usrta->telp }}</td>
                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $usrta->created_at)->format('d-m-Y H:i:s') }}</td>
                                    <td>{{ $status }}</td>
                                    <td>
                                        <button type="button" class="badge badge-pill badge-info" onclick="window.location='{{ route('backend.user.edit',$usrta->id) }}'">Edit</button>
                                        <form action="{{route('backend.user.softdelete', $usrta->id)}}" method="post">
                                            @csrf
                                            <button class="badge badge-pill badge-danger" type="submit" data-name="{{ $usrta->name }}" id="deleteButton">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach @else
                                <tr>
                                    <td colspan="7" class="text-center">Data User Blokir belum Tersedia</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        <!-- end datatable style ---->

                </div>
                <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                    <!-- begin datatable style ---->
                    <table class="dtable table table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Hak Akses</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Telp</th>
                                    <th class="text-center">Tgl Terdaftar</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($userblokir))
                                     @foreach ($userblokir as $usrblo)
                                        @php
                                            switch($usrblo->status){ case 0: $status = 'Tidak Aktif'; break; case 1: $status
                                    = 'Aktif'; break; case 2: $status = 'Diblokir'; break;
                                            }
                                            $role=[];
                                            if(count($usrblo->roles)>0){
                                                foreach($usrblo->roles
                                                as $roles){ $role[]= ucwords($roles->name);
                                                }
                                            }
                                        @endphp
                                    <tr>
                                        <td>{{ $usrblo->name }}</td>
                                        <td>{{ implode(', ',$role) }}</td>
                                        <td>{{ $usrblo->email }}</td>
                                        <td>{{ $usrblo->telp }}</td>
                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $usrta->created_at)->format('d-m-Y H:i:s') }}</td>
                                        <td>{{ $status }}</td>
                                        <td>
                                            <button type="button" class="badge badge-pill badge-info" onclick="window.location='{{ route('backend.user.edit',$usrblo->id) }}' ">Edit</button>
                                            <form action="{{route('backend.user.delete', $usrblo->id)}}" method="post">
                                                @csrf
                                                <button class="badge badge-pill badge-danger" type="submit" data-name="{{ $usrblo->name }}" id="deleteButton">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                <tr>
                                    <td colspan="7" class="text-center">Data User Blokir belum Tersedia</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        <!-- end datatable style ---->



                </div>

              </div>
            </div>
      </section>

@endsection
@section('script')
    <script>
        $(function(){
            $('#myTab li:first-child a').tab('show');

            $('#deleteButton').on('click', function(e){
                e.preventDefault()
            var name = $(this).data('name');
            swal({
                title: "Careful!",
                text: "Are you sure you want to delete "+name+"?",
                icon: "warning",
                dangerMode: true,
                buttons: {
                cancel: "Exit",
                confirm: "Confirm",
                },
            })
            .then ((willDelete) => {
                if (willDelete) {
                $(this).closest("form").submit();
                }
            });
            });
        });

    </script>
@endsection

