@extends('layout.layout')
@section('title', 'Admin Dashboard')
@section('content')
<div class="row">
    <div class="col-3">
        @include('admin.shared.left-sidebar')
    </div>
    <div class="col-9">
        <h1> ADMIN PANNEL </h1>
        <div class="col-md-4">
            @include('admin.shared.widget', [
                'icon' => 'fa-solid fa-users',
                'title' => 'Users',
                'total' => $totalUsers
            ])
        </div>
        <div class="col-md-4">
            @include('admin.shared.widget', [
                'icon' => 'fa-regular fa-lightbulb',
                'title' => 'Ideas',
                'total' => $totalIdeas
            ])
        </div>
        <div class="col-md-4">
            @include('admin.shared.widget', [
                'icon' => 'fa-regular fa-comments',
                'title' => 'comments',
                'total' => $totalComments
            ])
        </div>
    </div>
</div>
@endsection
