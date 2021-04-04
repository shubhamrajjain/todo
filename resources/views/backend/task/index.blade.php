@extends('backend.layout.master')
@section('content')
@php
use Illuminate\Support\Facades\Route;
@endphp
<div class="content-wrapper">
    <div class="content-header" style=" padding: 7px .5rem !important;">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">{{$heading}}</a></li>
                    </ol>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{route('task.create')}}">
                        <button type="button" class="btn btn-sm btn-primary">Add Task</button>
                    </a>
                    @if(Route::currentRouteName() == 'tasks.index')
                    <a href="{{route('task.export')}}">
                        <button type="button" class="btn btn-sm btn-success">Export </button>
                    </a>
                    @endif
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content-header">
        <div class="container-fluid">
            @if(Session::has('success'))

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success" role="alert">
                        {{session('success')}}
                    </div>
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <form class="form-inline">
                        {{-- <div class="form-group mx-sm-2 mb-2">
                            <input type="text" class="form-control form-control-sm" id="staticEmail2" value="">
                        </div> --}}
                        <div class="form-group mx-sm-2 mb-2">

                            <input type="date" value="{{request()->task_date}}" name="task_date"
                                class="form-control form-control-sm" id="inputPassword2" placeholder="">
                        </div>
                        <div class="form-group mb-2 mx-sm-2">
                            <select id="inputState" name="priority" class="form-control form-control-sm">
                                <option value="">Select Priority</option>
                                <option value="1" {{request()->priority == 1? 'selected' : ''}}>high</option>
                                <option value="2" {{request()->priority == 2? 'selected' : ''}}>Mid</option>
                                <option value="3" {{request()->priority == 3? 'selected' : ''}}>Low</option>
                            </select>
                        </div>
                        <div class="form-group mb-2 mx-sm-2">
                            <select id="inputState" name="user" class="form-control form-control-sm">
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                <option value="{{$user->id}}" {{$user->id == request()->user? 'selected' : ''}}>
                                    {{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2 mx-sm-2">
                            <input type="text" name="datefilter" placeholder="Select Range"
                                class="form-control form-control-sm" value="{{request()->datefilter}}"
                                autocomplete="off" />
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary mb-2  mx-sm-2">Search</button>
                        <a href="{{route(Route::currentRouteName())}}">
                            <button type="button" class="btn btn-sm btn-danger mb-2 mx-sm-2">Reset</button>
                        </a>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    @if(count($tasks))
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">{{$heading}}</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th style="width: 150px;">Task</th>
                                        <th>Assign To</th>
                                        <th style="width: 200px;">Description</th>
                                        <th>Task Date</th>
                                        <th>Priority</th>
                                        <th>Duration</th>
                                        <th>Status</th>
                                        <th style="">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = $tasks->perPage() * ($tasks->currentPage() - 1) + 1;
                                    @endphp
                                    @foreach($tasks as $task)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$task->title}}</td>
                                        <td>
                                            {{$task->user->name}}
                                        </td>
                                        <td>
                                            {{ $task->description }}
                                        </td>
                                        <td>
                                            {{date('d-M-Y', strtotime($task->task_date))}}
                                        </td>
                                        <td>
                                            {{$task->priority}}
                                        </td>
                                        <td>
                                            {{$task->duration}} Days
                                        </td>
                                        <td>
                                            <div
                                                class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input type="checkbox" data-url="{{ route('task.status', $task->id) }}"
                                                    {{($task->status == 1)? 'checked' : ''}}
                                                    class="update-status custom-control-input"
                                                    id="customSwitch{{$task->id}}">
                                                <label class="custom-control-label"
                                                    for="customSwitch{{$task->id}}"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <form action="{{route('task.delete', $task->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="delete" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this task ?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{$tasks->appends(request()->all())->links()}}
                    @else
                    <div class="text-center">Sorry! No Task Found</div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('additional_scripts')
<script>
    $(document).ready(function () {
    $(".update-status").change(function () {
        // alert('status');
        var url = $(this).data("url");
        var _token = $('input[name="_token"]').val();
        $.post(
            url,
            {
                _token: _token,
            },
            function (response) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                });
                Toast.fire({
                    icon: response.type,
                    title: response.message,
                });
            }
        );
    });

    $(function() {

            $('input[name="datefilter"]').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
            });

            $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

    });
});
</script>
@endsection