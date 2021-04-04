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
                        <li class="breadcrumb-item active">Users</a></li>
                    </ol>
                </div>
                <div class="col-sm-6">

                </div>

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if(count($users))
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Users</h3>
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
                                        <th style="width: 150px;">Name</th>
                                        <th>Email</th>
                                        <th style="width: 200px;">Tasks Assigned</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = $users->perPage() * ($users->currentPage() - 1) + 1;
                                    @endphp
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>
                                            {{$user->email}}
                                        </td>
                                        <td>
                                            <a href="{{route('tasks.index', $user->id)}}">
                                                {{$user->tasks->count()}}
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{$users->links()}}
                    @else
                    <div class="text-center">Sorry! No User Found</div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection