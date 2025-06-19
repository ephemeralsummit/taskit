<x-layout>
   <div class="mx-auto" style="min-height:100vh; display:flex;">
        <div class="m-auto p-5 blog-card blog-content" style="min-width: 400px">
            <form action="/register" method="post">
            <h1 class="text-white text-center mb-4">Register</h1>
                @csrf
                <div class="mb-3">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') ? old('name') : '' }}" placeholder="Name..">
                    @error ('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') ? old('email') : '' }}" placeholder="Email..">
                    @error ('email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    value="{{ old('password') ? old('password') : '' }}" placeholder="******">
                @error ('password')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
                </div>
                <button class="btn read-more-btn w-100" style="border-radius: 1rem">
                    Register
                </button>
            </form>
        </div>    
    </div>
</x-layout>