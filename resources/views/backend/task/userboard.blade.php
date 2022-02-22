@extends('backend.layouts.master')

@section('title','Task-Systtem || Userboard')

@section('main-content')

<div class="card">
    <h5 class="card-header">User Board</h5>
    <div class="card-body">
      <table class="table table-bordered" id="task-dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>User key</th>
            <th>User Name</th>
            <th>Department</th>
            <th>Email</th>
            <th>View</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
            <tr>
              <td>{{$user->id}}</td>
              <td>{{$user->name}}</td>
              <td>{{\App\Department::getDepartmentName($user->department_id)}}</td>
              <td>{{$user->email}}</td>
              <td><a href="{{route('admin.userboardDetail', $user->name)}}"><i class="fas fa-book"></i></a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
</div>

@endsection

@push('styles')
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
@endpush