@extends('layouts.admin')
@section('PageTitle' , 'Edit Article')


@section('content')
	<div class="row">
		<!-- left column -->
		<div class="col-md-12">
			<!-- jquery validation -->
			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Edit  Product  {{ $product->name }}</h3>
				</div>
				<!-- /.card-header -->
				<!-- form start -->
				<form role="form" id="quickForm" action="{{ route('products.update' , $product->id) }}" method="POST" enctype="multipart/form-data">
					@csrf
                    @method('put')
					<div class="card-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Product Name</label>
							<input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Name"
								value="{{ old('name' , $product->name) }}">
							@error('name')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>

                        <div class="form-group">
							<label for="exampleInputEmail1">Product Price</label>
							<input type="text" name="price" class="form-control" id="exampleInputEmail1" placeholder="Enter Price"
								value="{{ old('price' , $product->price) }}">
							@error('price')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>


                        <div class="form-group">
							<label for="exampleInputEmail1">Product Discount</label>
							<input type="text" name="discount" class="form-control" id="exampleInputEmail1" placeholder="Enter Discount"
								value="{{ old('discount' , $product->discount) }}">
							@error('discount')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>

						<div class="form-group">
							<label for="exampleInputPassword1">Product Description </label>
							<textarea name="description" id="" class="form-control" cols="30" rows="5">{{ old('description' , $product->description) }}</textarea>
							@error('description')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>

                        <div class="form-group">
							<label for="exampleInputEmail1">Product Quantity</label>
							<input type="text" name="quantity" class="form-control" id="exampleInputEmail1" placeholder="Enter quantity"
								value="{{ old('quantity' , $product->quantity) }}">
							@error('quantity')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>
						<div class="form-group mb-0">
							<label for="parent">Product Category </label>
							<select name="category_id" id="category_id" class="form-control">
								<option value="">Chose Parent</option>
								@foreach ($categories as $category)
									<option value="{{ $category->id }}" @if(old('category_id' ,$product->category_id) == $category->id) selected @endif>{{$category->name}}</option>
								@endforeach
							</select>
							@error('category_id')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>

						<div class="form-group">
							<label for="image">Image</label>
							<input type="file" class="form-control" name="image" id="image">
							@error('image')
								<p class="text-danger">{{ $message }}</p>
							@enderror
                            @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" width="60" alt="">
                            @endif
						</div>

					</div>
					<!-- /.card-body -->
					<div class="card-footer">
						<button type="submit" class="btn btn-primary">Update</button>
					</div>
				</form>
			</div>
			<!-- /.card -->
		</div>
		<!--/.col (left) -->
		<!-- right column -->
		<div class="col-md-6">

		</div>
		<!--/.col (right) -->
	</div>
@endsection


