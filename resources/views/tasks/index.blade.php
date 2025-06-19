<x-layout>
    <br><br><br>
    <div class="container pt-lg-5 p-3 shadow-sm">
        <div class="row">
            <div class="col-6">
                <h1 class="text-left text-white">Tasks Data</h1>
            </div>
            <div class="col-6 text-end">
                <a href="/tasks/create" class="btn btn-sm read-more-btn">
                Add new Task
                </a>
            </div>  
        </div><br>

        <form action="" class="row justify-content-end">
            <div class="col-6 d-flex">
                <input name="search" type="search" value="{{ request('search')}}" class="form-control search-pad" placeholder="Search...">
                <button class="btn btn-sm read-more-btn text-nowrap">Search Data</button>
            </div>
        </form> <br> <br>

        <div class="blog-card blog-content">
            <table class="table table_custom">
                <thead>
                    <tr>
                        <th class="text-white">No</th>
                        <th class="text-white">Task Owner</th>
                        <th class="text-white">Tasks</th>
                        <th class="text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $key => $task)
                    <tr>
                        <td class="text-white">{{ $key + 1 }}</td>
                        <td class="text-white">{{ $task->user->name }}</td>
                        <td class="text-white">{{ $task->tasks }}</td>
                        <td>
                            <form action="/tasks/{{$task->id}}" method="post" class="btn-group">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Del.</button>
                                <a href="/tasks/{{$task->id}}/edit" class="btn btn-sm btn-success">Edit</a>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>