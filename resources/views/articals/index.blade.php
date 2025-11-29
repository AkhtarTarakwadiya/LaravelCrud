@extends('articals.layouts')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Artical Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('articals.create') }}"> Create New Artical</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Content</th>
            <th>Image</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($articales as $artical)
        @php
        $i = 0;
        @endphp
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $artical->title }}</td>
            <td>{{ $artical->content }}</td>
            <td><img src="{{ asset('storage/' . $artical->image_path) }}" alt="{{ $artical->title }}" width="100"></td>
            <td>
                <form action="{{ route('articals.destroy',$artical->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?');">

                    <a class="btn btn-info" href="{{ route('articals.show',$artical->id) }}">Show</a>

                    <a class="btn btn-primary" href="{{ route('articals.edit',$artical->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {!! $articales->links() !!}
@endsection