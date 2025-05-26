@extends('layouts.layouts_admin')
@php
    header("Cache-Control", "no-cache, no-store, must-revalidate");
@endphp
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Data Desa Wisata</h2>&nbsp;&nbsp;
                    <a href="{{ route('desawisata.create') }}" class="btn btn-success"> ADD</a>
                    <ul class="nav">
                        <li></li>
                    </ul>
                </div>
                <div class="x_content">

                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>IDCAT</th>
                                    <th>ID Class</th>
                                    <th>Parent ID</th>
                                    <th>Nama Kategori</th>
                                    <th>Nama Kategori EN</th>
                                    <th>Nama Kategori JP</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($cat) and count($cat)>0)
                                    @php
                                    $i=0
                                    @endphp
                                    @foreach($cat['data'] as $category)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $category['idcat'] }}</td>
                                            <td>{{ $category['idclass'] }}</td>
                                            <td>{{ $category['parentid'] }}</td>
                                            <td>{{ $category['catname'] }}</td>
                                            <td>{{ $category['catnameen'] }}</td>
                                            <td>{{ $category['catnamejp'] }}</td>
                                            <td>{{ $category['narasi'] }}</td>
                                            <td>EDIT-DELETE</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>

                </div>
            </div>
        </div>
    </div>
@endsection