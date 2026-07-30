<a
    href="#"
    class="btn btn-warning swal_status_btn btn-sm ">
    <i class="fas fa-edit"></i>
</a>
<form method='post' action='{{$url}}' class="d-none">
    <input type='hidden' name='_token' value='{{csrf_token()}}'>
    <br>
    <button type="submit" class="swal_form_submit_btn d-none"></button>
</form>
