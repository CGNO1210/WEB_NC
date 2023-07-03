@if ($errors->any())
    <div class="alert mt-4 alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(Session::has('error'))
    <div class="alert mt-4 alert-danger">
        <p>{{ Session::get('error') }}</p>
    </div>
@endif
@if(Session::has('success'))
    <div class="alert mt-4 alert-success">
        <p>{{ Session::get('success')}}</p>
    </div>
@endif
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
    window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 2500);
</script>