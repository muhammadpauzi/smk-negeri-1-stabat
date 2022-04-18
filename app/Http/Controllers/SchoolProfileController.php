<?php

namespace App\Http\Controllers;

use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SchoolProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schoolProfile = SchoolProfile::all()->first();

        return view('school-profiles.index', [
            "title" => "School Profile",
            "profile" => $schoolProfile
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $schoolProfile = SchoolProfile::all()->first();

        return view('school-profiles.edit', [
            "title" => "Edit School Profile",
            "profile" => $schoolProfile
        ]);
    }

    public function update(Request $request)
    {
        $schoolProfile = SchoolProfile::all()->first();
        $this->authorize('update', $schoolProfile);

        $rules = [
            'name' => 'required|max:256',
            'address'   => 'required|max:256',
            'postal_number'   => 'required|max:8',
            'phone_number'   => 'required|max:256',
            'kepala_sekolah'   => 'required|max:256',
            'email'   => 'required|email|max:256',
            'kata_sambutan'   => 'required|max:1024',
            'logo' => 'image|file|max:1024',
            'kepala_sekolah_image' => 'image|file|max:1024',
        ];


        $validatedData = $request->validate($rules);

        $validatedData['kata_sambutan'] = collect(explode('\n', $validatedData['kata_sambutan']))
            ->filter(fn ($parag) => $parag !== "")
            ->map(fn ($parag) => "<p>" .  trim($parag) . "</p>")
            ->implode('');

        if ($request->file('kepala_sekolah_image')) {
            if ($request->post('old-kepala-sekolah-image') && !strpos($schoolProfile->kepala_sekolah_image, "default")) Storage::delete($request->post('old-kepala-sekolah-image'));
            $validatedData['kepala_sekolah_image'] = $request->file('kepala_sekolah_image')->store('school-profile-images');
        }

        if ($request->file('logo')) {
            if ($request->post('old-logo') && !strpos($schoolProfile->logo, "default")) Storage::delete($request->post('old-logo'));
            $validatedData['logo'] = $request->file('logo')->store('school-profile-images');
        }

        $schoolProfile->update($validatedData);

        return redirect()->route('school-profile.index')->with('success', 'School Profile has been updated.');
    }
}
