@extends('layout.home')
@section('content')
<div class="container">

<!-- slider -->
<div class="row carousel-holder">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="panel panel-default">
        @if(session('success'))
                <div class="alert alert-success">{!!session('success')!!}</div>
                @elseif(session('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
                @endif

              <div class="panel-heading">Đăng nhập</div>
              <div class="panel-body">
              
                <form  method="post"  action="{{route('account.login')}}"  >
              
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  @csrf
                    <div>
                        <label>Email</label>
                          <input type="email" class="form-control" placeholder="Email" name="email" 
                          >
                    </div>
                    <br>	
                    <div>
                        <label>Mật khẩu</label>
                          <input type="password" class="form-control" name="password">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Đăng Nhập <i class="fas fa-plus-circle"></i></button>
                </form>
              </div>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>
<!-- end slide -->
</div>
<!-- end Page Content -->
@endsection