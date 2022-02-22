@extends('backend.layouts.master')
@section('title','Task-System || Task Edit')
@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Banner</h5>
    <div class="card-body">
      <form method="post" action="{{route('admintask.update',$task->id)}}" enctype="multipart/form-data">
        @csrf 
        <div class="form-group">
          <label for="inputName" class="col-form-label">Name <span class="text-danger">*</span></label>
          <input id="inputName" type="text" name="name" placeholder="Enter Name"  value="{{$task->name}}" class="form-control">
        </div>

        <div class="form-group">
          <label for="type" class="col-form-label">Type <span class="text-danger">*</span></label>
          <select name="type" class="form-control" sel={{$task->type}}>
              <option value="public" @if($task->type == 'public') ? selected : ''@endif>Public</option>
              <option value="private" @if($task->type == 'private') ? selected : ''@endif>Private</option>
          </select>
        </div>

        <div class="form-group">
          <label for="priority" class="col-form-label">Priority <span class="text-danger">*</span></label>
          <select name="priority" class="form-control">
              <option value="1" @if($task->priority == 1) ? selected : ''@endif>1</option>
              <option value="2" @if($task->priority == 2) ? selected : ''@endif>2</option>
              <option value="3" @if($task->priority == 3) ? selected : ''@endif>3</option>
              <option value="4" @if($task->priority == 4) ? selected : ''@endif>4</option>
              <option value="5" @if($task->priority == 5) ? selected : ''@endif>5</option>
          </select>
        </div>

        <div class="form-group">
          <label for="inputDueDate" class="col-form-label">due Date <span class="text-danger">*</span></label>
          <input id="inputDueDate" type="date" name="dueDate" placeholder="Enter due Date"  value="{{$task->dueDate}}" class="form-control">
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="on-going" @if($task->status == "on-going") ? selected : ''@endif>on-going</option>
              <option value="not-going" @if($task->status == "not-going") ? selected : ''@endif>not-going</option>
          </select>
        </div>

        <div class="form-group">
          <label for="inputDone" class="col-form-label">Done <span class="text-danger">*</span></label>
          <input id="inputDone" type="text" name="done" placeholder="Enter Done %"  value="{{$task->done}}" class="form-control">
        </div>

        <div class="form-group">
          <label for="inputCreatedBy" class="col-form-label">Created By <span class="text-danger">*</span></label>
          <input id="inputCreatedBy" type="text" name="createdBy" placeholder="Enter Created By"  value="{{$task->createdBy}}" class="form-control">
        </div>

        <div class="form-group">
          <label for="inputAssignedTo" class="col-form-label">Assigned To <span class="text-danger">*</span></label>
          <select name="assignedTo" class="form-control">
            @foreach($users as $user)
              <option value="{{$user->name}}" @if($task->assignedTo == $user->name) ? selected : ''@endif>{{$user->name}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="inputComments" class="col-form-label">Comments</label>
          <textarea class="form-control" id="description" name="comments">
            {{$task->comments}}
          </textarea>
        </div>

        <div class="form-group">
          <label for="inputComments" class="col-form-label">File Upload: </label>
          <input type="file" name="file"></textarea>
        </div>

        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">Update</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('styles')
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
@endpush