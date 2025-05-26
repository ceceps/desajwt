@include('admin.partial.header_admin')
<div class="dashboard">
    @include('admin.partial.aside')
    <div class="dashboard-entry">
      <main class="main-wrap">
        <header class="main-header">
          <div class="container-fluid">
            @include('admin.partial.topnav_admin')
          </div>
        </header>
        <div class="main-content">
          @yield('topbar')
          @yield('content')
        </div>
        <footer class="main-footer">
          <div class="text-center">
            Disparbud @ 2018, Desa Wisata Jawa Barat
          </div>
        </footer>
      </main>
    </div>
</div>

@include('admin.partial.mobilemenu')

<script src="{{ asset('scripts/jquery-2.1.3.min.js') }}"></script>
{{-- <script src="{{ asset('scripts/lib/jquery-3.3.1.min.js') }}"></script> --}}
<script src="{{ asset('scripts/lib/popper.min.js') }}"></script>
<script src="{{ asset('scripts/bootstrap.min.js') }}"></script>
<script src="{{ asset('scripts/lib/moment.min.js') }}"></script>
<script src="{{ asset('scripts/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('scripts/lib/select2.full.min.js') }}"></script>
{{-- <script src="{{ asset('scripts/lib/bootstrap-wysiwyg.min.js') }}"></script> --}}
{{-- <script src="{{ asset('scripts/lib/datatables.js') }}"></script> --}}
<script src="{{ asset('scripts/option.js') }}"></script>
<script src="{{ asset('scripts/lib/main.min.js') }}"></script>
<script src="{{ asset('scripts/js.cookie.min.js') }}"></script>
@include('admin.partial.varscript')
@include('sweetalert::cdn')
@include('sweetalert::view')
<script src="{{ asset('scripts/desawisata-admin.js') }}"></script>


@yield('script')
</body>

</html>
