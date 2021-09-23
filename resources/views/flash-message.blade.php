@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <strong>{{ $message }}</strong>
    <a href="/no-messsage">
        <button type="button" class="close" data-dismiss="alert">×</button>    
    </a>
</div>
@endif
  
@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
    <strong>{{ $message }}</strong>
    <a href="/no-messsage">
        <button type="button" class="close" data-dismiss="alert">×</button>    
    </a>
</div>
@endif
   
@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
    <strong>{{ $message }}</strong>
    <a href="/no-messsage">
        <button type="button" class="close" data-dismiss="alert">×</button>    
    </a>
</div>
@endif
   
@if ($message = Session::get('info'))
<div class="alert alert-info alert-block">
    <strong>{{ $message }}</strong>
    <a href="/no-messsage">
        <button type="button" class="close" data-dismiss="alert">×</button>    
    </a>
</div>
@endif
  
@if ($errors->any())
<div class="alert alert-danger">
    با عرض پوزش خطایی وجود دارد لطفا فرم ارسالی را دوباره بررسی فرمایید
    <a href="/no-messsage">
        <button type="button" class="close" data-dismiss="alert">×</button>    
    </a>
</div>
@endif