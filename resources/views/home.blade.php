@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Dashboard') }}
                </div>
                <h5 class="card-header">
                    <a href="{{ route('todo.create') }}" class="btn btn-sm btn-outline-primary">Add Store</a>
                </h5>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session()->get('success') }}
                    </div>
                    @endif

                    <table class="table table-borderless table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Store</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($todos as $todo)
                            <tr>
                                @if ($todo->completed)
                                <td scope="row"><a href="{{ route('todo.edit', $todo->id) }}" style="color: black"><s>{{ $todo->title }}</s></a></td>
                                @else
                                <td scope="row"><a href="{{ route('todo.edit', $todo->id) }}" style="color: black">{{ $todo->title }}</a></td>
                                @endif
                                <td>
                                    <a href="{{ route('todo.edit', $todo->id) }}" class="btn btn-sm btn-outline-success"><i class="fa fa-pencil-square-o"></i></a>
                                    <a href="{{ route('todo.show', $todo->id) }}" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                No Store Added!
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center pagination-container">
                        {{ $todos->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('styles')
<style>
   /* Custom styling for pagination links within pagination-container */
.pagination-container .pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination-container .pagination > li {
    display: inline;
    margin: 0 5px;
    padding: 5px 10px;
    border: 1px solid #ccc;
    background-color: #fff;
    color: #333;
    font-size: 14px; /* Adjust the font size as needed */
}

/* Additional styles for active and disabled states as needed */
.pagination-container .pagination > .page-item.active .page-link {
    background-color: #007bff;
    color: #fff;
    border: 1px solid #007bff;
}

.pagination-container .pagination > .page-item.disabled .page-link {
    background-color: #ddd;
    border: 1px solid #ddd;
    color: #777;
}
</style>
@endpush

@endsection