@extends('user.layouts.master')
@section('title','Task-System || Task Edit')
@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Task</h5>
    <div class="card-body">
      <form method="post" action="{{route('task.update', $task->id)}}">
        @csrf
        <div class="form-group">
          <label for="inputName" class="col-form-label">Name <span class="text-danger">*</span></label>
          <input id="inputName" type="text" name="name" placeholder="Enter Name"  value="{{$task->name}}" class="form-control">
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
          <label for="inputComments" class="col-form-label">File Upload: </label>
          <input type="file" name="file">
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