<x-layout>
    <br><br><br>
    <div class="container p-3 pt-lg-5 shadow-sm">
        <div class="row">
            <div class="col-6">
                <h1 class="text-white">Userbase Data</h1>
            </div>
            <div class="col-6 text-end">
                <a href="/users/create" class="btn btn-sm read-more-btn">
                Add new User
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
                        <th class="text-white">Role</th>
                        <th class="text-white">Name</th>
                        <th class="text-white">Email</th>
                        <th class="text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user)
                    <tr>
                        <td class="text-white">{{ $key + 1 }}</td>
                        <td class="text-white">{{ $user->role->name ?? '-'}}</td>
                        <td class="text-white">{{ $user->name }}</td>
                        <td class="text-white">{{ $user->email }}</td>
                        <td>
                            <form action="/users/{{ $user->id }}" method="post" class="btn-group">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Del.</button>
                                <a href="/users/{{ $user->id }}/edit" class="btn btn-sm btn-success">Edit</a>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{$users->links()}}
    </div>
</x-layout>