@extends('layouts.admin')

@section('PageTitle' , 'Blogs')

@section('content')

@if (Session('success'))
		<p class="text-success">{{ Session('success') }}</p>
	@endif
<a href="{{ route('roles.create') }}" class="btn btn-primary">Create</a>
	<table class="table">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Role Name</th>
				<th scope="col">Users</th>
				<th scope="col">Controll</th>
			</tr>
		</thead>
		<tbody>
            @php $i =0; @endphp
            @forelse($roles as $role)
			<tr>
				<th scope="row">{{ ++ $i }}</th>
				<td>{{ $role->name }}</td>
				<td>{{ $role->users_count }}</td>
                <td>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm">
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-dark btn-sm">Edit</a>
                            </div>
                            <div class="col-sm">
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
			</tr>
            @empty
            <tr>
                <td colspan="5">No Blogs Yet </td>
            </tr>
            @endforelse
		</tbody>
	</table>
    {{ $roles->links() }}
@endsection
