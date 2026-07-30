    @if ($errors->any())
        <div style="float:left; color:#dd4444;margin-bottom: 10px;">
            <ul class="validation_error_msg">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
