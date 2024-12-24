<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Visitor;
use App\Models\VisitorStat;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    // Menampilkan halaman dan filter daftar pengunjung
    public function indexView(Request $request)
    {
        // Ambil query pencarian
        $search = $request->input('search');
        // Filter data berdasarkan query pencarian
        $visitors = Visitor::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                         ->orWhere('age', 'like', '%' . $search . '%')
                         ->orWhere('gender', 'like', '%' . $search . '%')
                         ->orWhere('origin', 'like', '%' . $search . '%')
                         ->orWhere('visit_date', 'like', '%' . $search . '%')
                         ->orWhere('notes', 'like', '%' . $search . '%');
        })->get();

        return view('visitors.index', compact('visitors'));
    }  

    // Mengambil semua data pengunjung (API)
    public function index()
    {
        return response()->json(Visitor::all());
    }

    public function visitorStat()
    {
        $visitorStat = VisitorStat::get();
        return view('visitors.statistik', compact('visitorStat'));
    }
    
    public function getDailyStats()
    {
        $stats = VisitorStat::selectRaw('DATE_FORMAT(date, "%W") as day_name, visitor_count')
        ->orderBy('date', 'asc')
        ->get();

    return response()->json($stats);
    }
    
    // Halaman tambah visitor
    public function create()
    {
        return view('visitors.create');
    }

    // Menyimpan pengunjung baru (API)
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
        
        return redirect()->route('visitors.index')->with('success', 'Pengunjung berhasil ditambahkan.'); // Status 201: Created
    }

    // Mengupdate data pengunjung (API)
    public function edit($id)
    {
        $visitor = Visitor::find($id);
        return view('visitors.edit', compact('visitor'));
    }

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
            return redirect()->route('visitors.index')->with('error', 'Data Pengunjung tidak ditemukan.');
        }

        $visitor->update($validated);

        // Update statistik pengunjung setelah pengunjung diupdate
        $this->updateVisitorStats($visitor->visit_date);
        return redirect()->route('visitors.index');
    }

    // Menghapus data pengunjung (API)
    public function destroy($id)
    {
        $visitor = Visitor::find($id);

        if (!$visitor) {
            return redirect()->route('visitors.index')->with('error', 'Data Pengunjung tidak ditemukan.');
        }

        $visitor->delete();

        // Update statistik pengunjung setelah pengunjung dihapus
        $this->updateVisitorStats($visitor->visit_date);

        return redirect()->route('visitors.index');
    }

    // Fungsi untuk mengupdate statistik pengunjung berdasarkan tanggal kunjungan
    private function updateVisitorStats($visitDate)
    {
        $date = \Carbon\Carbon::parse($visitDate)->format('Y-m-d');

        $stats = VisitorStat::firstOrCreate(['date' => $date]);

        $visitorCount = Visitor::whereDate('visit_date', $date)->count();

        $stats->update(['visitor_count' => $visitorCount]);
    }
}
