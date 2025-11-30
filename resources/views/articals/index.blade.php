@extends('articals.layouts')

@section('content')
    <div class="row mb-5">
        <div class="col-12">
            <h1 class="page-title">Article Management</h1>
            <p class="text-muted">Manage your articles efficiently with this intuitive interface</p>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-3 mb-4">
            <div class="stats-card">
                <div class="stats-icon primary">
                    <i class="fas fa-newspaper"></i>
                </div>
                <h3 class="mb-1">{{ $articales->total() }}</h3>
                <p class="text-muted mb-0">Total Articles</p>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="stats-card">
                <div class="stats-icon" style="background: rgba(114, 9, 183, 0.1); color: #7209b7;">
                    <i class="fas fa-eye"></i>
                </div>
                <h3 class="mb-1">{{ $articales->count() }}</h3>
                <p class="text-muted mb-0">Displayed</p>
            </div>
        </div>
        <div class="col-md-6 text-md-end mb-4">
            <a class="btn btn-custom text-white" href="{{ route('articals.create') }}">
                <i class="fas fa-plus me-2"></i> Create New Article
            </a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-custom alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-3 fs-5"></i>
                <div>
                    <h5 class="mb-1">Success!</h5>
                    <p class="mb-0">{{ $message }}</p>
                </div>
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card card-custom">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0"><i class="fas fa-list me-2"></i>Article List</h5>
                <span class="badge bg-primary badge-custom">{{ $articales->count() }} of {{ $articales->total() }}</span>
            </div>
        </div>
        <div class="card-body p-0">
            @if($articales->count() > 0)
            <div class="table-responsive table-responsive-custom">
                <table class="table table-hover table-custom mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Content Preview</th>
                            <th>Image</th>
                            <th width="220px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articales as $artical)
                        <tr>
                            <td class="align-middle">{{ $articales->firstItem() + $loop->index }}</td>
                            <td class="align-middle fw-bold">{{ Str::limit($artical->title, 30) }}</td>
                            <td class="align-middle content-preview">{{ Str::limit($artical->content, 50) }}</td>
                            <td class="align-middle">
                                @if($artical->image_path)
                                    <img src="{{ asset('storage/' . $artical->image_path) }}" alt="{{ $artical->title }}" class="article-img">
                                @else
                                    <span class="text-muted"><i class="fas fa-image me-1"></i>No Image</span>
                                @endif
                            </td>
                            <td class="align-middle action-buttons">
                                <div class="d-flex">
                                    <a class="btn btn-info btn-sm text-white me-2" href="{{ route('articals.show',$artical->id) }}">
                                        <i class="fas fa-eye me-1"></i> View
                                    </a>
                                    <a class="btn btn-primary btn-sm me-2" href="{{ route('articals.edit',$artical->id) }}">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('articals.destroy',$artical->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash me-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state">
                <i class="fas fa-newspaper"></i>
                <h4 class="mt-3">No Articles Found</h4>
                <p class="text-muted mb-4">You haven't created any articles yet. Get started by creating your first article!</p>
                <a href="{{ route('articals.create') }}" class="btn btn-custom">
                    <i class="fas fa-plus me-2"></i> Create Your First Article
                </a>
            </div>
            @endif
        </div>
    </div>

    @if($articales->hasPages())
    <div class="d-flex justify-content-center mt-5">
        {!! $articales->links('pagination::bootstrap-5') !!}
    </div>
    @endif
@endsection