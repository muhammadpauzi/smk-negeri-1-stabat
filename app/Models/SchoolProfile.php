<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolProfile extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getKataSambutanWithNewLine(): string
    {
        $texts = [];
        foreach (explode('<p>', $this->kata_sambutan) as $text) {
            if ($text)
                $texts[] = $text;
        }
        return str_replace("</p>", "", join("\\n", $texts));
    }
}
