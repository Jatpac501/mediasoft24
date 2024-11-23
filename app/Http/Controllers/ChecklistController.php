<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checklists = Checklist::where('user_id', Auth::id())->get();
        return view('checklists.index', compact('checklists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('checklists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Checklist::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
        ]);

        return redirect()->route('checklists.index')->with('success', 'Чек-лист создан.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Checklist $checklist)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $checklist->update(['title' => $request->title]);

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $checklist = Checklist::where('user_id', Auth::id())->findOrFail($id);
        $checklist->delete();

        return redirect()->route('checklists.index')->with('success', 'Чек-лист удален.');
    }
}
