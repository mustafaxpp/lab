<div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fa fa-cog"></i>
    </button>
    
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      
       @can('edit_group')
          <a href="{{route('admin.groups.edit',$group['id'])}}" class="dropdown-item">
             <i class="fa fa-edit"></i>
             {{__('Edit')}}
          </a>
       @endcan

       @can('view_group')
         <a style="cursor: pointer" data-toggle="modal" data-target="#print_barcode_modal" class="dropdown-item print_barcode" group_id="{{$group['id']}}">
            <i class="fa fa-barcode" aria-hidden="true"></i>
            {{__('Print barcode')}}
         </a>
         <a href="{{route('admin.groups.working_paper',$group['id'])}}" class="dropdown-item">
            <i class="fas fa-file-word" aria-hidden="true"></i>
            {{__('Working paper')}}
         </a>
         <a href="{{$group['receipt_pdf']}}" class="dropdown-item" target="_blank">
            <i class="fa fa-print" aria-hidden="true"></i>
            {{__('Print receipt')}}
         </a>
         <a href="{{route('admin.groups.show',$group['id'])}}" class="dropdown-item">
            <i class="fa fa-eye" aria-hidden="true"></i>
            {{__('Show receipt')}}
         </a>
         @if($whatsapp['receipt']['active']&&isset($group['receipt_pdf']))
         <a target="_blank" href="{{whatsapp_notification($group,'receipt')}}" class="dropdown-item">
            <i class="fab fa-whatsapp" aria-hidden="true" class="text-success"></i>
            {{__('Send receipt')}}
         </a>
         @endif
         @if($email['receipt']['active']&&isset($group['receipt_pdf']))
         <form action="{{route('admin.groups.send_receipt_mail',$group['id'])}}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="dropdown-item">
               <i class="fa fa-envelope" aria-hidden="true" class="text-success"></i>
               {{__('Send receipt')}}
            </button>
         </form>
         @endif
       @endcan
       
       @can('edit_medical_report')
         <a href="{{route('admin.medical_reports.edit',$group['id'])}}" class="dropdown-item">
            <i class="fa fa-flag"></i>
            {{__('Enter report')}}
         </a>
       @endcan

       @can('delete_group')
          <form method="POST" action="{{route('admin.groups.destroy',$group['id'])}}" class="d-inline">
             <input type="hidden" name="_method" value="delete">
             <a href="#" class="dropdown-item delete_group">
                <i class="fa fa-trash"></i>
                {{__('Delete')}}
             </a>
          </form>
       @endcan
       @can('edit_medical_report')
         <a href="#" data-toggle="modal" data-target="#exampleModalCenter{{$group['id']}}" class="dropdown-item">
            <i class="fa fa-check"></i>
            {{__('Check Test')}}
         </a>
       @endcan
    </div>
 </div>

@php

   // get group by id
   $group = \App\Models\Group::find($group['id']);

@endphp

 <!-- Modal -->
<div class="modal fade" id="exampleModalCenter{{$group['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">{{__('Check Test')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form action="{{route('admin.group.check.test' , $group['id'])}}" method="post">
            @csrf()
            @foreach($group->all_tests as $test)
               <div class="form-group">
                  <label for="">{{$test->test->name}}</label>
                  <input type="hidden" class="form-control" name="test_id[]" value="{{$test->id}}">
                  <input type="checkbox" class="form-control check-test" {{ $test->check_test == 1 ? 'checked' : '' }} name="" value="{{ $test->id }}">
                  <input type="hidden" class="form-control check_test" name="check_test[]" value="{{ $test->check_test == 1 ? $test->id : '' }}">
               </div>
            @endforeach
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
              <button class="btn btn-primary">{{__('Save')}}</button>
            </div>
         </form>

      </div>
    </div>
  </div>
</div>