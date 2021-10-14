@extends('layout.home')
@section('content')
<div class="container">
@if(session('success'))
                <div class="alert alert-success">{!!session('success')!!}</div>
                @elseif(session('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
                @endif

<!-- slider -->
<div class="row carousel-holder">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <div class="panel panel-default">
              <div class="panel-heading">Đăng ký tài khoản</div>
              <div class="panel-body">
                <form method="post"  enctype="multipart/form-data"  action="{{route('account.signup')}}" >
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  @csrf
                    <div>
                        <label>Họ tên</label>
                          <input type="text" class="form-control" placeholder="Username" name="fullname" aria-describedby="basic-addon1">
                            @error('fullname')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                    </div>
                    <br>
                    <div>
                        <label>Email</label>
                          <input type="email" class="form-control" placeholder="Email" name="email" aria-describedby="basic-addon1"
                          >
                          @error('email')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                         
                    </div>
                    <br>
                    <div>
                        <label>Số điện thoại</label>
                          <input type="phone" class="form-control" placeholder="phone" name="phone" aria-describedby="basic-addon1"
                          >
                          @error('phone')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                    </div>
                    <br>		
                    <div>
                      
                        <label>Nhập mật khẩu</label>
                          <input type="password" class="form-control" name="password" aria-describedby="basic-addon1">
                          @error('password')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                    </div>
                    <br>
                   <!--  <div>
                        <label>Nhập lại mật khẩu</label>
                          <input type="password" class="form-control" name="passwordAgain" aria-describedby="basic-addon1">
                          @error('password')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                    </div> -->
                    <br>
                    <button type="submit" class="btn btn-primary">Đăng Ký<i class="fas fa-plus-circle"></i></button>

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