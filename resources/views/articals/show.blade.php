@extends('articals.layouts')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-primary rounded-circle p-3 me-3">
                                    <i class="fas fa-eye text-white fs-4"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h2 class="page-title mb-0">Article Details</h2>
                                <p class="text-muted mb-0">Viewing article: {{ Str::limit($artical->title, 40) }}</p>
                            </div>
                        </div>
                        <a href="{{ route('articals.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="article-content">
                        <div class="row mb-5">
                            <div class="col-md-8">
                                <h1 class="mb-3 text-primary">{{ $artical->title }}</h1>
                                
                                <div class="d-flex flex-wrap gap-3 mb-4">
                                    <span class="badge bg-primary badge-custom">
                                        <i class="fas fa-calendar me-1"></i> {{ $artical->created_at->format('M d, Y') }}
                                    </span>
                                    <span class="badge bg-secondary badge-custom">
                                        <i class="fas fa-edit me-1"></i> {{ $artical->updated_at->format('M d, Y') }}
                                    </span>
                                    <span class="badge bg-info badge-custom">
                                        <i class="fas fa-hashtag me-1"></i> ID: {{ $artical->id }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <div class="btn-group">
                                    <a href="{{ route('articals.edit', $artical->id) }}" class="btn btn-primary">
                                        <i class="fas fa-edit me-2"></i> Edit
                                    </a>
                                    <form action="{{ route('articals.destroy', $artical->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash me-2"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="{{ $artical->image_path ? 'col-md-8' : 'col-12' }}">
                                <div class="mb-5">
                                    <h4 class="mb-3 border-bottom pb-2">Content</h4>
                                    <div class="p-4 bg-light rounded">
                                        <p class="mb-0" style="white-space: pre-line;">{{ $artical->content }}</p>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <h4 class="mb-3 border-bottom pb-2">URL Slug</h4>
                                    <div class="p-3 bg-light rounded">
                                        <code class="fs-6">{{ $artical->slug }}</code>
                                    </div>
                                </div>
                            </div>
                            
                            @if($artical->image_path)
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <h4 class="mb-3 border-bottom pb-2">Featured Image</h4>
                                    <img src="{{ asset('storage/' . $artical->image_path) }}" alt="{{ $artical->title }}" class="img-fluid rounded shadow-sm">
                                </div>
                            </div>
                            @endif
                        </div>
                        
                        <div class="d-flex justify-content-between mt-5 pt-4 border-top">
                            <div>
                                <a href="{{ route('articals.edit', $artical->id) }}" class="btn btn-primary">
                                    <i class="fas fa-edit me-2"></i> Edit Article
                                </a>
                            </div>
                            <div>
                                <a href="{{ route('articals.create') }}" class="btn btn-outline-primary me-2">
                                    <i class="fas fa-plus me-2"></i> Create New
                                </a>
                                <a href="{{ route('articals.index') }}" class="btn btn-custom text-white">
                                    <i class="fas fa-list me-2"></i> All Articles
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection