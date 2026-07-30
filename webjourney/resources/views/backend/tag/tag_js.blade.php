
<script>
    $(document).ready(function(){
        //slug generate
        $(document).on('keyup','#name',function(){
            let name = $(this).val();
            name = name.toLowerCase();
            name = name.replace(/[^a-zA-Z0-9]+/g,'-');
            $("#slug").val(name);
        });

        //edit tag
        $(document).on('click','.edit_tag_btn',function(){
            let id = $(this).data('id');
            let name = $(this).data('name');
            let slug = $(this).data('slug');

            $('#e_id').val(id);
            $('#e_name').val(name);
            $('#e_slug').val(slug);
        })

        //delete tag
        $(document).on('click','.swal_delete_btn',function(){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).next().find('.swal_form_submit_btn').trigger('click');
                }
            });
        })

    });

</script>
