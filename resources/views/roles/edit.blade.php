<x-layout> <br><br><br>
    <div class="container mt-lg-5 p-3 shadow-sm blog-card blog-content">
        <form action="/roles/{{ $role->id}}" method="post">
            <h1 class="text-white">Edit Role</h1>
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label class="text-white" for="">Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') ? old('name') : $role->name }}">
            @error ('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn read-more-btn">Update Role</button>
        <a href="/roles" class="btn read-more-btn">Back to Roles</a>
        </form>
    </div>
</x-layout>