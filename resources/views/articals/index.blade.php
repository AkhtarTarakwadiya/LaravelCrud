@extends('articals.layouts')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="page-title">Article Management</h1>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="d-flex align-items-center">
                <i class="fas fa-newspaper fa-2x text-primary me-3"></i>
                <div>
                    <h4 class="mb-0">{{ $articales->total() }}</h4>
                    <small class="text-muted">Total Articles</small>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <a class="btn btn-custom text-white" href="{{ route('articals.create') }}">
                <i class="fas fa-plus me-2"></i> Create New Article
            </a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-custom alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card card-custom">
        <div class="card-header bg-white py-3">
            <h5 class="card-title mb-0"><i class="fas fa-list me-2"></i>Article List</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive table-responsive-custom">
                <table class="table table-hover table-custom mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Content Preview</th>
                            <th>Image</th>
                            <th width="200px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articales as $artical)
                        {{-- @php
                        $i = 1;
                        @endphp --}}
                        <tr>
                            <td class="align-middle">{{ $articales->firstItem() + $loop->index }}</td>

                            <td class="align-middle fw-bold">{{ Str::limit($artical->title, 30) }}</td>
                            <td class="align-middle">{{ Str::limit($artical->content, 50) }}</td>
                            <td class="align-middle">
                                @if($artical->image_path)
                                    <img src="{{ asset('storage/' . $artical->image_path) }}" alt="{{ $artical->title }}" class="img-thumbnail" width="80">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td class="align-middle action-buttons">
                                <form action="{{ route('articals.destroy',$artical->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?');">
                                    <a class="btn btn-info btn-sm text-white" href="{{ route('articals.show',$artical->id) }}">
                                        <i class="fas fa-eye me-1"></i> Show
                                    </a>
                                    <a class="btn btn-primary btn-sm" href="{{ route('articals.edit',$artical->id) }}">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash me-1"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {!! $articales->links('pagination::bootstrap-5') !!}
    </div>
@endsection