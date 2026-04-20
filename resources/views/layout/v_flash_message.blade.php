@if(session('success') == true)
    <div class="alert alert-success" role="alert">
        <i class="fa-solid fa-circle-info mr-2"></i>{{ session('message') }}
    </div>
@elseif(session('success') == false and !empty(session('message')))
    <div class="alert alert-danger" role="alert">
        <i class="fa-solid fa-circle-info mr-2"></i>{{ session('message') }}
    </div>
@endif
