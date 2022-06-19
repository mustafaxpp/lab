@extends('layouts.app')

@section('title')
{{__('Fixed Assets')}}
@endsection

@section('breadcrumb')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
          <i class="nav-icon fas fa-user-injured"></i>
          {{__('Fixed Assets')}}
        </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.index')}}">{{__('Home')}}</a></li>
          <li class="breadcrumb-item active">{{__('Fixed Assets')}}</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
@endsection

@section('content')
<div class="card card-primary card-outline">
  <div class="card-header">
    <h3 class="card-title">{{__('Fixed Assets Table')}}</h3>
    @can('create_patient')
    <a href="{{route('admin.fixed_assets.create')}}" class="btn btn-primary btn-sm float-right">
      <i class="fa fa-plus"></i> {{__('Create')}}
    </a>
    @endcan
  </div>
  <!-- /.card-header -->
  <div class="card-body">


    <div class="row">
      <div class="col-lg-12 table-responsive">
        <table id="fixed_assets_table" class="table table-striped table-bordered" width="100%">
          <thead>
            <tr>
              <th width="10px">
                <input type="checkbox" class="check_all" name="" id="">
              </th>
              <th width="10px">#</th>
              <th>{{__('Name')}}</th>     
              <th>{{__('Price')}}</th>     
              <th>{{__('Branche')}}</th>     
              <th>{{__('Supplier')}}</th>     
              <th>{{__('Image')}}</th>
              <th width="150px">{{__('Action')}}</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>

      </div>
    </div>
  </div>
  <!-- /.card-body -->
</div>

@endsection
@section('scripts')
<script>
  var can_delete = @can('delete_patient') true @else false @endcan
</script>
<script src="{{url('js/admin/fixed_assets.js')}}"></script>
@endsection