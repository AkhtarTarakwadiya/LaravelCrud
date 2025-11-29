@extends('articals.layouts')

@section('content')
    <div class="container">
        <h2>Reade Article</h2>
        <div class="card">
            <div class="card-header">
                <h3>{{ $artical->title }}</h3>
            </div>
            <div class="card-body">
                <p>{{ $artical->content }}</p>
                @if($artical->image_path)
                    <img src="{{ asset('storage/' . $artical->image_path) }}" alt="{{ $artical->title }}" width="200">
                @endif
                <p><strong>Slug:</strong> {{ $artical->slug }}</p>
            </div>
    </div>

@endsection