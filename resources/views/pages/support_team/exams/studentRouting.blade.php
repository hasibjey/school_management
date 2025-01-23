@extends('layouts.master')
@section('page_title', 'Exam routing Manage')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Manage Users</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table datatable-button-html5-columns">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Subject</th>
                                        <th>Exam Date</th>
                                        <th>Exam Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $u)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $u->Subject->name }}</td>
                                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $u->exam_date)->format('d-m-Y') }}
                                            </td>
                                            <td>{{ Carbon\Carbon::createFromFormat('H:i:s', $u->exam_time)->format('h:i A') }}
                                            </td>
                                            <td class="text-center">
                                                <div class="list-icons">
                                                    <div class="dropdown">
                                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                            <i class="icon-menu9"></i>
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-left">
                                                            {{-- Delete --}}
                                                            <a href="{{ route('admin.exams.routing.delete', ['did' => $u->id]) }}"
                                                                onclick="confirmDelete(this.id)"
                                                                class="dropdown-item">
                                                                <i class="icon-trash"></i> Delete
                                                            </a>

                                                            {{-- Edit --}}
                                                            <a href="?eid={{ $u->id }}" class="dropdown-item"><i
                                                                    class="icon-pencil"></i>
                                                                Edit</a>
                                                        </div>
                                                    </div>
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
