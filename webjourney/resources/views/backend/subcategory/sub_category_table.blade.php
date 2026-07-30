<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>{{ __('ID') }}</th>
        <th>{{ __('Image') }}</th>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Category') }}</th>
        <th>{{ __('Status') }}</th>
        <th>{{ __('Action') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($sub_categories as $sub_category)
    <tr>
        <td>{{ $sub_category->id }}</td>
        <td>
            <x-backend.image_show :image="asset('images/subcategory/'.$sub_category->image)" />
        </td>
        <td>{{ $sub_category->name }}</td>
        <td>{{ optional($sub_category->category)->name }}</td>
        <td>
            @if($sub_category->status==1)
                <span class="btn btn-primary btn-sm"> {{ __('Active') }}</span>
            @else
                <span class="btn btn-primary btn-sm"> {{ __('Inactive') }}</span>
            @endif
             <x-backend.status_change :url="route('admin.status.subcategory',$sub_category->id)" />
        </td>
        <td>
            <a href="#"
               class="btn btn-warning edit_sub_category_btn btn-sm"
               data-toggle="modal"
               data-target="#editSubCategoryModal"
               data-id="{{ $sub_category->id }}"
               data-name="{{ $sub_category->name }}"
               data-slug="{{ $sub_category->slug }}"
               data-category_id="{{ $sub_category->category_id }}"
               >
               <i class="fas fa-edit"></i>
            </a>
            <x-backend.delete_popup :url="route('admin.delete.subcategory',$sub_category->id)" />
        </td>
    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>{{ __('ID') }}</th>
        <th>{{ __('Image') }}</th>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Category') }}</th>
        <th>{{ __('Status') }}</th>
        <th>{{ __('Action') }}</th>
    </tr>
    </tfoot>
</table>
