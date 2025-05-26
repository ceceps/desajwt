@extends('admin.layouts.layout_admin')
@section('content')
    <div class="form-group">
      <label for="">Bantun</label>
      <select class="form-control select2" name="" id="">
        <option></option>
      </select>
    </div>
@endsection
@section('script')

    <script>
        var data = '[{"text":"program kerja","id":0,"text":"program kerja npm","id":1}]';
        var json = JSON.stringify(data);

        $('.select2').select2({
            data: json
        });
    </script>

@endsection
