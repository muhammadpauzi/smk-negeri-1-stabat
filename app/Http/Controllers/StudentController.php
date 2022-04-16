<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::query();
        $searchKeyword = request('search');

        if ($searchKeyword) {
            $students = $students
                ->where('name', 'LIKE',  "%$searchKeyword%")
                ->orWhere('nisn', 'LIKE', "%$searchKeyword%")
                ->orWhere('religion', 'LIKE', "%$searchKeyword%")
                ->orWhere('place_of_birth', 'LIKE', "%$searchKeyword%")
                ->orWhere('date_of_birth', 'LIKE', "%$searchKeyword%")
                ->orWhere('gender', 'LIKE', "%$searchKeyword%")
                ->orWhere('rombongan_belajar', 'LIKE', "%$searchKeyword%");
        }

        return view('students.index', [
            "title" => "Students",
            "students" => $students->latest()->paginate(20)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rombongan_belajars = Student::query()->select('rombongan_belajar')->distinct()->get();
        $religions = Student::query()->select('religion')->distinct()->get();

        return view('students.create', [
            "title" => "Create New Student",
            "religions" => $religions,
            "rombongan_belajars" => $rombongan_belajars,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:256',
            'nisn' => 'required|string|size:10',
            'gender' => 'required|in:pria,wanita',
            'place_of_birth' => 'required|max:256',
            'date_of_birth' => 'required|date',
            'religion' => 'required|max:32',
            'address' => 'required|max:256',
            'rombongan_belajar' => 'required|max:32',
        ];

        $validatedData = $request->validate($rules);

        Student::create($validatedData);

        return redirect()->route("students.index")->with('success', 'New student has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
