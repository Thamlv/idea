@extends('layout.layout')
@section('title', 'Admin Dashboard')
@section('content')
<div class="row">
    <div class="col-3">
        @include('admin.shared.left-sidebar')
    </div>
    <div class="col-9">
        @include('shared.success-message')
        <h1> COMMENTS PANNEL </h1>
        <table class="table table-striped mt-3">
            <thead class="table-dark">
                <th>ID</th>
                <th>User</th>
                <th>Idea</th>
                <th>Content</th>
                <th>Created at</th>
                <th>#</th>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                <tr>
                    <td>{{$comment->id}}</td>
                    <td><a href="{{route('users.show', $comment->user)}}">{{$comment->user->name}}</a></td>
                    <td><a href="{{route('ideas.show', $comment->idea)}}">{{$comment->idea->id}}</a></td>
                    <td>{{$comment->content}}</td>
                    <td>{{$comment->created_at->toDateString()}}</td>
                    <td>
                        <form action="{{route('admin.comments.destroy', $comment)}}" method="post">
                            @csrf
                            @method('delete')
                            <a href="#" onclick="this.closest('form').submit(); return false;">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div>{{$comments->links()}}</div>
    </div>
</div>
@endsection
