@extends('layouts.mainlayout')

@section('content')
<div class="container">

    <a href="{{ url('workorders/create') }}" class="btn btn-success">Create</a>

    @include('layouts.messages')

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Company name</th>
                <th scope="col">Name</th>
                <th scope="col">Jobname</th>
                <th scope="col">Jobnumber</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($workorders as $workorder)
            <tr>
                <th scope="row">{{ $workorder->id }}</th>
                <td>{{ $workorder->user->company_name }}</td>
                <td>{{ $workorder->user->name }}</td>
                <td>{{ $workorder->jobname }}</td>
                <td>{{ $workorder->jobnumber }}</td>
                <td>{{ $workorder->created_at->format('M-d-Y g:i:s A') }}</td>
                <td>
                    <form action="/workorders/{{ $workorder->id }}" method="POST">
                        @method('DELETE')
                        @csrf

                        <a href="{{url('/workorders/' . $workorder->id)}}" class="btn btn-info">View</a>
                        @role('admin')
                        <a href="{{url('/workorders/' . $workorder->id . '/edit')}}" class="btn btn-warning">Edit</a>
                        @endrole
                        @role('admin')
                        <button type="submit" class="btn btn-danger">Delete</button>
                        @endrole
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection