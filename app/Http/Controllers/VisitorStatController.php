<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorStat;

class VisitorStatController extends Controller
{
    public function index()
    {
        return response()->json(VisitorStat::all());
    }

    public function show($id)
    {
        $stat = VisitorStat::find($id);
        if ($stat) {
            return response()->json($stat);
        }
        return response()->json(['message' => 'Stat not found'], 404);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date|unique:visitor_stats,date',
            'visitor_count' => 'required|integer|min:0',
        ]);

        $stat = VisitorStat::create($validated);
        return response()->json($stat, 201);
    }

    public function update(Request $request, $id)
    {
        $stat = VisitorStat::find($id);
        if (!$stat) {
            return response()->json(['message' => 'Stat not found'], 404);
        }

        $validated = $request->validate([
            'date' => 'sometimes|required|date|unique:visitor_stats,date,' . $id,
            'visitor_count' => 'sometimes|required|integer|min:0',
        ]);

        $stat->update($validated);
        return response()->json($stat);
    }

    public function destroy($id)
    {
        $stat = VisitorStat::find($id);
        if (!$stat) {
            return response()->json(['message' => 'Stat not found'], 404);
        }

        $stat->delete();
        return response()->json(['message' => 'Stat deleted successfully']);
    }
}

