<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Teacher $teacher)
    {
        // Verificar si el usuario ya dejó una reseña para este profesor
        $existingReview = Review::where('teacher_id', $teacher->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'Ya has dejado una reseña para este profesor.');
        }

        $validated = $request->validate([
            'quality' => 'required|integer|min:1|max:5',
            'difficulty' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|min:10',
            'course_id' => 'nullable|exists:courses,id',
            'would_take_again' => 'nullable|boolean',
        ]);

        $validated['user_id'] = auth()->id();
        
        $teacher->reviews()->create($validated);

        return redirect()->route('teachers.show', $teacher)->with('success', '¡Reseña añadida con éxito!');
    }
}
