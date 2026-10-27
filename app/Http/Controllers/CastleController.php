<?php

namespace App\Http\Controllers;

use App\Models\Castle;
use Validator;


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
        $castles = Castle::all();

        return view('castle.index', compact("castles"));
    }
    public function create()
    {
        return view('castle.create');
    }
    public function store()
    {

        $validator = Validator::make(request()->all(), $this->rules, $this->messages, $this->attributes);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        $imageFile = $data['image'];

        $path = $imageFile->store('', 'public');

        $data["image"] = $path;

        Castle::create($data);

        return redirect('/castles');
    }

    public function show(Castle $castle)
    {
        return view('castle.show', compact('castle'));
    }

    public function edit(Castle $castle)
    {
        return view('castle.edit', compact('castle'));
    }

    public function update(Castle $castle)
    {
        $rules = $this->rules;
        $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048';

        $validator = Validator::make(request()->all(), $rules, $this->messages, $this->attributes);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        if (isset($data['image'])) {
            $data['image'] = $data['image']->store('', 'public');
        }

        $castle->update($data);

        return redirect('/castles');
    }

     public function destroy(Castle $castle)
    {
        $castle->delete();

        return redirect('/castles');
    }

}
