<table class="table table-bordered">
    <thead>
        <tr><th>Name</th><th>Email</th><th>Action</th></tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
