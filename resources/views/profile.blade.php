<x-layout>
    <p class="mb-0 pt-lg-5 mt-lg-5 text-white text-center" style="font-size: 65px">TaskIt!</p>
    <div class=" container d-flex justify-content-between align-items-center mx-auto" style="max-width: 600px;">
        <div class="col-lg-4 d-flex justify-content-end mx-end pt-lg-4">
            <a href="/dashboard" class="btn btn-sm text-white" style="padding-right:10px">
                <i class=" h2 fa fa-lg fa-arrow-left"></i>
            </a>            
        </div>
        <div class="col-lg-8 d-flex justify-content-between pt-lg-4">
            <p class="h2 text-white" style="padding-left:20px">Edit Profile</p>
        </div>
    </div>

    <div class="mx-auto mt-lg-5 blog-card" style="width:350px">
        <div class="m-auto py-lg-3" style="width:300px">
            <form action="/profile/{{ $user->id }}" method="post">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label class="text-white" for="">Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') ? old('name') : auth()->user()->name }}">
                @error ('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="text-white" for="">Email</label>
                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') ? old('email') :  auth()->user()->email }}">
                @error ('email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="text-white" for="">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                value="{{ old('password') ? old('password') : '' }}">
            @error ('password')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
            </div>
            <button type="submit" class="btn read-more-btn">Update User</button>
            </form>
            <form action="/profile/{{ $user->id }}" method="post" class="mt-2 pt-3">
                <label class="h4 text-white" for="">Delete Your Profile</label><br>
                @csrf
                @method('DELETE')
                <button class="btn read-more-btn-danger">Delete</button>   
            </form>
        </div>
    </div>

</x-layout>