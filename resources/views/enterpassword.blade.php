@extends('app')
@section('content')
<div class="d-flex justify-content-center mt-4" id="login-pg3">
    <div class="container-sm border border-success mt-4 shadow shadow-sm bg-light"style="max-width:380px;min-height:460px; border-radius:7px;border-width:3px;">
         <div class="mt-2 pr-1">
           <h3 class="mt-3  pr-1 ">ورود/ثبت نام</h3>
         </div>
         {{-- <form method="POST"  action="{{ route('login') }}" > --}}
         <form method="POST"  action="/checkpassword" >

          @csrf 
          
            <div class="form-group mt-4">
              <label for="password" class="font-weight-bold">لطفا رمز عبور خودرا وارد کنید:</label>
              <input type="password" class="mt-3 form-control form-control-lg"
               id="password" placeholder="رمز عبور" name="password"  >
            </div>

            <input id="username" name="username" type="hidden" value="{{$username ?? ''}}">
            {{ logger('in enterpasswrod.blade username is:'.$username ?? '') }}
            {{ logger($error ?? '') }}
                                    
           <button type="submit" class="mt-3 btn btn-lg btn-success btn-block ">ورود</button>
         </form>
         <div class="mb-1">
          <form method="get" action="/smsverify">
            <input id="username" name="username" type="hidden" value="{{$username ?? ''}}">
            <input type="submit"class="btn btn-sm btn-primary mt-2" value="فراموشی رمز">
          </form>
         </div>
    </div>
</div>
@endsection