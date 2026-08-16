<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>{{ __('ID') }}</th>
        <th>{{ __('Image') }}</th>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Sub Categories') }}</th>
        <th>{{ __('Status') }}</th>
        <th>{{ __('Action') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($categories as $category)
    <tr>
        <td>{{ $category->id }}</td>
        <td>
            <x-backend.image_show :image="asset('images/category/'.$category->image)" />
        </td>
        <td>{{ $category->name }}</td>
        <td>
            @foreach($category->sub_categories as $sub_cat)
            <span class="badge badge-primary p-2 m-1">{{ $sub_cat->name }}</span>
            @endforeach
        </td>
        <td>
            @if($category->status==1)
                <span class="btn btn-primary btn-sm m-1"> {{ __('Active') }}</span>
            @else
                <span class="btn btn-danger btn-sm m-1"> {{ __('Inactive') }}</span>
            @endif
             <x-backend.status_change :url="route('admin.status.category',$category->id)" />
        </td>
        <td>
            <a href="#"
               class="btn btn-warning edit_category_btn btn-sm"
               data-toggle="modal"
               data-target="#editCategoryModal"
               data-id="{{ $category->id }}"
               data-name="{{ $category->name }}"
               data-slug="{{ $category->slug }}"
               >
               <i class="fas fa-edit"></i>
            </a>
            <x-backend.delete_popup :url="route('admin.delete.category',$category->id)" />
        </td>
    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>{{ __('ID') }}</th>
        <th>{{ __('Image') }}</th>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Sub Categories') }}</th>
        <th>{{ __('Status') }}</th>
        <th>{{ __('Action') }}</th>
    </tr>
    </tfoot>
</table>
