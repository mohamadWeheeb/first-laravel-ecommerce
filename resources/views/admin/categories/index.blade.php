@extends('layouts.admin')

@section('PageTitle' , 'Categories')

@section('content')
	@if (Session('success'))
		<p class="text-success">{{ Session('success') }}</p>
	@endif
    @can('create' , 'App/Models/Category')
	<a href="{{ route('categories.create') }}" class="btn btn-primary"> Create</a>
    @endcan
	<table class="table">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Category Name</th>
				<th scope="col">Category Parent</th>
				<th scope="col">Added At </th>
				<th scope="col">Controll</th>
			</tr>
		</thead>
		<tbody>
			@php $i =0; @endphp
			@forelse($categories as $category)
				<tr>
					<th scope="row">{{ ++$i }}</th>
					<td>{{ $category->name }}</td>
					<td>{{ $category->parent_id }}</td>
					<td>{{ $category->created_at }}</td>
					<td>
						<div class="container">
							<div class="row">
                                @can('update' , $category)
								<div class="col-sm">
									<a href="{{ route('categories.edit', $category->id) }}" class="btn btn-dark">Edit</a>
								</div>
                                @endcan

                                @can('view' , $category)
								<div class="col-sm">
									<a href="{{ route('categories.show', $category->id) }}" class="btn btn-success">Show</a>
								</div>
                                @endcan

                                @can('delete' , $category)
								<div class="col-sm">
									<form action="{{ route('categories.destroy', $category->id) }}" method="POST">
										@method('delete')
										@csrf
										<button type="submit" class="btn btn-danger">Delete</button>
									</form>
								</div>
                                @endcan
							</div>
						</div>
					</td>
				</tr>
			@empty
				<tr>
					<td colspan="5">No Categories Yet </td>
				</tr>
			@endforelse
		</tbody>
	</table>

    {{ $categories->links() }}
@endsection
