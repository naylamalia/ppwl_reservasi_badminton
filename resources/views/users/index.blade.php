@extends('layouts.app')

@section('content')
<div class="container" style="background-color: #fff8dc; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
    <h1 class="mb-4 text-center" style="color: #ffcc00; font-weight: bold; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);">Manage Users</h1>

    @can('create-user')
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('users.create') }}" class="btn btn-warning" style="font-weight: bold;">
                <i class="bi bi-plus-circle"></i> Add New User
            </a>
            <p class="text-muted" style="margin: 0;">Total Users: <strong>{{ $users->total() }}</strong></p>
        </div>
    @endcan

    @if($users->count())
        <table class="table table-hover table-bordered" style="background-color: #fffacd; border-radius: 10px; overflow: hidden;">
            <thead style="background-color: #ffeb99; color: #665c00; font-weight: bold;">
                <tr>
                    <th style="text-align: center;">#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr style="vertical-align: middle;">
                        <td style="text-align: center;">{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @forelse ($user->getRoleNames() as $role)
                                <span class="badge bg-primary">{{ $role }}</span>
                            @empty
                                <span class="text-muted">No Roles</span>
                            @endforelse
                        </td>
                        <td class="text-center">
                            <form action="{{ route('users.destroy', $user->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')

                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-warning" style="font-weight: bold;">
                                    <i class="bi bi-eye"></i> Show
                                </a>

                                @if (in_array('Super Admin', $user->getRoleNames()->toArray() ?? []))
                                    @if (Auth::user()->hasRole('Super Admin'))
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary" style="font-weight: bold;">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                    @endif
                                @else
                                    @can('edit-user')
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary" style="font-weight: bold;">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                    @endcan

                                    @can('delete-user')
                                        @if (Auth::user()->id != $user->id)
                                            <button type="submit" class="btn btn-sm btn-danger" style="font-weight: bold;"
                                                onclick="return confirm('Do you want to delete this user?');">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        @endif
                                    @endcan
                                @endif
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            <span class="text-danger">
                                <strong>No User Found!</strong>
                            </span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    @else
        <p class="text-center" style="color: #ffcc00; font-weight: bold; font-size: 18px;">No Users Found</p>
    @endif
</div>
@endsection