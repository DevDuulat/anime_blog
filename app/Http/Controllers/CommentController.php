<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'comment' => 'required|string|max:2000',
        ]);

        $comment = new Comment([
            'content' => $validated['comment'],
        ]);

        $post->comments()->create([
            'content' => $validated['comment'],
            // Если пользователь есть:
            'user_id' => auth()->id(), // или null
        ]);

        return redirect()->back()->with('success', 'Комментарий добавлен!');
    }
}
