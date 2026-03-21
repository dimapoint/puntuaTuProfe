<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CareerController extends Controller
{
    /**
     * Display the career selection view.
     */
    public function create(): View
    {
        $careers = Career::orderBy('name')->get();

        return view('auth.select-career', compact('careers'));
    }

    /**
     * Store the user's career selection.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'career_id' => 'nullable|exists:careers,id',
            'new_career' => 'nullable|string|max:255|unique:careers,name',
        ]);

        if ($request->new_career) {
            $career = Career::create(['name' => $request->new_career]);
            $careerId = $career->id;
        } else {
            $request->validate(['career_id' => 'required']);
            $careerId = $request->career_id;
        }

        $user = Auth::user();
        $user->career_id = $careerId;
        $user->save();

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
