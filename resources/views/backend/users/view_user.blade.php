@extends('backend.app')
@section('style-area')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">

@endsection
@section('content-area')

<div class="layout-px-spacing">

<div class="middle-content container-xxl p-0">

    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage Users</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->    
    <div class="row layout-spacing mt-5">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <table id="style-1" class="table style-1 dt-table-hover non-hover">
                        <thead>
                            <tr>
                                <th>Sr no</th>
                                <th>Profile</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Pan No</th>
                                <th>Adhar No</th>
                                <th>Address</th>
                                <th class="text-center dt-no-sorting">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($userlist as $data)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>
                                    <img src="{{asset('upload/profile/'.$data->profile)}}" height="100" width="100" alt="profile">
                                </td>
                                <td class="user-name">{{$data->name??''}}</td>
                                <td>{{$data->email??'No record'}}</td>
                                <td>{{$data->pan??'No record'}}</td>
                                <td>{{$data->adhar??'No record'}}</td>
                                <td>{{$data->address??'No record'}}</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                        </a>
                                        @php $bid=Crypt::encrypt($data->id); @endphp
                                        <div class="dropdown-menu mt-5 mb-5" aria-labelledby="dropdownMenuLink1">

                                            <a class="dropdown-item" href="{{ route('admin.user.edit', $bid) }}">Edit</a>
                                            <a class="dropdown-item" href="#"
                                                                onclick="event.preventDefault();document.getElementById('delete-form-{{ $bid }}').submit();">Delete</a>                                        </div>
                                                                <form id="delete-form-{{ $bid }}"
                                                        action="{{ route('admin.user.destroy', $bid) }}"
                                                        method="post" style="display: none;">
                                                        @method('DELETE')
                                                        @csrf
                                                    </form>
                                                            </div>
                                </td>
                            </tr>    
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

@endsection
@section('script-area')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<script>
        $(document).ready(function () {
            $('#style-1').DataTable();
        });
    </script>
@endsection





