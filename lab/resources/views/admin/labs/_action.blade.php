<div class="text-center">

    @can('edit_contract')
        <a href="{{route('admin.labs.edit',$lab['id'])}}" class="btn btn-primary btn-sm">
            <i class="fa fa-edit"></i>
        </a>
    @endcan

    @can('delete_contract')
            <form method="POST" action="{{route('admin.labs.destroy',$lab['id'])}}" class="d-inline">
                <input type="hidden" name="_method" value="delete">
                <button type="submit" class="btn btn-danger btn-sm delete_lab">
                    <i class="fa fa-trash"></i>
                </button>
            </form>
    @endcan

</div>
