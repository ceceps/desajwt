@extends('admin.layouts.layout_admin')
@section('topbar')
<!-- begin top dashboard -->
<div class="dashboard-top">
        <div class="container-fluid">
         <div class="top-entry">
          <div class="top-status">
          <h3>{!! isset($title_page)?$title_page:'&laquo;'; !!}</h3>
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
<div id="list-example" class="list-group">
    <a class="list-group-item list-group-item-action" href="#list-item-1">Item 1</a>
    <a class="list-group-item list-group-item-action" href="#list-item-2">Item 2</a>
    <a class="list-group-item list-group-item-action" href="#list-item-3">Item 3</a>
    <a class="list-group-item list-group-item-action" href="#list-item-4">Item 4</a>
  </div>
  <div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-example">
    <h4 id="list-item-1">Item 1</h4>
    <p>isi dari item 1</p>
    <h4 id="list-item-2">Item 2</h4>
    <p>isi dari item 2</p>
    <h4 id="list-item-3">Item 3</h4>
    <p>isi dari item 3</p>
    <h4 id="list-item-4">Item 4</h4>
    <p>isi dari item 4</p>
  </div>
@endsection
