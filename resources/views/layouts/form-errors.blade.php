@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show   m-alert m-alert--air" style="border-radius: 0" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        </button>
        @foreach ($errors->all() as $error)
            <strong>Error: </strong> {{ $error }}<br>
        @endforeach
    </div>
@endif