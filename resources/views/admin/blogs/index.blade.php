@extends('layouts.admin')

@section('PageTitle' , 'Blogs')

@section('content')

@if (Session('success'))
		<p class="text-success">{{ Session('success') }}</p>
	@endif
<a href="{{ route('blogs.create') }}" class="btn btn-primary">Create</a>
	<table class="table">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Blog Title</th>
				<th scope="col">Blog Category</th>
				<th scope="col">Blog Status</th>
				<th scope="col">Blog User </th>
				<th scope="col">Controll</th>
			</tr>
		</thead>
		<tbody>
            @php $i =0; @endphp
            @forelse($blogs as $blog)
			<tr>
				<th scope="row">{{ ++ $i }}</th>
				<td><a href="{{ route('blogs.show' , $blog->id) }}">{{ $blog->title }}</a></td>
				<td><a href="{{ route('categories.show' , $blog->category->id) }}">{{ $blog->category->name }}</a></td>
				<td><p @if($blog->status == 'active') class="text-success" @else class="text-danger" @endif>{{ $blog->status }}</a></td>
				<td><a href="{{ route('users.show' , $blog->user->id) }}">{{ $blog->user->name }}</a></td>
                <td>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm">
                                <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-dark btn-sm">Edit</a>
                            </div>
                            <div class="col-sm">
                                <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST">
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
    <div class="text-center">
        {{ $blogs->links() }}
    </div>
@endsection
