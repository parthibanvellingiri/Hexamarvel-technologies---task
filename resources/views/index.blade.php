
<a href="{{ route('users') }}">UserManagement</a>
<table border="1">
    <thead>
    <tr>
        <th>S.No</th>
        <th>Company Name</th>
        <th>Email</th>
        <th>Mobile</th>
    </tr>
    </thead>

    <tbody>
    @php($sl=1)
    @forelse($companies as $company)

        <tr>
            <th>{{ $sl }}</th>
            <th>{{ $company->company_name }}</th>
            <th>{{ $company->email }}</th>
            <th>{{ $company->phone }}</th>
        </tr>

        @php($sl++)
        @empty

    @endforelse
    </tbody>

</table>

{{ $companies->links() }}
