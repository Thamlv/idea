@extends('layout.layout')
@section('title', 'Edit User')
@section('content')
<div class="row">
    <div class="col-3">
        @include('shared.left-sidebar')
    </div>
    <div class="col-6">
        <div class="mt-3">
            @include('users.shared.user-edit-card')
            <hr>
            @forelse ($ideas as $idea)
            <div class="mt-3">
                @include('ideas.shared.idea-card')
            </div>
            @empty
            <p class="text-center mt-4">No resutls here.</p>
            @endforelse
            <div class="mt-2">{{$ideas->links()}}</div>
        </div>
    </div>
    <div class="col-3">
        @include('shared.search-bar')
        @include('shared.follow-box')
    </div>
</div>
@endsection
