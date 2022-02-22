@extends('backend.layouts.master')
@section('title','Task-System || Task Page')
@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('backend.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3 align">
      <h6 class="m-0 font-weight-bold text-primary float-left">All Tasks</h6>
      <select class="form-control float-left col-md-2" onchange="myFunction({{\APP\Task::getAllDepMyTasksId(Auth()->user()->department_id)}}, {{\APP\Task::getAllDepMyOverDueId(Auth()->user()->department_id)}}, {{\APP\Task::getDepMyOpenId(Auth()->user()->department_id)}});" id="selDepartment">        
        @if(count($departments)==0)
            <option>Select Department</option>
            <option>There is any data...</option>
        @else
          <option>Select Department</option>
          @foreach($departments as $department)
            <option value="{{$department->name}}">{{$department->name}}</option>
          @endforeach 
        @endif
      </select>
      <select class="form-control float-left col-md-2" onchange="myFunction({{\APP\Task::getAllDepMyTasksId(Auth()->user()->department_id)}}, {{\APP\Task::getAllDepMyOverDueId(Auth()->user()->department_id)}}, {{\APP\Task::getDepMyOpenId(Auth()->user()->department_id)}});" id="selMyTask">
        <option>Select Task</option>
        <option>All My tasks</option>
        <option>My Overdue tasks</option>
        <option>My open Tasks</option>
      </select>
      <select class="form-control float-left col-md-2" onchange="myFunction({{\APP\Task::getAllDepMyTasksId(Auth()->user()->department_id)}}, {{\APP\Task::getAllDepMyOverDueId(Auth()->user()->department_id)}}, {{\APP\Task::getDepMyOpenId(Auth()->user()->department_id)}});" id="selType">
        <option value="access">Access</option>
        <option value="public">Public</option>
        <option value="private">Private</option>
      </select>
      <a href="{{route('admintask.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Create Task</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(isset($success))
          {{$success}}
        @endif
        @if(isset($error))
          {{$error}}
        @endif
        @if(count($tasks)>0)
        <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Task key</th>
              <th>Task Name</th>
              <th>Department</th>
              <th>Task Type</th>
              <th>Priority</th>
              <th>Due date</th>
              <th>Status</th>
              <th>% Done</th>
              <th>Created by</th>
              <th>Assigned to</th>
              <th>Comments</th>
              <th>Attached File</th>
              <th>View</th>
            </tr>
          </thead>
          <tbody>
            @foreach($tasks as $task)   
                <tr>
                    <td>{{$task->id}}</td>
                    <td>{{$task->name}}</td>
                    <td>{{\App\Department::getDepartmentName($task->department_id)}}</td>
                    <td>
                    @if($task->type == 'public')
                      <span class="badge badge-success">{{$task->type}}</span>
                    @else
                      <span class="badge badge-danger">{{$task->type}}</span>
                    @endif
                    </td>
                    <td>
                      <ul style="list-style:none">
                          @for($i=1; $i<=5;$i++)
                            @if($task->priority >=$i)
                              <li style="float:left;color:#F7941D;"><i class="fa fa-star"></i></li>
                            @else 
                              <li style="float:left;color:#F7941D;"><i class="far fa-star"></i></li>
                            @endif
                          @endfor
                      </ul>
                    </td>
                    <td>
                            <span class="badge badge-success">{{$task->dueDate}}</span>
                    </td>
                    <td>{{$task->status}}</td>
                    <td>{{$task->done}}</td>
                    <td>{{$task->createdBy}}</td>
                    <td>{{$task->assignedTo}}</td>
                    <td>{{$task->comments}}</td>
                    <td><a href="/images/image/{{$task->file_name}}">{{$task->file_name}}</a></td>
                    <td>
                        <a href="{{route('admintask.edit',$task->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                        <form method="post" action="{{route('admintask.destroy',$task->id)}}">
                          @csrf 
                          <button type="submit"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>  
            @endforeach
          </tbody>
        </table>
        @else
          <h6 class="text-center">No tasks found!!! Please create task</h6>
        @endif
      </div>
    </div>
</div>
@endsection

@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      }
      .zoom {
        transition: transform .2s; /* Animation */
      }

      .zoom:hover {
        transform: scale(3.2);
      }
      .py-3.align {
        display: flex;
        justify-content: space-between;
      }
      .py-3.align h6 {
        padding: 10px 0;
      }
      .py-3.align a {
        padding-top: 8px;
      }
  </style>
@endpush

@push('scripts')

  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>
      
      $('#task-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[3,4,5]
                }
            ]
        } );

        // Sweet alert

        function deleteData(id){
            
        }
  </script>
  <script>
      $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
              var dataID=$(this).data('id');
              // alert(dataID);
              e.preventDefault();
              swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                       form.submit();
                    } else {
                        swal("Your data is safe!");
                    }
                });
          })
      })
  </script>
  <script>
    function myFunction(allMyTasks, allOverDueTasks, openTasks) {
      // Declare variables
      var input, filter1, filter2, table, tr, td1, td2, i, txtValue;
      input1 = document.getElementById("selType");
      input2 = document.getElementById("selDepartment");
      filter1 = input1.value.toUpperCase();
      filter2 = input2.value.toUpperCase();
      if(filter1.indexOf('ACCESS') == 0) filter1 = "";
      if(filter2.indexOf('SELECT DEPARTMENT') == 0) filter2 = "";
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      // Loop through all table rows, and hide those who don't match the search query
      var input3 = document.getElementById("selMyTask");
      var filter3 = input3.value.toUpperCase();
      var sel_id;
      var check_val;
      switch(filter3) {
        case 'SELECT TASK':
          check_val = allMyTasks.concat(allOverDueTasks, openTasks);
          break;
        case 'ALL MY TASKS':
          check_val = allMyTasks;
          break;
        case 'MY OVERDUE TASKS':
          check_val = allOverDueTasks;
          break;
        case 'MY OPEN TASKS':
          check_val = openTasks;
          break;
      }
      for (i = 0; i < tr.length; i++) {
        td1 = tr[i].getElementsByTagName("td")[3];
        td2 = tr[i].getElementsByTagName("td")[2];
        td3 = tr[i].getElementsByTagName("td")[0];
        if (td1, td2, td3) {
          txtValue1 = td1.textContent || td1.innerText;
          txtValue2 = td2.textContent || td2.innerText;
          txtValue3 = td3.textContent || td3.innerText;
          if (txtValue1.toUpperCase().indexOf(filter1) > -1 && txtValue2.toUpperCase().indexOf(filter2) > -1  && check_val.indexOf(Number(txtValue3)) > -1) {
              tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
  </script>
@endpush