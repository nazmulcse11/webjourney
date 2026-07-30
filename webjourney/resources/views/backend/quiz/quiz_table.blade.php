<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>{{ __('ID') }}</th>
        <th>{{ __('Title') }}</th>
        <th>{{ __('Type') }}</th>
        <th>{{ __('Options') }}</th>
        <th>{{ __('Status') }}</th>
        <th>{{ __('Action') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($quizzes as $quiz)
    <tr>
        <td>{{ $quiz->id }}</td>
        <td>{!! $quiz->title !!}</td>
        <td>{{ $quiz->type }}</td>
        <td>
            <span>{{ $quiz->option_a }}</span></br>
            <span>{{ $quiz->option_b }}</span></br>
            <span>{{ $quiz->option_c }}</span></br>
            <span>{{ $quiz->option_d }}</span></br>
        </td>
        <td>
            @if($quiz->status==1)
                <span class="btn btn-primary btn-sm m-1"> {{ __('Active') }}</span>
            @else
                <span class="btn btn-danger btn-sm m-1"> {{ __('Inactive') }}</span>
            @endif
             <x-backend.status_change :url="route('admin.status.quiz',$quiz->id)" />
        </td>
        <td>
            <x-backend.edit_data :url="route('admin.edit.quiz',$quiz->id)" />
            <x-backend.delete_popup :url="route('admin.delete.quiz',$quiz->id)" />
        </td>
    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>{{ __('ID') }}</th>
        <th>{{ __('Title') }}</th>
        <th>{{ __('Type') }}</th>
        <th>{{ __('Options') }}</th>
        <th>{{ __('Status') }}</th>
        <th>{{ __('Action') }}</th>
    </tr>
    </tfoot>
</table>
