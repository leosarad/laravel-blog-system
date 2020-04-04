@if(count($errors)>0)
@foreach($errors->all() as $error)
    <div class="msg msg-danger">{{$error}}</div>
@endforeach
@endif

@if(session('success'))
    <div class="msg msg-success">{{session('success')}}</div>
@endif


@if(session('error'))
    <div class="msg msg-danger">{{session('error')}}</div>
@endif
