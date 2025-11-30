@extends('articals.layouts')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary rounded-circle p-3 me-3">
                                <i class="fas fa-edit text-white fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h2 class="page-title mb-0">Edit Article</h2>
                            <p class="text-muted mb-0">Update the details of your article</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('articals.update', $artical->id) }}" method="POST" enctype="multipart/form-data" id="articleForm">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group mb-4">
                                    <label for="title" class="form-label">Article Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" value="{{ $artical->title }}" class="form-control form-control-custom" placeholder="Enter a compelling title for your article" required>
                                    @error('title')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group mb-4">
                                    <label for="content" class="form-label">Article Content <span class="text-danger">*</span></label>
                                    <textarea class="form-control form-control-custom" style="height:200px" name="content" placeholder="Write the content of your article here..." required>{{ $artical->content }}</textarea>
                                    @error('content')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group mb-4">
                                    <label for="slug" class="form-label">URL Slug <span class="text-danger">*</span></label>
                                    <input type="text" name="slug" value="{{ $artical->slug }}" class="form-control form-control-custom" placeholder="Enter a URL-friendly slug (e.g., my-article-title)" required>
                                    @error('slug')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group mb-4">
                                    <label for="image" class="form-label">Article Image</label>
                                    <input type="file" name="image" class="form-control form-control-custom" id="imageInput" accept="image/*">
                                    
                                    @if($artical->image_path)
                                        <div class="mt-3">
                                            <p class="fw-semibold mb-2">Current Image:</p>
                                            <img src="{{ asset('storage/' . $artical->image_path) }}" alt="{{ $artical->title }}" class="image-preview">
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" name="remove_image" id="removeImage">
                                                <label class="form-check-label text-danger" for="removeImage">
                                                    Remove current image
                                                </label>
                                            </div>
                                        </div>
                                    @else
                                        <div id="imagePreview" class="mt-3 text-center">
                                            <div class="border rounded p-4 bg-light">
                                                <i class="fas fa-image text-muted fs-1 mb-2 d-block"></i>
                                                <p class="text-muted small mb-0">No image currently set</p>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    @error('image')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="bg-light rounded p-4 mt-4">
                                    <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2"></i>Article Info</h6>
                                    <ul class="small text-muted ps-3 mb-0">
                                        <li>Created: {{ $artical->created_at->format('M d, Y') }}</li>
                                        <li>Last updated: {{ $artical->updated_at->format('M d, Y') }}</li>
                                        <li>ID: {{ $artical->id }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group d-flex justify-content-between align-items-center mt-5 pt-3 border-top">
                            <a href="{{ route('articals.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i> Back to Articles
                            </a>
                            <div>
                                <a href="{{ route('articals.show', $artical->id) }}" class="btn btn-info text-white me-2">
                                    <i class="fas fa-eye me-2"></i> View Article
                                </a>
                                <button type="submit" class="btn btn-custom text-white">
                                    <i class="fas fa-save me-2"></i> Update Article
                                </button>
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
            if (!preview) return;
            
            preview.innerHTML = '';
            
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('image-preview');
                    img.style.maxWidth = '100%';
                    preview.appendChild(img);
                }
                
                reader.readAsDataURL(this.files[0]);
            } else {
                preview.innerHTML = `
                    <div class="border rounded p-4 bg-light">
                        <i class="fas fa-image text-muted fs-1 mb-2 d-block"></i>
                        <p class="text-muted small mb-0">No image currently set</p>
                    </div>
                `;
            }
        });
        
        // Auto-generate slug from title
        document.querySelector('input[name="title"]').addEventListener('input', function() {
            const title = this.value;
            const slugInput = document.querySelector('input[name="slug"]');
            
            if (title && slugInput.value === '{{ $artical->slug }}') {
                const slug = title
                    .toLowerCase()
                    .replace(/[^\w ]+/g, '')
                    .replace(/ +/g, '-');
                slugInput.value = slug;
            }
        });
    </script>
@endsection