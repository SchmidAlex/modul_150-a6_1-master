@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="panel-body pt-5">
            <h1>New Homework</h1>
            <!-- Display Validation Errors -->
            @include('common.errors')

            <form action="/homework" method="POST" class="form-horizontal">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="homework-subject" class="col-sm-3 control-label">Subject</label>

                    <div class="col-sm-6">
                        <select name="subject" id="homework-subject" class="form-control">
                            <option value="Mathematik">Mathematik</option>
                            <option value="Mathematik">Deutsch</option>
                            <option value="Mathematik">Englisch</option>
                            <option value="Mathematik">Geschichte</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="homework-task" class="col-sm-3 control-label">Homework</label>

                    <div class="col-sm-6">
                        <input type="text" name="task" id="homework-task" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Add Homework
                        </button>
                    </div>
                </div>
            </form>
        </div>

        @if (count($homework) > 0)

            <div class="panel-body pt-5">
                <h1>Current Homework</h1>
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Homework</th>
                        <th>Subject</th>
                        <th>&nbsp;</th>
                    </thead>

                    <tbody>
                        @foreach ($homework as $homework_item)
                            <tr>
                                <td class="table-text">
                                    <div>{{ $homework_item->task }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $homework_item->subject }}</div>
                                </td>
                                <td class="table-text">
                                </td>

                                <td>
                                    <form action="/homework/{{ $homework_item->id }}" method="POST">
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
