<a
    href="#"
    class="btn btn-danger swal_delete_btn btn-sm m-1">
    <i class="fas fa-times"></i>
</a>

<form method='post' action='{{$url}}' class="d-none">
    <input type='hidden' name='_token' value='{{csrf_token()}}'>
    <br>
    <button type="submit" class="swal_form_submit_btn d-none"></button>
</form>
