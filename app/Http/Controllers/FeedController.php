<?php

namespace App\Http\Controllers;

use App\Models\Castle;
use App\Models\Comment;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $friends = $user->friends()->orderBy('name')->get();
        $friendIds = $friends->modelKeys();
        $feed = collect();

        if ($friendIds !== []) {
            $castles = Castle::with('user')
                ->whereIn('user_id', $friendIds)
                ->latest()
                ->get();

            foreach ($castles as $castle) {
                $feed->push([
                    'type' => 'castle',
                    'created_at' => $castle->created_at,
                    'castle' => $castle,
                ]);
            }

            $comments = Comment::with(['user', 'castle'])
                ->whereIn('user_id', $friendIds)
                ->whereHas('castle')
                ->latest()
                ->get();

            foreach ($comments as $comment) {
                $feed->push([
                    'type' => 'comment',
                    'created_at' => $comment->created_at,
                    'comment' => $comment,
                ]);
            }
        }

        $feed = $feed->sortByDesc('created_at')->values();

        return view('feed.index', compact('friends', 'feed'));
    }
}
