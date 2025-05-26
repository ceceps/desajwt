@extends('admin.layouts.layout_admin')
@section('content')
 <div class="search-page">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-3">
          <aside class="search-filter">

            <div class="filter-box">
              <h4>Di Halaman</h4>
              <ul class="list-unstyled">
                <li>
                  <a href="#0">
                    Semua
                    <span class="badge badge-pill">{!! $totalResult !!}</span>
                  </a>
                </li>
                @if($jumdesawisata>0)
                <li>
                  <a href="#0">
                   Desa Wisata
                  <span class="badge badge-pill">{{ $jumdesawisata }}</span>
                  </a>
                </li>
               @endif
               @if($jumprofiledesa>0)
                <li>
                  <a href="#0">
                    Proil Desa
                    <span class="badge badge-pill">{{ $jumprofiledesa }}</span>
                  </a>
                </li>
                @endif
                @if($jumartikel>0)
                <li>
                  <a href="#0">
                    Artikel
                    <span class="badge badge-pill">{{ $jumartikel }}</span>
                  </a>
                </li>
                @endif
              </ul>
            </div>
          </aside>
        </div>
        <div class="col-lg-9 col-md-9">
          <div class="top-result">
          Tampil hasil <strong>{!! $begPage !!}-{!! $endPage !!}</strong> dari <strong>{!! $totalResult !!}</strong> untuk pencarian <strong>'{{$request->get('search_text') }}'</strong>
          </div>
          <div class="result-inner">
              @if(!empty($currentPageSearchResults))
               @foreach($currentPageSearchResults as $res)
               @php
                   switch($res->source){
                       case 'desawisata' : $url = route('desawisata.show',$res->slug); $urlindex = route('desawisata.index'); break;
                       case 'profildesa' : $url = route('profildesa.show',$res->slug); $urlindex = route('profildesa.index'); break;
                       case 'artikel' : $url = route('front.artikel.show',$res->slug); $urlindex = route('front.artikel'); break;
                   }
               @endphp
                   <div class="result-item">
                   <a href="{!! $url !!}">
                       {{-- <h3>New waterboom in <span>Bandung</span> on January 2019</h3> --}}
                       <h3>{!! $res->nama !!}</h3>
                   </a>
               <a href="{!! $url !!} " class="search-url">{!! $url !!}</a>
                   <p>
                           {!! substr($res->deskripsi,0,320) !!}...
                   </p>
               <a href="{!! $urlindex !!}" class="search-category"> {!! $res->source !!}</a>
                   </div>

               @endforeach
               {!! $entries->appends(Input::except('page'))->render() !!}

           @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
