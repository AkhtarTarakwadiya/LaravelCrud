@extends('articals.layouts')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-custom">
                <div class="card-header bg-white py-3">
                    <h2 class="page-title mb-0"><i class="fas fa-edit me-2"></i>Edit Article</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('articals.update', $artical->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-4">
                                    <label for="title" class="form-label fw-semibold">Title</label>
                                    <input type="text" name="title" value="{{ $artical->title }}" class="form-control form-control-custom" placeholder="Enter article title">
                                    @error('title')
                                        <div class="alert alert-danger alert-custom mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group mb-4">
                                    <label for="content" class="form-label fw-semibold">Content</label>
                                    <textarea class="form-control form-control-custom" style="height:150px" name="content" placeholder="Enter article content">{{ $artical->content }}</textarea>
                                    @error('content')
                                        <div class="alert alert-danger alert-custom mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group mb-4">
                                    <label for="image" class="form-label fw-semibold">Image</label>
                                    <input type="file" name="image" class="form-control form-control-custom" id="imageInput">
                                    @if($artical->image_path)
                                        <div class="mt-2">
                                            <p class="mb-1">Current Image:</p>
                                            <img src="{{ asset('storage/' . $artical->image_path) }}" alt="{{ $artical->title }}" class="image-preview" width="150">
                                        </div>
                                    @endif
                                    <div id="imagePreview" class="mt-2"></div>
                                    @error('image')
                                        <div class="alert alert-danger alert-custom mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group mb-4">
                                    <label for="slug" class="form-label fw-semibold">Slug</label>
                                    <input type="text" name="slug" value="{{ $artical->slug }}" class="form-control form-control-custom" placeholder="Enter URL slug">
                                    @error('slug')
                                        <div class="alert alert-danger alert-custom mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group d-flex justify-content-between align-items-center mt-4">
                                    <a href="{{ route('articals.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-arrow-left me-2"></i> Back to Articles
                                    </a>
                                    <button type="submit" class="btn btn-custom text-white">
                                        <i class="fas fa-save me-2"></i> Update Article
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Image preview functionality
        document.getElementById('imageInput').addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = '';
            
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('image-preview');
                    img.style.maxWidth = '200px';
                    preview.appendChild(img);
                }
                
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
@endsection