@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="panel-body pt-5">
            <h1>New Subject</h1>
            <!-- Display Validation Errors -->
            @include('common.errors')

            <form action="/subject" method="POST" class="form-horizontal">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="subject" class="col-sm-3 control-label">Subject</label>

                    <div class="col-sm-6">
                        <input type="text" name="subject" id="subject" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Add Subject
                        </button>
                    </div>
                </div>
            </form>
        </div>

        @if (count($subject) > 0)

            <div class="panel-body pt-5">
                <h1>Current Subjects</h1>
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Subject</th>
                    </thead>

                    <tbody>
                        @foreach ($subject as $subject_item)
                            <tr>
                                <td class="table-text">
                                    <div>{{ $subject_item->subject }}</div>
                                </td>
                                <td>
                                    <form action="/subject/{{ $subject_item->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

@endsection
