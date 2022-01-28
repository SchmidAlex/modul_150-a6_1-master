<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});


/**
 * Display All Tasks
 */
Route::get('/homework', function () {
    $homework = \App\Homework::orderBy('created_at', 'asc')->get();
    $subject = \App\Subject::orderBy('created_at', 'asc')->get();
    return view('homework', [
        'homework' => $homework,
        'subject' => $subject,
    ]);
});
/**
 * Add A New Task
 */
Route::post('/homework', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'task' => 'required|max:255',
        'subject' => 'required',
        'due' => 'nullable|date'
    ]);

    if ($validator->fails()) {
        return redirect('/homework')
            ->withInput()
            ->withErrors($validator);
    }

    $homework = new \App\Homework;
    $homework->subject = $request->subject;
    $homework->task = $request->task;
    $homework->due = $request->due;
    $homework->save();

    return redirect('/homework');
});

/**
 * Delete An Existing Task
 */
Route::delete('/homework/{id}', function ($id) {
    \App\Homework::findOrFail($id)->delete();

    return redirect('/homework');
});

/**
 * Hello World
 */
Route::get('/hello', function () {
    return view('hello');
});

Route::get('/subject', function () {
    $subject = \App\Subject::orderBy('created_at', 'asc')->get();

    return view('subject', [
        'subject' => $subject,
    ]);
});

Route::post('/subject', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'subject' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/subject')
            ->withInput()
            ->withErrors($validator);
    }

    $subject = new \App\Subject;
    $subject->subject = $request->subject;
    $subject->save();

    return redirect('/subject');
});

Route::delete('/subject/{id}', function ($id) {
    \App\Subject::findOrFail($id)->delete();

    return redirect('/subject');
});

