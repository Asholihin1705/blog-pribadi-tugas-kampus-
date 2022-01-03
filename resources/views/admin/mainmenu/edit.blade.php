@extends('admin.app')

@section('content')
    <h3>Edit Main Menu</h3>
    <hr>
    <div class="col-lg-6">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{url('admin/mainmenu/edit/'.$data->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $data->title }}">
            
            <label for="parent">Parent</label>
            <select class="form-control" name="parent" id="parent">
                <option value="0">-</option>
                @foreach ($parent as $par)
                    <option value="{{$par->id}}" {{($data->parent == $par->id) ? 'selected' : ''}}>{{$par->title}}</option>
                @endforeach
            </select>
            <label for="category">Category</label>
            <select class="form-control" name="category" id="category">
                <option value="link" {{($data->category == 'link') ? 'selected' : ''}}>Link</option>
                <option value="content" {{($data->category == 'content') ? 'selected' : ''}}>Content</option>
                <option value="file" {{($data->category == 'file') ? 'selected' : ''}}>File</option>
            </select>

            <div id="contents">
                <label for="content">Content</label>
                <textarea id="content" class="form-control" name="content" rows="10" cols="50">{{$data->content}}</textarea><br>
            </div>

            <div id="files">
                <label for="file">File</label><br>
                <img src="{{ url($data->file) }}" alt="file attachment" style="max-height: 200px; max-width: 200px;">
                <input id="file" type="file" name="file" class="form-control">
            </div>

            <div id="links">
                <label for="url">URL</label>
                <input id="url" type="text" name="url" class="form-control" value="{{ $data->url }}">
            </div>

            <label for="order">Order</label>
            <input type="number" name="order" class="form-control" value="{{ $data->order }}">

            <label for="status">Status</label>
            <select class="form-control" name="status" id="status">
                <option value="0" {{($data->status == 0) ? 'selected' : ''}}>Tidak Publish</option>
                <option value="1" {{($data->status == 1) ? 'selected' : ''}}>Publish</option>
            </select><br>
            
            <input type="submit" name="submit" class="btn btn-md btn-primary" value="Simpan Data">
            <a href="{{url('admin/mainmenu')}}" class="btn btn-warning"><i class="fas fa-chevron-circle-left"></i>Kembali</a>

        </form>
    </div>
@endsection
@section('js')
<script>
    $(document).ready(function(){
        $('#contents').hide();
        $('#links').hide();
        $('#files').hide();

        var data = $('#category').val();
        $('#'+data+'s').show();

        $('#category').on('change', function(){
            var data = $(this).val();
            $('#contents').hide();
            $('#links').hide();
            $('#files').hide();
            $('#'+data+'s').show();
        });
    });
</script>

<script src="{{url('assets/ckeditor/ckeditor.js')}}"></script>
<script>
    var content = document.getElementById("content");
    CKEDITOR.replace(content,{
        language:'en-gb'
    });
    CKEDITOR.config.allowedContent = true;
</script>
@endsection
