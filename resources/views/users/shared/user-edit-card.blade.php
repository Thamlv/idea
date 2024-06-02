<div class="card">
    <div class="px-3 pt-4 pb-2">
        <form enctype="multipart/form-data" action="{{route('users.update', $user->id)}}" method="post">
            @csrf
            @method('put')
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img style="width:150px" class="me-3 avatar-sm rounded-circle"
                        src="{{$user->getImageURL()}}" alt="{{$user->name}}">
                    <div>
                        <input class="form-control" type="text" name="name" value="{{$user->name}}">
                        @error('name')
                            <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    @auth
                        @if (Auth::user()->id == $user->id)
                            <a href="{{route('users.show', $user->id)}}"> Show </a>
                        @endif
                    @endauth
                </div>
            </div>
            <div class="mt-2">
                <label for="">Profile picture</label>
                <input class="form-control" type="file" name="image" accept="image/*">
            </div>
            <div class="px-2 mt-4">
                <h5 class="fs-5"> Bio : </h5>
                <textarea name="bio" class="form-control" id="bio" rows="3">{{$user->bio}}</textarea>
                    @error('bio')
                        <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                    @enderror
                    <div class="my-3">
                        <button type="submit" class="btn btn-primary btn-sm"> Save </button>
                    </div>
                    @include('users.shared.user-stats')
                @auth
                    @if (Auth::user()->id != $user->id)
                        <div class="mt-3">
                            <button class="btn btn-primary btn-sm"> Follow </button>
                        </div>
                    @endif
                @endauth
            </div>
        </form>
    </div>
</div>
