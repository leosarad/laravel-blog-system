@extends('layout.layout')
@section('body')
<div class="myContainer formContainer">
    <form id='postEditForm' postId="{{$post->id}}" class='post-item'>
    @csrf
      <h2>Update Blog</h2>
      @include('include.messages')
      <div class="form-group">
        <label for="title"><h5>Title</h5></label>
        <input type="text" class='form-control is-valid' name="title" id="title" placeholder="Enter Title" value="{{$post->title}}">
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>
      <div class="form-group">
        <div id="editor" >
         {!!$post->body!!}
        </div>
      </div>
      <div class="form-group">
        <button type="submit" name='submit' class="form-control btn btn-primary mb-2">Save</button>
      </div>
    </form>
  </div>
@endsection
@section('scripts')
<script>
var quill = new Quill('#editor', {
    theme: 'snow'
});
</script>
@endsection