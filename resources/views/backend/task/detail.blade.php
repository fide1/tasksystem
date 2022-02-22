@extends('backend.layouts.master')
@section('title','Task-System || Task detail')
@section('main-content')
<div class="container-fluid">
    @include('backend.layouts.notification')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">{{$username}}</h1>
      <h5><a href="{{route('user.userboard')}}">Back</a></h5>
    </div>

      <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Assigned Tasks</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
            <div class="table-responsive">
                    <table class="table table-bordered" id="task-dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Task key</th>
                                <th>Task Name</th>
                                <th>Task Type</th>
                                <th>Priority</th>
                                <th>Due date</th>
                                <th>Status</th>
                                <th>% Done</th>
                                <th>Created by</th>
                                <th>Assigned to</th>
                                <th>Comments</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($assigneds)==0)
                            <tr>
                                <p>There is nothing</p>
                            </tr>
                        @endif
                        @foreach($assigneds as $assigned)
                            <tr>
                                <td>{{$assigned->id}}</td>
                                <td>{{$assigned->name}}</td>
                                <td>{{$assigned->type}}</td>
                                <td>{{$assigned->priority}}</td>
                                <td>{{$assigned->dueDate}}</td>
                                <td>{{$assigned->status}}</td>
                                <td>{{$assigned->done}}</td>
                                <td>{{$assigned->createdBy}}</td>
                                <td>{{$assigned->assignedTo}}</td>
                                <td>{{$assigned->comments}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Completed Tasks</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
            <div class="table-responsive">
                    <table class="table table-bordered" id="task-dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Task key</th>
                                <th>Task Name</th>
                                <th>Task Type</th>
                                <th>Priority</th>
                                <th>Due date</th>
                                <th>Status</th>
                                <th>% Done</th>
                                <th>Created by</th>
                                <th>Assigned to</th>
                                <th>Comments</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($completeds)==0)
                            <tr>
                                <p>There is nothing</p>
                            </tr>
                        @endif
                        @foreach($completeds as $completed)
                            <tr>
                                <td>{{$completed->id}}</td>
                                <td>{{$completed->name}}</td>
                                <td>{{$completed->type}}</td>
                                <td>{{$completed->priority}}</td>
                                <td>{{$completed->dueDate}}</td>
                                <td>{{$completed->status}}</td>
                                <td>{{$completed->done}}</td>
                                <td>{{$completed->createdBy}}</td>
                                <td>{{$completed->assignedTo}}</td>
                                <td>{{$completed->comments}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Pending Tasks</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="task-dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Task key</th>
                                <th>Task Name</th>
                                <th>Task Type</th>
                                <th>Priority</th>
                                <th>Due date</th>
                                <th>Status</th>
                                <th>% Done</th>
                                <th>Created by</th>
                                <th>Assigned to</th>
                                <th>Comments</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($pendings)==0)
                            <tr>
                                <p>There is nothing</p>
                            </tr>
                        @endif
                        @foreach($pendings as $pending)
                            <tr>
                                <td>{{$pending->id}}</td>
                                <td>{{$pending->name}}</td>
                                <td>{{$pending->type}}</td>
                                <td>{{$pending->priority}}</td>
                                <td>{{$pending->dueDate}}</td>
                                <td>{{$pending->status}}</td>
                                <td>{{$pending->done}}</td>
                                <td>{{$pending->createdBy}}</td>
                                <td>{{$pending->assignedTo}}</td>
                                <td>{{$pending->comments}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">OverDue Tasks</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
            <div class="table-responsive">
                    <table class="table table-bordered" id="task-dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Task key</th>
                                <th>Task Name</th>
                                <th>Task Type</th>
                                <th>Priority</th>
                                <th>Due date</th>
                                <th>Status</th>
                                <th>% Done</th>
                                <th>Created by</th>
                                <th>Assigned to</th>
                                <th>Comments</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($overDues)==0)
                            <tr>
                                <p>There is nothing</p>
                            </tr>
                        @endif
                        @foreach($overDues as $overDue)
                            <tr>
                                <td>{{$overDue->id}}</td>
                                <td>{{$overDue->name}}</td>
                                <td>{{$overDue->type}}</td>
                                <td>{{$overDue->priority}}</td>
                                <td>{{$overDue->dueDate}}</td>
                                <td>{{$overDue->status}}</td>
                                <td>{{$overDue->done}}</td>
                                <td>{{$overDue->createdBy}}</td>
                                <td>{{$overDue->assignedTo}}</td>
                                <td>{{$overDue->comments}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@endpush