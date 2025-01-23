@extends('layouts.master')
@section('page_title', 'Class routing Manage')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Class Routing</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table datatable-button-html5-columns table-bordered table-striped">
                                <tbody>
                                    @foreach ($items as $key => $u)
                                        <tr>
                                            <td>{{ $key }}</td>
                                            @foreach ($u as $item)
                                                <td class="text-center">
                                                    <p>{{ $item->Subject->name }}</p>
                                                    <p>{{ Carbon\Carbon::createFromFormat('H:i:s', $item->class_time)->format('h:i A') }}</p>
                                                </td>
                                            @endforeach
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
