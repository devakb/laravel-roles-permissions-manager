@extends('layouts.admin')

@section('content')

    <div class="card">
        <div class="card-header">{{ __('Users List') }}</div>

        <div class="card-body">
            @can('user_create')
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add New User</a>
            @endcan

            <br /><br />



                <table class="table table-borderless table-hover">
                            <tr class="bg-info text-light">
                                <th class="text-center">ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                    @forelse ($users as $user)
                        <tr>
                            <td class="text-center">{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role->title ?? "--"}}</td>
                            <td>
                                    @can('user_show')
                                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-success">Show</a>
                                    @endcan
                                    @can('user_edit')
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    @endcan
                                    @can('user_delete')
                                <form action="{{ route('admin.users.destroy', $user->id) }}" class="d-inline-block" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="100%" class="text-center text-muted py-3">No Users Found</td>
                            </tr>
                    @endforelse
                </table>




            @if($users->total() > $users->perPage())
            <br><br>
            {{$users->links()}}
            @endif

        </div>
    </div>

@endsection
