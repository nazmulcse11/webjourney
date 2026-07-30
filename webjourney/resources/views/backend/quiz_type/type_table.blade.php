<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>{{ __('ID') }}</th>
        <th>{{ __('Type') }}</th>
        <th>{{ __('Slug') }}</th>
        <th>{{ __('Status') }}</th>
        <th>{{ __('Action') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($types as $type)
    <tr>
        <td>{{ $type->id }}</td>
        <td>{{ $type->type }}</td>
        <td>{{ $type->slug }}</td>
        <td>
            @if($type->status==1)
                <span class="btn btn-primary btn-sm m-1"> {{ __('Active') }}</span>
            @else
                <span class="btn btn-danger btn-sm m-1"> {{ __('Inactive') }}</span>
            @endif
             <x-backend.status_change :url="route('admin.status.type',$type->id)" />
        </td>
        <td>
            <x-backend.edit_data :url="route('admin.edit.type',$type->id)" />
            <x-backend.delete_popup :url="route('admin.delete.type',$type->id)" />
        </td>
    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>{{ __('ID') }}</th>
        <th>{{ __('Type') }}</th>
        <th>{{ __('Slug') }}</th>
        <th>{{ __('Status') }}</th>
        <th>{{ __('Action') }}</th>
    </tr>
    </tfoot>
</table>
