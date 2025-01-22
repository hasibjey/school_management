@extends('layouts.master')
@section('page_title', 'My Children')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">My Children</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <table class="table datatable-button-html5-columns">
                <thead>
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>ADM_No</th>
                    <th>Section</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ $student->photo }}" alt="photo"></td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->Student->adm_no }}</td>
                        <td>{{ $student->Student->my_class->name.' '.$student->Student->section->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-left">
                                        <a target="_blank" href="{{ route('marks.year_selector', Qs::hash($student->Student->User->id)) }}" class="dropdown-item"><i class="icon-check"></i> Marksheet</a>

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>

    {{--Student List Ends--}}

@endsection
