<div class="row">



    <div class="col-lg-12">

        <div class="row">


            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">اسم المنطقه</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="اسم المنطقه" name="name" id="name" @if(isset($region)) value="{{$region->name}}" @elseif(old('name')) value="{{ isset($region) ? $region->name : old('name')}}" @endif>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">اختر المحافظة</label>
                    <div class="input-group mb-3">
                        <select class="form-control" name="government_id" id="government_id">
                            <option value="">{{__('Select')}}</option>
                            @foreach($governments as $government)
                                <option value="{{$government->id}}" @if(isset($region) && $region->government_id == $government->id) selected @elseif(old('government_id') == $government->id) selected @endif>{{$government->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>