<?php

namespace App\Http\Controllers;

use App\Models\Artical;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ArticalController extends Controller
{
    // Controller methods will go here
    public function index()
    {
        // Code to list all articals
        $articales = Artical::latest()->paginate(5);
        return view('articals.index', compact('articales'));
    }

    public function create()
    {
        return view('articals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            // 'user_id' => 'required|exists:users,id',
            'slug' => 'required|unique:articals,slug',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $artical = new Artical($request->all());

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $artical->image_path = $path;
        }

        $artical->save();

        return redirect()->route('articals.index')
                         ->with('success', 'Artical created successfully.');
    }

    public function show(Artical $artical)
    {
        return view('articals.show', compact('artical'));
    }

    public function edit(Artical $artical)
    {
        return view('articals.edit', compact('artical'));
    }

    public function update(Request $request, Artical $artical)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            // 'user_id' => 'required|exists:users,id',
            'slug' => 'required|unique:articals,slug,' . $artical->id,
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $artical->fill($request->all());

        if ($request->hasFile('image_path')) {
            $path = $request->file('image_path')->store('images', 'public');
            $artical->image_path = $path;
        }

        $artical->save();

        return redirect()->route('articals.index')
                         ->with('success', 'Artical updated successfully.');
    }

//    use Illuminate\Support\Facades\Storage;

public function destroy(Artical $artical)
{
    // Delete image if exists
    if ($artical->image_path && Storage::exists('public/' . $artical->image_path)) {
        Storage::delete('public/' . $artical->image_path);
    }

    // Delete article record
    $artical->delete();

    return redirect()->route('articals.index')
                     ->with('success', 'Artical deleted successfully.');
}

}
