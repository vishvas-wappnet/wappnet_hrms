@if(Session::get('success', false))
    <?php $data = Session::get('success'); ?>
    @if (is_array($data))
        @foreach ($data as $msg)
            <div class="alert alert-success" role="alert">
               
                {{ $msg }}
            </div>
        @endforeach
    @else
        <div class="alert  alert-success" role="alert">
           
            {{ $data }}
        </div>
    @endif
@endif

