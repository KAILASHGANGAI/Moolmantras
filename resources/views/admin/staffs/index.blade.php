@extends('../layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Staffs</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Staffs</a></li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Full Name</th>
                                        <th>Contact No</th>
                                        <th>Provision</th>
                                        <th>District</th>
                                        <th>Gaupalika</th>
                                        <th>Status</th>
                                        <th>Ward No</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($staffs as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->name }} </td>
                                            <td>{{ $item->phone }}</td>
                                            <td> {{ $item->provision->provision_name }}</td>
                                            <td>{{ $item->district->districts_name }}</td>
                                            <td>{{ $item->gaupalika->gaupalika_name }}</td>
                                            <td>
                                                @if ($item->status == 1)
                                                    {{ 'Active' }}
                                                @else
                                                    {{ 'Inactive' }}
                                                @endif
                                            </td>
                                            <td>{{ $item->ward_no }}</td>
                                            <td>
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('staff.show', $item->id) }}">
                                                    <i class="fas fa-folder">
                                                    </i>
                                                    View
                                                </a>
                                                <a class="btn btn-info btn-sm" href="{{ route('staff.edit', $item->id) }}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Edit
                                                </a>
                                                <form id="delete-form-{{ $item->id }}"
                                                    action="{{ route('staff.destroy', $item->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

                                                <a class="btn btn-danger btn-sm" href="#"
                                                    onclick="event.preventDefault(); document.getElementById('delete-form-{{ $item->id }}').submit();">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach




                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Full Name</th>
                                        <th>Contact No</th>
                                        <th>Provision</th>
                                        <th>District</th>
                                        <th>Gaupalika</th>
                                        <th>Status</th>
                                        <th>Ward No</th>
                                        <th>Action</th>

                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
