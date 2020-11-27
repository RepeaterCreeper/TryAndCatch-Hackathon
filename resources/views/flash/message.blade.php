@if (session()->has('message'))
    <div class="alert alert-success my-2">
        {{session()->get('message')}}
    </div>
@elseif (session()->has('error'))
    <div class="alert alert-danger my-2">
        {{session()->get('error')}}
    </div>
@endif
