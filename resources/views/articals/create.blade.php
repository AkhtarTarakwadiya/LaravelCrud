@extends('articals.layouts')

@section('content')
    <div class="container">
        <form action="{{ route('articals.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Title:</strong>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="Title">
                        @error('title')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <strong>Content:</strong>
                        <textarea class="form-control" style="height:150px" name="content" placeholder="Content">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <strong>Image:</strong>
                        <input type="file" name="image" class="form-control">
                        @error('image')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <strong>Slug:</strong>
                        <input type="text" name="slug" value="{{ old('slug') }}" class="form-control" placeholder="Slug">
                        @error('slug')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="form-group">
                        <strong>User ID:</strong>
                        <input type="number" name="user_id" class="form-control" placeholder="User ID">
                        @error('user_id')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </div>

                </div>
            </div>
</form>
@endsection