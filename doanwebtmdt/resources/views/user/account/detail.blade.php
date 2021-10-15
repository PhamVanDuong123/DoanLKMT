@extends('layout.home')
@section('content')
<div class="container">

	<!-- slider -->
	<div class="row carousel-holder account-info">
		<div class="col-md-2">
		</div>
		<div class="col-md-8">
			<div class="panel panel-default">
				@if(session('success'))
				<div class="alert alert-success">{!!session('success')!!}</div>
				@elseif(session('error'))
				<div class="alert alert-danger">{{session('error')}}</div>
				@endif
				<div class="panel-heading text-uppercase font-weight-bold">Thông tin tài khoản</div>
				<div class="panel-body">
					<form method="post" action="{{route('account.detail')}}" enctype="multipart/form-data">
						<input type='hidden' name="_token" value="{{csrf_token()}}" />

						@csrf
						<div class="row">
							<div class="col-md-6">
								<label>Họ tên</label>
								<input type="text" class="form-control" placeholder="Username" name="fullname" aria-describedby="basic-addon1 " value="{{$user->fullname}}">
								@error('fullname')
								<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
							<div class="col-md-6">
								<label>Email</label>
								<input type="email" class="form-control" placeholder="Email" name="email" aria-describedby="basic-addon1" value="{{$user->email}}" disabled>
							</div>
							<div class="col-md-4">
								<label>Số điện thoại</label>
								<input type="phone" class="form-control" placeholder="phone" name="phone" aria-describedby="basic-addon1" value="{{$user->phone}}">
								@error('phone')
								<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
							<div class="col-md-4">
								<label>Giới tính</label>
								<!-- Default unchecked -->
								<div class="custom-control custom-radio">
									<input type="radio" class="custom-control-input" id="male" value="male" name="gender" @php if($user->gender=='male') echo 'checked'; @endphp>
									<label class="custom-control-label" for="male">Nam</label>
								</div>
								<div class="custom-control custom-radio">
									<input type="radio" class="custom-control-input" id="female" value="female" name="gender" @php if($user->gender=='female') echo 'checked'; @endphp>
									<label class="custom-control-label" for="female">Nữ</label>
								</div>
								@error('gender')
								<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
							<div class="col-md-4">
								<label>Ngày sinh</label>
								<input type="date" class="form-control" placeholder="dob" name="dob" aria-describedby="basic-addon1" value="{{$user->dob}}">
								@error('dob')
								<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
							<div class="col-md-6">
								<label>Địa chỉ</label>
								<textarea name="address" class="form-control" id="address" cols="30" rows="3" aria-describedby="basic-addon1">{{$user->address}}</textarea>
								@error('address')
								<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
							<div class="col-md-6">
								<label class="d-block">Ảnh đại diện</label>
								<div class="col-md-9"><input class="form-control-file file-image" type="file" name="avatar" id="avatar"></div>
								<div class="col-md-3"><img class="image-preview avatar-edit" src="{{$user->avatar}}" alt=""></div>																
								@error('avatar')
								<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
							<div class="col-md-6">
								<!-- <input type="checkbox" id="changepassword" name="checkpassword"> -->
								<label>Đổi mật khẩu</label>
								<input type="password" class="form-control password" name="password" aria-describedby="basic-addon1">
								@error('password')
								<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
							<div class="col-md-6">
								<label>Nhập lại mật khẩu</label>
								<input type="password" class="form-control password" name="passwordAgain" aria-describedby="basic-addon1">
								@error('passwordAgain')
								<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
						</div>
						<br>
						<button type="submit" class="btn btn-primary">Cập Nhật <i class="fa fa-edit"></i> </button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-2">
		</div>
	</div>
	<!-- end slide -->
</div>
@endsection

@section('script')
<script>
	$(document).ready(function() {

		$("#changepassword").change(function() {

			if ($(this).is(":checked")) {
				$(".password").removeAttr('disabled');
			} else {
				$(".password").attr('disabled', '');
			}

		});
	});
</script>
@endsection