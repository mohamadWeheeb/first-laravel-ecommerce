@extends('layouts.admin')


@section('content')
	<table class="table">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Blog Title</th>
				<th scope="col">Blog Category</th>
				<th scope="col">Blog User </th>
				<th scope="col">Controll</th>
			</tr>
		</thead>
		<tbody>
            @php $i =0; @endphp
            @forelse($blogs as $blog)
			<tr>
				<th scope="row">{{ ++ $i }}</th>
				<td>{{ $blog->title }}</td>
				<td>{{ $blog->category_id }}</td>
				<td>{{ $blog->user_id }}</td>
			</tr>
            @empty
            <tr>
                <td colspan="5">No Blogs Yet </td>
            </tr>
            @endforelse
		</tbody>
	</table>
@endsection
