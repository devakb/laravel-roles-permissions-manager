@extends('layouts.admin')

@section('content')

    <div class="card">
        <div class="card-header">{{ __('Roles List') }}</div>

        <div class="card-body">
            @can('role_create')
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Add New Role</a>
            @endcan

            <br /><br />

            @can('roles_access')

                <table class="table table-borderless table-hover">
                            <tr class="bg-info text-light">
                                <th class="text-center">ID</th>
                                <th>Title</th>
                                <th>Short Code</th>
                                <th>Permissions</th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                    @forelse ($roles as $role)
                        <tr>
                            <td class="text-center">{{$role->id}}</td>
                            <td>{{$role->title}}</td>
                            <td>{{$role->short_code ?? '--'}}</td>
                            <td>
                                 @foreach ($role->permissions as $permission)
                                     <div class="badge badge-info">{{ $permission->name }}</div>
                                 @endforeach
                            </td>
                            <td>
                                    @can('role_edit')
                                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    @endcan
                                    @can('role_delete')
                                        <form action="{{ route('admin.roles.destroy', $role->id) }}" class="d-inline-block" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    @endcan
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5">No Roles Found .....</td>
                            </tr>
                    @endforelse
                </table>

            @endcan


            @if($roles->total() > $roles->perPage())
            <br><br>
            {{$roles->links()}}
            @endif

        </div>
    </div>

@endsection
