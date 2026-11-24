<?php

namespace App\Http\Controllers;

use App\Models\Castle;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Castle $castle)
    {
        $validated = $request->validate([
            'text' => ['required', 'string', 'max:2000'],
        ]);

        $request->user()->comments()->create([
            'castle_id' => $castle->id,
            'text' => $validated['text'],
        ]);

        return redirect()->route('castles.show', $castle)->with('status', 'Комментарий добавлен.');
    }
}
