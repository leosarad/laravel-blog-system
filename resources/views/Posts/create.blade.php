@extends('layout.layout')
@section('body')
<div class="msg msg-success"></div>
<div class="msg msg-error"></div>

<div class="myContainer formContainer">
    <form action="/posts" method="POST" id='postForm' class='post-item'>
    @csrf
      <h2>Create Blog</h2>
      @include('include.messages')
      <div class="form-group">
        <label for="title"><h6>Title</h6></label>
        <input type="text" class='form-control is-valid' name="title" id="title" placeholder="Enter Title">
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>
      <div class="form-group">
        <h6>THumbnail</h6>
        <input type="file" name="thumbnail" id="thumbnail" value="Choose Thumnail">
      </div>
      <div class="form-group">
      <label for="title"><h6>Body</h6></label>
        <div id="editor" >
          <p>
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Similique nesciunt quam, eveniet magni numquam veniam et laborum pariatur minus sunt beatae impedit voluptatibus, assumenda placeat earum, delectus quae vel atque.
          </p>
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