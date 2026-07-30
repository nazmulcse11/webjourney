<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>{{ __('ID') }}</th>
        <th>{{ __('Image') }}</th>
        <th>{{ __('Title') }}</th>
        <th>{{ __('Categories') }}</th>
        <th>{{ __('Sub Categories') }}</th>
        <th>{{ __('Status') }}</th>
        <th>{{ __('Action') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($posts as $post)
    <tr>
        <td>{{ $post->id }}</td>
        <td>
            <x-backend.image_show :image="asset('images/post/'.$post->image)" />
        </td>
        <td>{{ $post->title }}</td>
        <td>
            @foreach($post->categories as $cat)
                <span class="badge badge-primary p-2 m-1">{{ $cat->name }}</span>
            @endforeach
        </td>
        <td>
            @foreach($post->sub_categories as $sub_cat)
                <span class="badge badge-primary p-2 m-1">{{ $sub_cat->name }}</span>
            @endforeach
        </td>
        <td>
            @if($post->status=='publish')
                <span class="btn btn-primary btn-sm m-1"> {{ __('Published') }}</span>
            @else
                <span class="btn btn-primary btn-sm m-1"> {{ __('Draft') }}</span>
            @endif
             <x-backend.status_change :url="route('admin.status.post',$post->id)" />
        </td>
        <td>
            <x-backend.edit_data :url="route('admin.edit.post',$post->id)" />
            <x-backend.delete_popup :url="route('admin.delete.post',$post->id)" />
        </td>
    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>{{ __('ID') }}</th>
        <th>{{ __('Image') }}</th>
        <th>{{ __('title') }}</th>
        <th>{{ __('Categories') }}</th>
        <th>{{ __('Sub Categories') }}</th>
        <th>{{ __('Status') }}</th>
        <th>{{ __('Action') }}</th>
    </tr>
    </tfoot>
</table>
