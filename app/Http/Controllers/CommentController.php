<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\MediaItem;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function storePostComment(Request $request, Post $post)
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

    public function storeMediaComment(Request $request, MediaItem $mediaItem)
{
    $request->validate(['content' => 'required|string|max:1000']);

    $mediaItem->comments()->create([
        'content' => $request->content,
        'user_id' => auth()->id(),
    ]);

    return redirect()->back()->with('success', 'Комментарий добавлен к медиа!');
}
}
