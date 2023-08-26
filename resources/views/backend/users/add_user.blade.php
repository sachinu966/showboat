@extends('backend.app')
@section('content-area')
<div class="container">

<div class="row layout-top-spacing">

<div id="basic" class="col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>{{isset($useredit)?'Update user':'Add New User'}}</h4>
                </div>                 
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <form class="simple-example" action="{{ isset($useredit) ? route('admin.user.update',Crypt::encrypt($useredit->id)) : route('admin.user.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @isset($useredit)
                @method('patch')
                @endisset
                <div class="form-row row">
                    <div class="col-md-12 mb-4">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter User Name" value="{{$useredit->name??''}}" required>
                        <div class="valid-feedback"> Looks good!</div>
                        <div class="invalid-feedback"> Please fill the name</div>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>    @enderror

                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="profile">Profile</label>
                        <input type="file" class="form-control" id="profile" name="profile" >
                        <div class="valid-feedback"> Looks good!</div>
                        <div class="invalid-feedback"> Please fill the Profile</div>
                        @isset($useredit)
                        <img src="{{asset('upload/profile/'.$useredit->profile)}}" width="100" height="100" alt="profile">
                         @endisset
                         @error('profile')<div class="invalid-feedback">{{ $message }}</div>    @enderror

                        </div>
                      
                    <div class="col-md-6 mb-4">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{$useredit->email??''}}" required>
                        <div class="valid-feedback"> Looks good!</div>
                        <div class="invalid-feedback"> Please fill the name</div>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>    @enderror

                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="pan">Pan</label>
                        <input type="text" class="form-control" id="pan" name="pan" placeholder="Enter Pan No" value="{{$useredit->pan??''}}" required>
                        <div class="valid-feedback"> Looks good!</div>
                        <div class="invalid-feedback"> Please fill the name</div>
                        @error('pan')<div class="invalid-feedback">{{ $message }}</div>    @enderror

                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="adhar">Adhar</label>
                        <input type="adhar" class="form-control" id="adhar" name="adhar" placeholder="Enter Adhar No" value="{{$useredit->adhar??''}}" required>
                        <div class="valid-feedback"> Looks good!</div>
                        <div class="invalid-feedback"> Please fill the name</div>
                        @error('adhar')<div class="invalid-feedback">{{ $message }}</div>    @enderror

                    </div>
</div>
                    <div class="col-md-12 mb-4">
                        <label for="address">Address</label>
                        <textarea type="text" class="form-control" id="address" name="address" placeholder="Enter Address"  >{{$useredit->address??''}}</textarea>
                        <div class="valid-feedback"> Looks good!</div>
                        <div class="invalid-feedback"> Please fill the name</div>
                        @error('address')<div class="invalid-feedback">{{ $message }}</div>    @enderror

                    </div>
                    
                <button class="btn btn-primary submit-fn mt-2" type="submit"> {{isset($useredit)?'Update':'Add'}}</button>
            </form>
    </div>
</div>

</div>
</div>
@endsection

@section('script-area')
</script>
@endsection
