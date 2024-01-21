@if (Session::has('message'))
    <div class="alert alert-primary alert-dismissible" role="alert">
        <p>{{ Session::get('message') }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif