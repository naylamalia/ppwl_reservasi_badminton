@extends('layouts.app')

@section('content')
<div class="container" style="background-color: #fff8dc; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
    <h1 class="mb-4 text-center" style="color: #ffcc00; font-weight: bold; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);">Manage Roles</h1>

    @can('create-role')
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('roles.create') }}" class="btn btn-warning" style="font-weight: bold;">
                <i class="bi bi-plus-circle"></i> Add New Role
            </a>
            <p class="text-muted" style="margin: 0;">Total Roles: <strong>{{ $roles->total() }}</strong></p>
        </div>
    @endcan

    @if($roles->count())
        <table class="table table-hover table-bordered" style="background-color: #fffacd; border-radius: 10px; overflow: hidden;">
            <thead style="background-color: #ffeb99; color: #665c00; font-weight: bold;">
                <tr>
                    <th style="text-align: center;">#</th>
                    <th>Name</th>
                    <th class="text-center" style="width: 250px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $role)
                    <tr style="vertical-align: middle;">
                        <td style="text-align: center;">{{ $loop->iteration }}</td>
                        <td>{{ $role->name }}</td>
                        <td class="text-center">
                            <form action="{{ route('roles.destroy', $role->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')

                                <a href="{{ route('roles.show', $role->id) }}" class="btn btn-sm btn-warning" style="font-weight: bold;">
                                    <i class="bi bi-eye"></i> Show
                                </a>

                                @if ($role->name != 'Super Admin')
                                    @can('edit-role')
                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-primary" style="font-weight: bold;">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                    @endcan

                                    @can('delete-role')
                                        <button type="submit" class="btn btn-sm btn-danger" style="font-weight: bold;"
                                            onclick="return confirm('Do you want to delete this role?');">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    @endcan
                                @endif
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">
                            <span class="text-danger">
                                <strong>No Role Found!</strong>
                            </span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            {{ $roles->links('pagination::bootstrap-4') }}
        </div>
    @else
        <p class="text-center" style="color: #ffcc00; font-weight: bold; font-size: 18px;">No Roles Found</p>
    @endif
</div>
@endsection