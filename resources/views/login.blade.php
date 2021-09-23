@extends('app')
@section('content')

<div class="d-flex justify-content-center m-4" id="login-pg1">
    <div class="container-sm border border-success m-4 shadow shadow-sm bg-light"style="max-width:380px;min-height:460px; border-radius:7px;border-width:3px;">
         <h3 class="mt-3">ورود / ثبت نام</h3>
         
         <form method="POST" action="/getpassword">
          @csrf
            <div class="form-group mt-4">
              <label for="username" class="font-weight-bold">شماره موبایل خود را وارد کنید:</label>
              <input type="text" class="mt-3 form-control form-control-lg" id="username" placeholder="شماره موبایل" name="username" value="{{ old('username') }}" required autofocus>
              @error('username')
              <span dir="rtl" class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <button type="submit" class="mt-3 btn btn-lg btn-success btn-block ">ادامه</button>
         </form>
         <div class="mt-4">
           <p>
             با ثبت نام در سایت تمامی قوانین را می پذیرم
           </p>
         </div>
    </div>
</div>

@endsection