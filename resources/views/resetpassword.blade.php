@extends('app')
@section('content')
<div class="d-flex justify-content-center mt-4" id="login-pg3">
    <div class="container-sm border border-success mt-4 shadow shadow-sm bg-light"style="max-width:380px;min-height:460px; border-radius:7px;border-width:3px;">
         <div class="mt-2 pr-1">
           <h3 class="mt-3  pr-1 ">ثبت رمز عبور:</h3>
         </div>
         <form method="POST" action="/resetpassword" >
          @csrf

            <div class="form-group mt-4">

              <label for="password" class="font-weight-bold">رمز عبور جدید را وارد کنید:</label>
              <input type="password" class="mt-2 form-control form-control-lg" id="pass"
                     placeholder="ورود رمز عبور" name="password">

              <label for="password_confirmation" class="font-weight-bold">رمز عبور جدید را دوباره وارد کنید:</label>
              <input type="password" class="mt-2 form-control form-control-lg" id="password_confirmation"
                     placeholder="ورود دوباره رمز عبور" name="password_confirmation">

            </div>
            <button type="submit" class="mt-3 mb-1 btn btn-lg btn-success btn-block ">ذخیره</button>
         </form>
    </div>
</div>
@endsection
