<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Teacher;
use Illuminate\Http\Request;

/**
 * @access SUPERADMIN
 */
class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $majors = Major::query()->with(['head']);
        $searchKeyword = request('search');

        if ($searchKeyword) {
            $majors = $majors
                ->where('name', 'LIKE',  "%$searchKeyword%")
                ->orWhere('description', 'LIKE', "%$searchKeyword%");
        }

        return view('majors.index', [
            "title" => "Majors",
            "majors" => $majors->latest()->paginate(20)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('majors.create', [
            "title" => "Create New Major",
            "heads" => Teacher::all()
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
            'name' => 'required|max:256',
            'head_of_major_id'   => 'required|numeric',
            'description'   => 'required|max:512',
            'body'   => 'required'
        ]);

        $name = $validatedData['name'];
        $validatedData['slug'] = $this->slug($name, Major::class);

        Major::create($validatedData);

        return redirect()->route("majors.index")->with('success', 'New major has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Major $major)
    {
        return view('majors.show', [
            "title" => "$major->name",
            "major" => $major,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Major $major)
    {
        return view('majors.edit', [
            "title" => "Edit Major",
            "heads" => Teacher::all(),
            "major" => $major
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Major $major)
    {
        $rules = [
            'name' => 'required|max:256',
            'head_of_major_id'   => 'required|numeric',
            'description'   => 'required|max:512',
            'body'   => 'required'
        ];

        $validatedData = $request->validate($rules);

        if ($request->post('old-name') !== $request->post('name')) {
            $name = $validatedData['name'];
            $validatedData['slug'] = $this->slug($name, Major::class);
        }

        $major->update($validatedData);

        return redirect()->route('majors.index')->with('success', 'Major has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Major $major)
    {
        $major->delete();
        return redirect()->route('majors.index')->with('success', 'Major has been deleted.');
    }
}
