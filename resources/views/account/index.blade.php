@extends('welcome')

@section('content')

<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>USERNAME</th>
            <th>EMAIL</th>
            <th>MAX CAPACITY</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $account)
        <tr>
            <td>{{ $account->id }}</td>
            <td>{{ $account->username }}</td>
            <td>{{ $account->email }}</td>
            <td>{{ $account->storage_ctr }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection