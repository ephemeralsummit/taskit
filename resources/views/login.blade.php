<x-layout>
    <div class=""style="min-height: 100vh; display: flex">
        <form action="/login" method="POST" 
        class="m-auto shadow p-5 blog-card blog-content" style="min-width: 400px">
            @csrf
            <h1 class="text-center mb-4 text-white">Login</h1>

            <input type="text" name="email"
             class="form-control mb-3 @error('email') is-invalid @enderror"
             placeholder="Enter your email..">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            <input type="password" name="password"
            class="form-control mb-3"
            placeholder="******">

            <button class="btn read-more-btn w-100" style="border-radius: 1rem">
                Login
            </button>
        </form>
    </div>
</x-layout>