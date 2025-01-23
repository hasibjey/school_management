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
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <table class="table datatable-button-html5-columns">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Semester</th>
                                        <th>Class</th>
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
                                            <td>{{ $u->semester }}</td>
                                            <td>{{ $u->MyClass->name }}</td>
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
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h6 class="card-title">Add Exam Routing</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data" action="{{ empty($update)? route('admin.exams.routing.store') : route('admin.exams.routing.update') }}"
                                data-fouc>
                                @csrf
                                <input type="text" name="id" value="{{ $update->id ?? null }}" hidden>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="section">Semester: <span class="text-danger">*</span></label>
                                            <select data-placeholder="Select Section" class="form-control select"
                                                name="semester" id="semester">
                                                <option
                                                    {{ !empty($update) && $update->semester == 'first_tram' ? 'selected' : null }}
                                                    value="first_tram">First term</option>
                                                <option
                                                    {{ !empty($update) && $update->semester == 'secund_term' ? 'selected' : null }}
                                                    value="secund_term">Secund term</option>
                                                <option
                                                    {{ !empty($update) && $update->semester == 'third_term' ? 'selected' : null }}
                                                    value="third_term">Third term</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="user_type">Class: <span class="text-danger">*</span></label>
                                            <select onchange="getSubject(this.value)" data-placeholder="Select User"
                                                class="form-control select" name="class_id" id="class_id">
                                                <option value="">Select Class</option>
                                                @foreach ($myClass as $mc)
                                                    <option
                                                        {{ !empty($update) && $update->class_id == $mc->id ? 'selected' : null }}
                                                        value="{{ $mc->id }}">{{ $mc->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="subject_id">Subject: <span class="text-danger">*</span></label>
                                            <select data-placeholder="Select Class First" class="select-search form-control"
                                                name="subject_id" id="subject_id">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="my_class_id">Exam Date: <span class="text-danger">*</span></label>
                                            <input name="exam_date"
                                                value="{{ !empty($update)? \Carbon\Carbon::createFromFormat('Y-m-d', $update->exam_date)->format('m/d/Y') : old('exam_date') }}"
                                                type="text" class="form-control date-pick" placeholder="Select Date...">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="my_class_id">Exam time: <span class="text-danger">*</span></label>
                                            <input name="exam_time" value="{{ $update->exam_time ?? old('exam_time') }}"
                                                type="time" class="form-control" placeholder="Select Date...">
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <div class="form-group">
                                            <a href="{{ route('admin.exams.routing.index') }}"
                                                class="btn btn-success btn-danger px-4 mr-1">Clear</a>
                                            <button class="btn btn-success px-4">{{ empty($update)? 'Submit' : 'Update' }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function getSubject(get_subject) {
            var url = '{{ route('get_subjects', [':id']) }}';
            url = url.replace(':id', get_subject);
            var subject = $('#subject_id');

            $.ajax({
                dataType: 'json',
                url: url,
                success: function(resp) {
                    const subjects = resp['subjects'];
                    subject.empty();
                    let option = null;
                    $.each(subjects, function(i, data, index) {
                        subject.append($('<option>', {
                            value: data.id,
                            text: data.name
                        }));
                    });

                }
            })
        }

        @if (!empty($update))
            getSubject($('#class_id').val());
        @endif
    </script>

@endsection
