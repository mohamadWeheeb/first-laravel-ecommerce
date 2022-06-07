@extends('layouts.admin')

@section('PageTitle' , 'Edit User')
@section('content')
	<div class="row">
		<!-- left column -->
		<div class="col-md-12">
			<!-- jquery validation -->
			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Edit User </h3>
				</div>
				<!-- /.card-header -->
				<!-- form start -->
				<form role="form" id="quickForm" action="{{ route('users.update' , $user->id) }}" method="POST" enctype="multipart/form-data">
					@csrf
                    @method('put')
					<div class="card-body">
						<div class="form-group">
							<label for="exampleInputEmail1">User Name</label>
							<input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Name"
								value="{{ old('name' , $user->name) }}">
							@error('name')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">User E-mail</label>
							<input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter E-mail"
								value="{{ old('email' , $user->email) }}">
							@error('email')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">User Password</label>
							<input type="password" name="password" class="form-control" id="exampleInputEmail1" placeholder="Enter password"
								value="{{ old('password') }}">
							@error('password')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>
                        <div class="form-group">
							<label for="exampleInputEmail1">Confirm Password</label>
							<input type="password" name="password_confirmation" class="form-control" id="exampleInputEmail1" placeholder="Enter password"
								value="{{ old('password_confirmation') }}">
							@error('password_confirmation')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>
                        <div class="hidden">
                            <input type="hidden" value="{{ $user->password }}" name="oldPassword">
                        </div>

                        <div class="form-group mb-0">
							<label for="type">Type </label>
							<select name="type" id="type" class="form-control">
								<option value="">User Type</option>
									<option value="user" @if($user->type == 'user') selected @endif>User</option>
									<option value="admin" @if($user->type == 'admin') selected @endif>Admin</option>
									<option value="super-admin" @if($user->type == 'super-admin') selected @endif>Super Admin</option>
							</select>
							@error('type')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>


                        <div class="form-group mb-0">
							<label for="role">User Role </label>
							<select name="role" id="type" class="form-control">
								<option value="">User Roles</option>
                                @foreach($roles as $id => $name)
									<option value="{{ $id }}" @if(($user_role->user_id ?? 0) == $id) selected @endif>{{ $name }}</option>
                                    @endforeach
							</select>
							@error('role')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>


						<div class="form-group">
							<label for="image">Image</label>
							<input type="file" class="form-control" name="image" id="image">
							@error('image')
								<p class="text-danger">{{ $message }}</p>
							@enderror
                            <img src="{{ $user->image_url }}" alt="{{ $user->name }}" width="80">
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

