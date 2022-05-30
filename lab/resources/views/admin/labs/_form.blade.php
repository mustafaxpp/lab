<input type="hidden" name="item" value="{{ $lab->id }}" id="">
<div class="row">
    <div class="col-lg-12">
        <div class="form-group @if($errors->has('name')) error-validation @endif">
            <label for="name">{{__('Name')}}</label>
            <input type="text" class="form-control" name="name" placeholder="{{__('Name')}}" id="name"
                @if(isset($lab)) value="{{$lab->name}}" @endif required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group @if($errors->has('email')) error-validation @endif">
            <label for="email">{{__('Email')}}</label>
            <input type="email" class="form-control" name="email" placeholder="{{__('Email')}}" id="email"
                @if(isset($lab)) value="{{$lab->email}}" @endif required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group @if($errors->has('lab_id')) error-validation @endif">
            <label for="email">{{__('Choose Contract')}}</label>
            <select name="lab_id" id="lab_id" class="form-control">
                <option value="">{{__('Choose Contract')}}</option>
                @foreach($contracts as $contract)
                    <option value="{{ $contract->id }}" {{ $contract->id == $lab->lab_id ? 'selected' : '' }}>{{ $contract->title }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>





