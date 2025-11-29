@extends('articals.layouts')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-custom">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="page-title mb-0"><i class="fas fa-eye me-2"></i>Article Details</h2>
                        <a href="{{ route('articals.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="article-content">
                        <h3 class="mb-3 text-primary">{{ $artical->title }}</h3>
                        
                        <div class="mb-4">
                            <p class="text-muted mb-1"><i class="fas fa-calendar me-2"></i>Created: {{ $artical->created_at->format('M d, Y') }}</p>
                            <p class="text-muted"><i class="fas fa-edit me-2"></i>Updated: {{ $artical->updated_at->format('M d, Y') }}</p>
                        </div>
                        
                        <div class="mb-4">
                            <h5 class="mb-2">Content:</h5>
                            <div class="p-3 bg-light rounded">
                                <p class="mb-0">{{ $artical->content }}</p>
                            </div>
                        </div>
                        
                        @if($artical->image_path)
                            <div class="mb-4">
                                <h5 class="mb-2">Image:</h5>
                                <img src="{{ asset('storage/' . $artical->image_path) }}" alt="{{ $artical->title }}" class="img-fluid rounded shadow-sm" style="max-height: 300px;">
                            </div>
                        @endif
                        
                        <div class="mb-4">
                            <h5 class="mb-2">Slug:</h5>
                            <div class="p-2 bg-light rounded">
                                <code>{{ $artical->slug }}</code>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                            <a href="{{ route('articals.edit', $artical->id) }}" class="btn btn-primary">
                                <i class="fas fa-edit me-2"></i> Edit Article
                            </a>
                            <form action="{{ route('articals.destroy', $artical->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash me-2"></i> Delete Article
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection