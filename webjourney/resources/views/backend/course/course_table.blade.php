<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>{{ __('ID') }}</th>
        <th>{{ __('Image') }}</th>
        <th>{{ __('Title') }}</th>
        <th>{{ __('Price') }}</th>
        <th>{{ __('Categories') }}</th>
        <th>{{ __('Status') }}</th>
        <th>{{ __('Action') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($courses as $course)
    <tr>
        <td>{{ $course->id }}</td>
        <td>
            <x-backend.image_show :image="asset('images/course/'.$course->image)" />
        </td>
        <td>{{ $course->title }}</td>
        <td>{{ __('BDT:') }} {{ $course->price }}</td>
        <td>
            @foreach($course->categories as $cat)
                <span class="badge badge-primary p-2 m-1">{{ $cat->name }}</span>
            @endforeach
        </td>
        <td>
            @if($course->status=='premium')
                <span class="btn btn-primary btn-sm m-1"> {{ __('Premium') }}</span>
            @else
                <span class="btn btn-primary btn-sm m-1"> {{ __('Free') }}</span>
            @endif
             <x-backend.status_change :url="route('admin.status.course',$course->id)" />
        </td>
        <td>
            <x-backend.edit_data :url="route('admin.edit.course',$course->id)" />
            <x-backend.delete_popup :url="route('admin.delete.course',$course->id)" />
        </td>
    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>{{ __('ID') }}</th>
        <th>{{ __('Image') }}</th>
        <th>{{ __('title') }}</th>
        <th>{{ __('Price') }}</th>
        <th>{{ __('Categories') }}</th>
        <th>{{ __('Status') }}</th>
        <th>{{ __('Action') }}</th>
    </tr>
    </tfoot>
</table>
