<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                    src="{{$idea->user->getImageURL()}}" alt="{{$idea->user->name}}">
                <div>
                    <h5 class="card-title mb-0"><a href="{{route('users.show', $idea->user->id)}}"> {{$idea->user->name}}
                        </a></h5>
                </div>
            </div>
            <div>
                <form action="{{route('ideas.destroy', $idea->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <a href="{{route('ideas.show', $idea->id)}}"> View </a>
                    <a class="ms-1" href="{{route('ideas.edit', $idea->id)}}"> Edit </a>
                    <button type="submit" class="ms-1 btn btn-danger btn-sm"> X </button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if ($editing ?? false)
            <form action="{{route('ideas.update', $idea->id)}}" method="post">
                @csrf
                @method('put')
                <div class="mb-3">
                    <textarea name="content" class="form-control" id="content" rows="3"></textarea>
                    @error('content')
                        <span class="d-block mt-2 text-danger fs-6">{{$message}}</span>
                    @enderror
                </div>
                <div class="">
                    <button type="submit" class="btn btn-dark btn-sm"> Update </button>
                </div>
            </form>
        @endif
        <p class="fs-6 fw-light text-muted">
            {{$idea->content}}
        </p>
        <div class="d-flex justify-content-between">
            <div>
                <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1">
                    </span> {{$idea->likes}} </a>
            </div>
            <div>
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                {{$idea->created_at}} </span>
            </div>
        </div>
        @include('shared.comment-box')
    </div>
</div>
