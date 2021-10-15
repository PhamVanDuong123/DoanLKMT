@extends('layout.home')
@section('content')
<div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
				@if(session('success'))
                <div class="alert alert-success">{!!session('success')!!}</div>
                @elseif(session('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
                @endif
				  	<div class="panel-heading">Thông tin tài khoản</div>
				  	<div class="panel-body">
				    	<form method="post"  action="{{route('account.detail')}}">
							<input type='hidden' name="_token" value="{{csrf_token()}}"/>
						
							@csrf
				    		<div>
				    			<label>Họ tên</label>
							  	<input type="text" class="form-control" placeholder="Username" name="fullname" aria-describedby="basic-addon1 "  value="{{$user->fullname}}">
								  @error('fullname')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
							</div>
							<br>
							<div>
				    			<label>Email</label>
							  	<input type="email" class="form-control" placeholder="Email" name="email" aria-describedby="basic-addon1" value="{{$user->email}}"
							  	disabled
							  	>
							</div>
							<br>
							<div>
				    			<label>Phone</label>
							  	<input type="phone" class="form-control" placeholder="phone" name="phone" aria-describedby="basic-addon1"value="{{$user->phone}}"
							  
							  	>
								  @error('phone')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
							</div>
							<br>	
							<div>
								<!-- <input type="checkbox" id="changepassword" name="checkpassword"> -->
				    			<label>Đổi mật khẩu</label>
							  	<input type="password" class="form-control password" name="password" aria-describedby="basic-addon1" >
								  @error('password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
							</div>
							<br>
							<div>
				    			<label>Nhập lại mật khẩu</label>
							  	<input type="password" class="form-control password" name="passwordAgain" aria-describedby="basic-addon1" >
								  @error('passwordAgain')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
							</div>
							<br>
							<button type="submit" class="btn btn-primary">Cập Nhật <i class="fa fa-edit"></i> </button>
							</button>

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
	  $(document).ready(function(){
		  
			  $("#changepassword").change(function(){
			  
			  if($(this).is(":checked"))
			  {
				  $(".password").removeAttr('disabled');
			  }
			  else
			  {
				  $(".password").attr('disabled','');
			  }

		  });
		});
	
  </script>
@endsection


