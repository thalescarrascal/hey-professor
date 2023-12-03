<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\RedirectResponse;

class QuestionController extends Controller
{
    public function store(): RedirectResponse
    {
        $attributes = request()->validate([
            'question' => ['required', 'min:10'],
        ]);

        Question::query()->create($attributes);

        return redirect()->route('dashboard');
    }
}
