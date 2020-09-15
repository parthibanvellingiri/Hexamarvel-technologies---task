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

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label>Sort by Branch</label>
                <select name="branch" id="branch" onchange="searchbranchdesignation(this.value,'1')">

                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Sort by Designation</label>
                <select name="designation" id="designation" onchange="searchbranchdesignation(this.value,'2')">

                    @foreach($designations as $designation)
                        <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-2">
            <button type="submit" >Search</button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label>Select Branch</label>
                <select name="branch" id="branch">

                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Select Gender</label>
                <select name="gender" id="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
        </div>
        <div>
            <div>
                <button onclick="filter();">Filter</button>
            </div>
        </div>
    </div>


<br>
<table border="1">
    <div id="withoutsearch">
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
    </div>
    <div id="withsearch" style="display: none">

{{--        Ajax Load--}}

    </div>

</table>

{{ $users->links() }}
<script src="{{ asset('jquery-confirm/jquery-confirm.min.css') }}"></script>
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('jquery-confirm/jquery-confirm.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script>
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

    function searchbranchdesignation(name,selecttype){
        if (selecttype == 1){
            $.ajax({
                type: "POST",
                url: "{{ route('ajax.sortByBranchDesignation') }}",
                data: {_token: '<?php echo csrf_token() ?>', designation: $('#designation').val()},
                success: function (data) {

                    $('#customer_data').hide();
                    $('#showdata').html(data);

                }
            });
        }else {
            $.ajax({
                type: "POST",
                url: "{{ route('ajax.sortByBranchDesignation') }}",
                data: {_token: '<?php echo csrf_token() ?>', branch: $('#branch').val()},
                success: function (data) {

                    $('#withoutsearch').hide();
                    $('#withsearch').html(data);

                }
            });
        }

    }


    function filter() {
        $.ajax({
            type: "POST",
            url: "{{ route('ajax.filterGenderandBranch') }}",
            data: {_token: '<?php echo csrf_token() ?>', branch: $('#branch').val(),gender: $('#gender').val()},
            success: function (data) {

                $('#withoutsearch').hide();
                $('#withsearch').html(data);

            }
        });

    }


</script>
