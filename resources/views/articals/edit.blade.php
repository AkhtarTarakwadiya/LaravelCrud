@extends('articals.layouts')


@section('content')
    <div class="container">
        <form action="{{ route('articals.update', $artical->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Title:</strong>
                        <input type="text" name="title" value="{{ $artical->title }}" class="form-control" placeholder="Title">
                        @error('title')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <strong>Content:</strong>
                        <textarea class="form-control" style="height:150px" name="content" placeholder="Content">{{ $artical->content }}</textarea>
                        @error('content')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <strong>Image:</strong>
                        <input type="file" name="image" class="form-control">
                        @if($artical->image_path)
                            <img src="{{ asset('storage/' . $artical->image_path) }}" alt="{{ $artical->title }}" width="100" class="mt-2">
                        @endif
                        @error('image')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <strong>Slug:</strong>
                        <input type="text" name="slug" value="{{ $artical->slug }}" class="form-control" placeholder="Slug">
                        @error('slug')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>  
@endsection