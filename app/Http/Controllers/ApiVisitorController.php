<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\VisitorStat;

class ApiVisitorController extends Controller
{
    // Menampilkan daftar pengunjung dengan filter (JSON)
    public function indexView(Request $request)
    {
        $search = $request->input('search');
        $visitors = Visitor::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                         ->orWhere('age', 'like', '%' . $search . '%')
                         ->orWhere('gender', 'like', '%' . $search . '%')
                         ->orWhere('origin', 'like', '%' . $search . '%')
                         ->orWhere('visit_date', 'like', '%' . $search . '%')
                         ->orWhere('notes', 'like', '%' . $search . '%');
        })->get();

        return response()->json($visitors, 200);
    }

    // Mengambil semua data pengunjung (JSON)
    public function index()
    {
        $visitors = Visitor::all();
        return response()->json($visitors, 200);
    }

    // Mengambil statistik pengunjung (JSON)
    public function visitorStat()
    {
        $visitorStat = VisitorStat::all();
        return response()->json($visitorStat, 200);
    }

    // Statistik pengunjung harian (JSON)
    public function getDailyStats()
    {
        $stats = VisitorStat::selectRaw('DATE_FORMAT(date, "%W") as day_name, visitor_count')
            ->orderBy('date', 'asc')
            ->get();

        return response()->json($stats, 200);
    }

    // Menyimpan pengunjung baru (JSON)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'gender' => 'required|in:Male,Female',
            'origin' => 'required|string|max:255',
            'visit_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $visitor = Visitor::create($validated);

        // Update statistik pengunjung
        $this->updateVisitorStats($visitor->visit_date);

        return response()->json([
            'message' => 'Pengunjung berhasil ditambahkan.',
            'data' => $visitor
        ], 201);
    }

    // Mengupdate data pengunjung (JSON)
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'gender' => 'required|in:Male,Female',
            'origin' => 'required|string|max:255',
            'visit_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $visitor = Visitor::find($id);

        if (!$visitor) {
            return response()->json([
                'message' => 'Data Pengunjung tidak ditemukan.'
            ], 404);
        }

        $visitor->update($validated);

        // Update statistik pengunjung
        $this->updateVisitorStats($visitor->visit_date);

        return response()->json([
            'message' => 'Data Pengunjung berhasil diperbarui.',
            'data' => $visitor
        ], 200);
    }

    // Menghapus data pengunjung (JSON)
    public function destroy($id)
    {
        $visitor = Visitor::find($id);

        if (!$visitor) {
            return response()->json([
                'message' => 'Data Pengunjung tidak ditemukan.'
            ], 404);
        }

        $visitor->delete();

        // Update statistik pengunjung
        $this->updateVisitorStats($visitor->visit_date);

        return response()->json([
            'message' => 'Data Pengunjung berhasil dihapus.'
        ], 200);
    }
    
}
