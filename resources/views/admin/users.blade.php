@extends('admin.layouts.app')

@section('content')

<div class="m-content">

    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <table id="user_list" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>First name</th>
                            <th>Email</th>
                            <th>Total Que</th>
                            <th>Total Attemtpt Que</th>
                            <th>Total Correct Answer</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>First name</th>
                            <th>Email</th>
                            <th>Total Que</th>
                            <th>Total Attemtpt Que</th>
                            <th>Total Correct Answer</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#user_list').DataTable( {
                processing: true,
                serverSide: true,
                ajax: {
                    url : "{{ route('admin.user-list') }}",
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                },
                columns: [
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'total_questions' },
                    { data: 'total_questions_attend' },
                    { data: 'total_questions_ans' },

                ]
            } );
        } );
    </script>
@endpush