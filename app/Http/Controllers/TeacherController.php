<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @access SUPERADMIN
 */
class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::query();
        $searchKeyword = request('search');

        if ($searchKeyword) {
            $teachers = $teachers
                ->where('name', 'LIKE',  "%$searchKeyword%")
                ->orWhere('nuptk', 'LIKE', "%$searchKeyword%")
                ->orWhere('nip', 'LIKE', "%$searchKeyword%")
                ->orWhere('jenis_ptk', 'LIKE', "%$searchKeyword%")
                ->orWhere('address', 'LIKE', "%$searchKeyword%")
                ->orWhere('golongan', 'LIKE', "%$searchKeyword%")
                ->orWhere('tugas_tambahan', 'LIKE', "%$searchKeyword%");
        }

        return view('teachers.index', [
            "title" => "Teachers",
            "teachers" => $teachers->latest()->paginate(20)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis_ptks = Teacher::query()->select('jenis_ptk')->distinct()->get();
        $golongans = Teacher::query()->select('golongan')->distinct()->get();

        return view('teachers.create', [
            "title" => "Create New Teacher",
            "jenis_ptks" => $jenis_ptks,
            "golongans" => $golongans,
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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'nuptk' => 'required|string|size:16',
            'nip' => 'required|string|size:18',
            'jenis_ptk' => 'required',
            'tugas_tambahan' => 'required',
            'golongan' => 'required',
        ]);

        Teacher::create($validatedData);

        return redirect()->route("teachers.index")->with('success', 'New teacher has been created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        $jenis_ptks = Teacher::query()->select('jenis_ptk')->distinct()->get();
        $golongans = Teacher::query()->select('golongan')->distinct()->get();

        return view('teachers.edit', [
            "title" => "Edit Teacher",
            "jenis_ptks" => $jenis_ptks,
            "golongans" => $golongans,
            "teacher" => $teacher
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'nuptk' => 'required|string|size:16',
            'nip' => 'required|string|size:18',
            'jenis_ptk' => 'required',
            'tugas_tambahan' => 'required',
            'golongan' => 'required',
        ]);

        $teacher->update($validatedData);

        return redirect()->route('teachers.index')->with('success', 'Teacher has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'Teacher has been deleted.');
    }
}
