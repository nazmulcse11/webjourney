<div class="col-sm-6">
    <h1>{{ __($title ?? '') }}</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Home') }}</a></li>
        <li class="breadcrumb-item active">{{ __($title ?? '') }}</li>
    </ol>
</div>
