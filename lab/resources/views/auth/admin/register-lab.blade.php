@extends('layouts.auth')
@section('title')
  {{__('Register Lab')}}
@endsection
@section('content')

<form action="{{route('admin.auth.register_submit')}}" method="post" class="validate-form">

    <span class="login100-form-title p-b-43">
        {{__('Register Lab')}}
    </span>
    
    <div class="wrap-input100 validate-input @if($errors->has('name')) error-validation @endif">
        <input class="input100" type="name" name="name" id="name" value="{{old('name')}}" required>
        <span class="focus-input100"></span>
        <span class="label-input100">{{__('Name')}}</span>
    </div>

    <div class="wrap-input100 validate-input @if($errors->has('email')) error-validation @endif">
        <input class="input100" type="email" name="email" id="email" value="{{old('email')}}" required>
        <span class="focus-input100"></span>
        <span class="label-input100">{{__('Email')}}</span>
    </div>
    
    
    <div class="wrap-input100 validate-input @if($errors->has('password')) error-validation @endif">
        <input class="input100" type="password" name="password" id="password" required>
        <span class="focus-input100"></span>
        <span class="label-input100">{{__('Password')}}</span>
    </div>
    
    <div class="wrap-input100 validate-input @if($errors->has('confirm_password')) error-validation @endif">
        <input class="input100" type="password" name="confirm_password" id="confirm_password" required>
        <span class="focus-input100"></span>
        <span class="label-input100">{{__('Confirm Password')}}</span>
    </div>

    <!-- foreach governments -->
    <div class="wrap-input100 validate-input @if($errors->has('government_id')) error-validation @endif">
        <select class="input100" name="government_id" data-url="{{ route('get_region') }}" id="government_id" required>
            <option value="">اختر المحافظة</option>
            @foreach($governments as $government)
                <option value="{{$government->id}}">{{$government->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="wrap-input100 validate-input @if($errors->has('region_id')) error-validation @endif">
        <select class="input100" name="region_id" id="region_id" style="display: none;" required>

        </select>
    </div>

    <div class="container-login100-form-btn">
        <button class="login100-form-btn" type="submit">
            {{__('Register')}}
        </button>
    </div>


</form>

<span class="login100-form-title p-b-30 p-t-30">
    <a href="{{url('/admin/auth/login')}}"> 
        <h5 class="d-inline">
            <i class="fas fa-user-injured"></i> 
            {{__('Login Lab')}}
        </h5>
    </a>
</span>


@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#government_id').change(function(){
                var government_id = $(this).val();
                var url = $(this).data('url');
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        government_id: government_id
                    },
                    success: function(data){
                        var data_array = [];
                        if(data != ''){
                            $('#region_id').css('display', 'block');
                            data.forEach(function(region){
                                data_array += '<option value="'+region.id+'">'+region.name+'</option>';
                            });
                            $('#region_id').html(data_array);
                        } else {
                            $('#region_id').css('display', 'none');
                        }
                    }
                });
            });
        });
    </script>
@endsection