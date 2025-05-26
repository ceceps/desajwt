@if(session('errors'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </button>
            <p> <ul>
                @if(isset($errors))
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                @else
                 <li>{{ session('error') }}</li>
                @endif
            </ul></p>
        </div>
        @endif @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
            <p>{{ session('success') }}</p>
        </div>
@endif
