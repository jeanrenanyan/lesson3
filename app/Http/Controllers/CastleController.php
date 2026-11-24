<?php

namespace App\Http\Controllers;

use App\Models\Castle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class CastleController extends Controller
{
    protected $messages = [
        'required' => 'Поле :attribute обязательно для заполнения.',
        'string' => 'Поле :attribute должно быть строкой.',
        'min' => [
            'string' => 'Поле :attribute должно быть не меньше :min символов.',
        ],
        'max' => [
            'string' => 'Поле :attribute должно быть не больше :max символов.',
            'file' => 'Файл :attribute не должен превышать :max Кб.',
        ],
        'image' => 'Файл :attribute должен быть изображением.',
        'mimes' => 'Поле :attribute должно быть файлом одного из следующих типов: :values.',
    ];

    protected $rules = [
        'name' => 'required|string',
        'description' => 'required|string|min:10|max:200',
        'type' => 'required|string',
        'full_description' => 'required|string|min:10|max:500',
        'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
    ];

    protected $attributes = [
        'name' => 'Название',
        'description' => 'Краткое описание',
        'type' => 'Тип',
        'full_description' => 'Полное описание',
        'image' => 'Изображение',
    ];

    public function index()
    {
        $castles = Castle::with('user')->get();

        return view('castle.index', compact('castles'));
    }

    public function users()
    {
        $users = User::orderBy('username')->get();
        $friendIds = auth()->check()
            ? auth()->user()->friends()->pluck('users.id')->all()
            : [];

        return view('users.index', compact('users', 'friendIds'));
    }

    public function userIndex(User $user)
    {
        $castles = $user->castles()->with('user')->get();
        $isFriend = auth()->check()
            && auth()->user()->friends()->whereKey($user->id)->exists();

        return view('castle.user-index', compact('castles', 'user', 'isFriend'));
    }

    public function userCastlesIncludingDeleted(User $user)
    {
        $castles = $user->castles()->withTrashed()->with('user')->get();

        return view('castle.admin-user-index', compact('castles', 'user'));
    }

    public function create()
    {
        return view('castle.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->messages, $this->attributes);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();
        $data['image'] = $data['image']->store('', 'public');

        $request->user()->castles()->create($data);

        return redirect()->route('castles.index');
    }

    public function show(Castle $castle)
    {
        $castle->load('user');
        $comments = $castle->comments()->with('user')->latest()->get();
        $friendIds = auth()->check()
            ? auth()->user()->friends()->pluck('users.id')->all()
            : [];

        return view('castle.show', compact('castle', 'comments', 'friendIds'));
    }

    public function edit(Castle $castle)
    {
        return view('castle.edit', compact('castle'));
    }

    public function update(Request $request, Castle $castle)
    {
        $rules = $this->rules;
        $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048';

        $validator = Validator::make($request->all(), $rules, $this->messages, $this->attributes);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        if (isset($data['image'])) {
            $data['image'] = $data['image']->store('', 'public');
        } else {
            unset($data['image']);
        }

        $castle->update($data);

        return redirect()->route('castles.show', $castle);
    }

    public function destroy(Castle $castle)
    {
        Gate::authorize('delete-castle', $castle);
        $castle->delete();

        return redirect()->route('castles.index');
    }

    public function restore($castleId)
    {
        $castle = Castle::withTrashed()->findOrFail($castleId);
        Gate::authorize('restore-castle', $castle);
        $castle->restore();

        return redirect()->route('admin.users.castles', $castle->user->username);
    }

    public function forceDelete($castleId)
    {
        $castle = Castle::withTrashed()->findOrFail($castleId);
        Gate::authorize('force-delete-castle', $castle);
        $username = $castle->user->username;
        $castle->forceDelete();

        return redirect()->route('admin.users.castles', $username);
    }
}
