@extends('frontend.layouts.layouts_front')
@section('content')
<section class="top-feature inner">
        <img src="{{ asset($foto) }}" alt="" class="img-fluid">
        <div class="feat-title">
          <h1>  {!! $halaman->judul !!}</h1>

        </div>
      </section>
      <section class="front-inner">
        <div class="container">
        <div class="front-breadcrumb">
            <ul class="list-unstyled">
              <li>
                <a href="index.html">Beranda</a>
              </li>
              <li>
                /   {!! $halaman->judul !!}
              </li>
            </ul>
          </div>
          <div class="top-description">
           <div class="row">
             <div class="col-xl-12 col-lg-12 col-md-12">

                 {!! $halaman->konten !!}

             </div>
           </div>
          </div>
        </div>
      </section>
@endsection
