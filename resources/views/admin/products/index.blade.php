<x-dashboard-layout Page-title="Products">

    <x-alert title="Message Title" style="success">

        Message Body
    </x-alert>
	<a href="{{ route('products.create') }}" class="btn btn-primary"> Create</a>
	<table class="table">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Product Name</th>
				<th scope="col">Product Parent</th>
				<th scope="col">Added At </th>
				<th scope="col">image </th>
				<th scope="col">Controll</th>
			</tr>
		</thead>
		<tbody>
			@php $i =0; @endphp
			@forelse($products as $product)
				<tr>
					<th scope="row">{{ ++$i }}</th>
					<td>{{ $product->name }}</td>
					<td>{{ $product->category_id }}</td>
					<td>{{ $product->created_at }}</td>
					<td>
                        <img src="{{ asset('storage/' . $product->image) }}" width="60" alt="">
                    </td>
					<td>
						<div class="container">
							<div class="row">
								<div class="col-sm">
									<a href="{{ route('products.edit', $product->id) }}" class="btn btn-dark">Edit</a>
								</div>
								<div class="col-sm">
									<a href="{{ route('products.show', $product->id) }}" class="btn btn-success">Show</a>
								</div>
								<div class="col-sm">
									<form action="{{ route('products.destroy', $product->id) }}" method="POST">
										@method('delete')
										@csrf
										<button type="submit" class="btn btn-danger">Delete</button>
									</form>
								</div>
							</div>
						</div>
					</td>
				</tr>
			@empty
				<tr>
					<td colspan="5">No products Yet </td>
				</tr>
			@endforelse
		</tbody>
	</table>

    {{ $products->links() }}


</x-dashboard-layout>
