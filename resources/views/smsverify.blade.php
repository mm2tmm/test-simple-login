@extends('app')
@section('content')
<div class="d-flex justify-content-center mt-4" id="login-pg2">
    <div class="container-sm border border-success mt-4 shadow shadow-sm bg-light"style="max-width:380px;min-height:460px; border-radius:7px;border-width:3px;">
         <div class="mt-2 pr-1">
           <h3 class="mt-3  pr-1 ">ورود/ثبت نام</h3>
         </div>
         <form method="POST" action="/smsverify" >
            @csrf

            <div class="form-group mt-4">
              <label for="verifycode" class="font-weight-bold">کد موجود در پیامک ارسال شده را وارد کنید:</label>
              <input type="number" class="mt-3 form-control form-control-lg" id="otp" placeholder="123456" name="otp">

              <input id="username" name="username" type="hidden" value="{{$username ?? ''}}">
              {{ logger('in smsverify.blade phone is:'.$username ?? '') }}

            </div>
            <button type="submit" class="mt-3 btn btn-lg btn-success btn-block ">ورود</button>
         </form>
    </div>
</div>
@endsection
