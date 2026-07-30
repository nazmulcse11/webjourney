<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>{{ __('ID') }}</th>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Slug') }}</th>
        <th>{{ __('Action') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tags as $tag)
    <tr>
        <td>{{ $tag->id }}</td>
        <td>{{ $tag->name }}</td>
        <td>{{ $tag->slug }}</td>
        <td>
            <a href="#"
               class="btn btn-warning edit_tag_btn btn-sm"
               data-toggle="modal"
               data-target="#editTagModal"
               data-id="{{ $tag->id }}"
               data-name="{{ $tag->name }}"
               data-slug="{{ $tag->slug }}"
               >
               <i class="fas fa-edit"></i>
            </a>
            <x-backend.delete_popup :url="route('admin.delete.tag',$tag->id)" />
        </td>
    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>{{ __('ID') }}</th>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Slug') }}</th>
        <th>{{ __('Action') }}</th>
    </tr>
    </tfoot>
</table>
