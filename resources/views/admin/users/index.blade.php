@extends('layouts.admin')

@section('PageTitle' , 'Users')

@section('content')

    @if (Session('success'))
		<p class="text-success">{{ Session('success') }}</p>
	@endif
<a href="{{ route('users.create') }}" class="btn btn-primary">Create</a>
	<table class="table">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">User Name</th>
				<th scope="col">User E-Mail</th>
				<th scope="col">User Image</th>
				<th scope="col">Added At </th>
				<th scope="col">Controll</th>
			</tr>
		</thead>
		<tbody>
			@php $i =0; @endphp
			@forelse($users as $user)
				<tr>
					<th scope="row">{{ ++$i }}</th>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td>
                        <img src="{{ $user->image_url }}" alt="{{ $user->name }}" width="80">
                    </td>
					<td>{{ $user->created_at }}</td>
					<td>
						<div class="container">
							<div class="row">
								<div class="col">
									<a href="{{ route('users.show' , $user->id) }}" class="btn btn-dark">Show</a>
								</div>
								<div class="col">
									<a href="{{ route('users.edit' , $user->id) }}" class="btn btn-primary">Edit</a>
								</div>
								<div class="col">
									<form action="{{ route('users.destroy' , $user->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
								</div>
							</div>
						</div>
					</td>
				</tr>
			@empty
				<tr>
					<td colspan="5">No users </td>
				</tr>
			@endforelse
		</tbody>
	</table>

    {{$users->links()}}
@endsection
