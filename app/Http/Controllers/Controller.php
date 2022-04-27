<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Menu;
use App\Models\SchoolProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function slug(string $string, $model): string
    {
        $slug = Str::of($string)->slug()->value;
        while (true) {
            $data = $model::query()->where('slug', '=', $slug)->get();
            if ($data->isNotEmpty()) {
                $slug .= '-' . Str::lower(Str::random(5));
                continue;
            } else {
                break;
            }
        }
        return $slug;
    }

    public function majors()
    {
        return Major::all();
    }

    protected function view(string $view, $data)
    {
        $schoolProfile = SchoolProfile::all()->first();
        $data["schoolProfile"] = $schoolProfile;
        $data["menus"] = Menu::query()->with(['pages'])->get();
        $data["majors"] = $this->majors();
        return view($view, $data);
    }
}
