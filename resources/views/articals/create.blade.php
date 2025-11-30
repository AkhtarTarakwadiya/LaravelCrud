@extends('articals.layouts')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary rounded-circle p-3 me-3">
                                <i class="fas fa-plus-circle text-white fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h2 class="page-title mb-0">Create New Article</h2>
                            <p class="text-muted mb-0">Fill in the details to create a new article</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('articals.store') }}" method="POST" enctype="multipart/form-data" id="articleForm">
                        @csrf

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group mb-4">
                                    <label for="title" class="form-label">Article Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control form-control-custom" placeholder="Enter a compelling title for your article" required>
                                    @error('title')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group mb-4">
                                    <label for="content" class="form-label">Article Content <span class="text-danger">*</span></label>
                                    <textarea class="form-control form-control-custom" style="height:200px" name="content" placeholder="Write the content of your article here..." required>{{ old('content') }}</textarea>
                                    @error('content')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                    <div class="mt-2 text-muted small">
                                        <i class="fas fa-info-circle me-1"></i> Minimum 50 characters required
                                    </div>
                                </div>
                                
                                <div class="form-group mb-4">
                                    <label for="slug" class="form-label">URL Slug <span class="text-danger">*</span></label>
                                    <input type="text" name="slug" value="{{ old('slug') }}" class="form-control form-control-custom" placeholder="Enter a URL-friendly slug (e.g., my-article-title)" required>
                                    @error('slug')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                    <div class="mt-2 text-muted small">
                                        <i class="fas fa-info-circle me-1"></i> Use lowercase letters, numbers, and hyphens only
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group mb-4">
                                    <label for="image" class="form-label">Article Image</label>
                                    <input type="file" name="image" class="form-control form-control-custom" id="imageInput" accept="image/*">
                                    <div id="imagePreview" class="mt-3 text-center">
                                        <div class="border rounded p-4 bg-light">
                                            <i class="fas fa-image text-muted fs-1 mb-2 d-block"></i>
                                            <p class="text-muted small mb-0">Image preview will appear here</p>
                                        </div>
                                    </div>
                                    @error('image')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                    <div class="mt-2 text-muted small">
                                        <i class="fas fa-info-circle me-1"></i> Recommended size: 1200x630 pixels
                                    </div>
                                </div>
                                
                                <div class="bg-light rounded p-4 mt-4">
                                    <h6 class="fw-bold mb-3"><i class="fas fa-lightbulb me-2"></i>Tips</h6>
                                    <ul class="small text-muted ps-3 mb-0">
                                        <li>Use a descriptive title</li>
                                        <li>Add relevant images</li>
                                        <li>Proofread your content</li>
                                        <li>Use proper formatting</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group d-flex justify-content-between align-items-center mt-5 pt-3 border-top">
                            <a href="{{ route('articals.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i> Back to Articles
                            </a>
                            <button type="submit" class="btn btn-custom text-white">
                                <i class="fas fa-paper-plane me-2"></i> Publish Article
                            </button>
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
                    img.style.maxWidth = '100%';
                    preview.appendChild(img);
                }
                
                reader.readAsDataURL(this.files[0]);
            } else {
                preview.innerHTML = `
                    <div class="border rounded p-4 bg-light">
                        <i class="fas fa-image text-muted fs-1 mb-2 d-block"></i>
                        <p class="text-muted small mb-0">Image preview will appear here</p>
                    </div>
                `;
            }
        });
        
        // Auto-generate slug from title
        document.querySelector('input[name="title"]').addEventListener('input', function() {
            const title = this.value;
            const slugInput = document.querySelector('input[name="slug"]');
            
            if (title && (!slugInput.value || slugInput.value === '{{ old('slug') }}')) {
                const slug = title
                    .toLowerCase()
                    .replace(/[^\w ]+/g, '')
                    .replace(/ +/g, '-');
                slugInput.value = slug;
            }
        });
    </script>
@endsection