<form id="formsubmit" action="{{ route('usersImport') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="importfile">
    <button type="submit" id="submit" class="btn btn-custom">Import</button>

</form>
<script>
    $(document).ready(function () {


        $("#formsubmit").submit(function (e) {


            $('.error-message').remove();

            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function (data) {

                    $("#closebutton").trigger('click');
                    alert('imported sucessfully');
                    window.location = '{{ route('users') }}';
                    },
                error: function (err) {

                    if (err.status == 422) { // when status code is 422, it's a validation issue
                        // display errors on each form field
                        $.each(err.responseJSON.errors, function (i, error) {
                            var el = $(document).find('[name="' + i + '"]');
                            el.after($('<span class="error-message" style="color: red;">'+error[0]+'</span>'));
                        });
                    }
                }
            });
            e.preventDefault(); // avoid to execute the actual submit of the form.
        });
    });
</script>
