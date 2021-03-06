@extends('layouts.app')

@section('content')
  <div class="container">
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
    @endif
    <p>Filter op status</p>
    <select id="statusFilter" onchange="FilterTasks('statusFilter', '2');">
      <option value="" selected="selected"></option>
      <option value="Completed">Completed</option>
      <option value="Awaiting completion">Awaiting completion</option>
    </select>
    <p>Filter op duur</p>
    <input type="text" id="durationFilter" onkeyup="FilterTasks('durationFilter', '1');">
    <table id="table" class="table table-striped">
    <thead>
      <tr>
        <th onclick="Sort(0)">Title</th>
        <th>Duration</th>
        <th onclick="Sort(2)">Status</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
      <tbody>
        
          @foreach($tasks as $task)
          <tr>
            <td>{{$task['title']}}</td>
            <td>{{$task['duration']}}</td>
            <td>{{$task['status']}}</td>
            <td><a href="{{action('TaskController@edit', $task['id'])}}" class="btn btn-warning">Edit</a></td>
            <td>
              <form action="{{action('TaskController@destroy', $task['id'])}}" method="post">
                @csrf
                <input name="_method" type="hidden" value="DELETE">
                <button class="btn btn-danger" type="submit">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <a href="{{ route('tasks.create', [$id]) }}">Add new task</a></th>
  </div>
<script type="text/javascript" src="{{ URL::asset('js/javascript.js') }}"></script>
@endsection