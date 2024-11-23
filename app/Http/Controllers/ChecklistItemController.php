<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Checklist;
use App\Models\ChecklistItem;
use Illuminate\Http\Request;

class ChecklistItemController extends Controller
{
    public function store(Request $request, Checklist $checklist)
    {
        $request->validate([
            'description' => 'required|string|max:255',
        ]);

        $checklist->items()->create([
            'description' => $request->description,
        ]);

        return redirect()->route('checklists.index')->with('success', 'Пункт успешно добавлен!');
    }

    public function update(Request $request, Checklist $checklist, ChecklistItem $item)
    {
        $item->update([
            'is_completed' => $request->has('is_completed'),
        ]);

        return redirect()->route('checklists.index')->with('success', 'Статус задачи успешно обновлен!');
    }
}
