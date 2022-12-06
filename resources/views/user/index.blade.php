@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="block">
            <div class="block-header">
            	<div class="row">
            		<div class="col-lg-6">
            			<h3 class="block-title">Employee <small>list</small></h3>
            		</div>
            		<div class="col-lg-6">
            			<a href="{{ route('user.create') }}" class="btn btn-success float-right">Add New</a>
            		</div>
            	</div>
            </div>
            <div class="block-content block-content-full">
                <table id="printTable" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%">#NO</th>
                            <th class="text-center" style="width: 100px;">
                                <i class="far fa-user"></i>
                            </th>
                            <th>Name</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Email</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Branch</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Salary</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Role</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Status</th>
                            <th class="d-none d-sm-table-cell" style="width: 5%;">Access</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach ($users as $key=>$user)
                    		<tr>
	                            <td class="text-center font-size-sm">{{ $key+1 }}</td>
	                            <td class="font-w600 font-size-sm">
                                    @if ($user->image)
	                                   <img src="{{ asset($user->image) }}" class="img-avatar img-avatar48">
                                    @else
                                        <img src="{{ asset('assets/media/avatars/avatar2.jpg') }}" class="img-avatar img-avatar48">
                                    @endif
	                            </td>
                                <td class="font-w600 font-size-sm">
                                    {{ $user->name }}
                                </td>
	                            <td class="d-none d-sm-table-cell font-size-sm">
	                                <em class="text-muted">{{ $user->email }}</em>
	                            </td>
	                            <td class="d-none d-sm-table-cell">
	                                <span class="badge badge-info">{{ $user->branch ? $user->branch->name : 'Not Found' }}</span>
	                            </td>
	                            <td>
	                                <em class="text-muted font-size-sm">{{ $user->salary ? $user->salary : 0.00 }}.Tk</em>
	                            </td>
                                <td>
                                    @if($user->role == 'admin')
                                        <span class="badge badge-success">Admin</span>
                                    @elseif($user->role == 'branch_manager')
                                        <span class="badge badge-dark">Branch Manager</span>
                                    @else
                                        <span class="badge badge-primary">Employee</span>
                                    @endif
                                </td>                        
                                <td>
                                    @if($user->status == 1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Block</span>
                                    @endif
                                </td>   
	                            <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('user.edit',$user) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </a>
                                        
                                        <a href="javascript:void(0)" onclick="confirm_modal('{{route('user.delete', $user->id)}}');" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete Item">
                                                <i class="fa fa-fw fa-trash-alt"></i></a>
                                        
                                    </div>
                                </td>
	                        </tr>
                    	@endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js') }}"></script>
    <script>

        $(document).ready(function() {
            $('#printTable').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy','pdf', 'print'
                ]
            } );
        } );

    </script>

@endsection

@section('css')
	<link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
@endsection