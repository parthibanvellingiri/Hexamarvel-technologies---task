<script src="{{ asset('css/custom.css') }}"></script>
<a onclick="AjaxModal(this.href,'Add Users');return false;"
   href="{{ route('addUser') }}">ADD</a>

<br>
<form action="{{ route('searchUserByIdandName') }}" method="post" id="searchbynameid">
    @csrf
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
            <label>User ID</label>
           <input class="form-control" name="name">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>User Name</label>
                <input class="form-control" name="user_id">
            </div>
        </div>
        <div class="col-md-2">
            <button type="submit" >Search</button>
        </div>
    </div>
</form>
<br>
<table border="1" id="withoutsearch">
    <thead>
    <tr>
        <th>S.No</th>
        <th>Company Name</th>
        <th>User ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Gender</th>
        <th>Branch</th>
        <th>Designation</th>
        <th>DOB</th>
        <th>DOJ</th>
        <th>Action</th>
    </tr>
    </thead>

    <tbody>
    @php($sl=1)
    @forelse($users as $user)

        <tr>
            <th>{{ $sl }}</th>
            <th></th>
            <th></th>
            <th>{{ $user->name }}</th>
            <th>{{ $user->email }}</th>
            <th>{{ $user->phone }}</th>
            <th>{{ $user->gender }}</th>
            <th></th>
            <th></th>
            <th>{{ $user->dob }}</th>
            <th>{{ $user->doj }}</th>
            <th><a onclick="AjaxModal(this.href,'User Details');return false;"
                   href="{{ route('viewDetails',[$user->id]) }}">View Details</a> </th>
        </tr>

        @php($sl++)
        @empty

    @endforelse
    </tbody>

</table>

<script src="{{ asset('jquery-confirm/jquery-confirm.min.css') }}"></script>
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('jquery-confirm/jquery-confirm.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script>
    $(document).ready(function () {


        $("#searchbynameid").submit(function (e) {


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

                    $("#withoutsearch").hide();
                    $("#withsearch").html(data);

                },
                error: function (err) {

                }
            });
            e.preventDefault(); // avoid to execute the actual submit of the form.
        });
    });

    $(function () {
        $( "#dialog1" ).dialog({
            autoOpen: false
        });

        $("#opener").click(function() {
            $("#dialog1").dialog('open');
        });
    });

    function AjaxModal(url, title) {
        $.dialog({
            content: function () {
                var self = this;
                return $.ajax({
                    url: url,
                    method: 'GET'
                }).done(function (response) {
                    self.setContent(response);
                    self.setTitle(title);
                }).fail(function () {
                    self.setContent('Something went wrong.');
                });
            },
            columnClass: 'medium',
            theme: 'bootstrap', // 'material', 'bootstrap','dark','light',
            useBootstrap: true,
            escapeKey: '{{ strtolower(trans('common.close')) }}',
            draggable: false,
            animation: 'zoom',
            closeAnimation: 'bottom',
            buttons: {
                "{{ strtolower(trans('common.close')) }}": function () {

                }
            },
            onClose: function () {
            },
        });
    }


</script>
