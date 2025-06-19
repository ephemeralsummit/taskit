<x-layout> <br><br><br>
    <div class="container mt-lg-5 p-3 shadow-sm blog-card blog-content">
        <form action="/users/{{ $user->id }}" method="post">
            <h1 class="text-white">Edit User</h1>
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label class="text-white" for="">Role</label>
            <select name="role_id" id="" class="form-select">
                <option value="">Select a role.</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">
                        {{ $role->name }}
                    </option>
                @endforeach
            </select> 
        </div>
        <div class="mb-3">
            <label class="text-white" for="">Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') ? old('name') : $user->name }}">
            @error ('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="text-white" for="">Email</label>
            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') ? old('email') : $user->email }}">
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
        <a href="/users" class="btn read-more-btn">Back to Users</a>
        </form>
    </div>
</x-layout>