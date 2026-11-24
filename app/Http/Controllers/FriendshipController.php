<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FriendshipController extends Controller
{
    public function store(Request $request, User $user)
    {
        $currentUser = $request->user();
        abort_if($currentUser->is($user), 422, 'Нельзя добавить себя в друзья.');

        DB::transaction(function () use ($currentUser, $user) {
            $currentUser->friends()->syncWithoutDetaching([$user->id]);
            $user->friends()->syncWithoutDetaching([$currentUser->id]);
        });

        return back()->with('status', 'Пользователь добавлен в друзья.');
    }

    public function destroy(Request $request, User $user)
    {
        $currentUser = $request->user();
        abort_if($currentUser->is($user), 422, 'Нельзя удалить себя из друзей.');

        DB::transaction(function () use ($currentUser, $user) {
            $currentUser->friends()->detach($user->id);
            $user->friends()->detach($currentUser->id);
        });

        return back()->with('status', 'Пользователь удалён из друзей.');
    }
}
