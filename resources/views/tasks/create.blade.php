<x-layout> <br><br><br>
    <div class="container mt-lg-5 p-3 shadow-sm blog-card blog-content">
        <form action="/tasks" method="post">
            <h1 class="text-white" >Create Task</h1>
        @csrf
        <div class="mb-3">
            <label class="text-white" for="">User Id</label>
            <select name="user_id" id="" class="form-select @error('user_id') is-invalid @enderror">
                <option value="">Choose the owner</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>    
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="text-white" for="">Task</label>
            <input type="text" name="tasks" class="form-control @error('tasks') is-invalid @enderror"
                value="{{ old('tasks') ? old('tasks') : '' }}">
            @error ('tasks')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn read-more-btn">Store Task</button>
        <a href="/tasks" class="btn read-more-btn">Back to Task</a>
        </form>
    </div>
</x-layout>