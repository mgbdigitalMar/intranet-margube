<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\News;
use App\Models\RoomReservation;
use App\Models\CarReservation;
use App\Models\PurchaseRequest;
use App\Models\Absence;
use App\Models\CompanyRoom;
use App\Models\CompanyCar;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'employees'  => User::count(),
            'news'       => News::count(),
            'rooms_res'  => RoomReservation::count(),
            'cars_res'   => CarReservation::count(),
            'purchases'  => PurchaseRequest::count(),
            'absences'   => Absence::count(),
        ];

        $pendingPurchases = PurchaseRequest::with('user')->where('status','pendiente')->orderBy('created_at','desc')->get();
        $pendingAbsences  = Absence::with('user')->where('status','pendiente')->orderBy('start_date')->get();
        $pendingRooms     = RoomReservation::with('user')->where('status','pendiente')->orderBy('date')->get();
        $pendingCars      = CarReservation::with('user')->where('status','pendiente')->orderBy('date')->get();
        $employees        = User::orderBy('name')->get();

        return view('admin.index', compact('stats','pendingPurchases','pendingAbsences','pendingRooms','pendingCars','employees'));
    }

    // ── Room config ─────────────────────────────────────────────────────────
    public function roomsConfig()
    {
        $rooms = CompanyRoom::all();
        return view('admin.rooms-config', compact('rooms'));
    }

    public function storeRoom(Request $request)
    {
        $request->validate([
            'name'     => 'required|max:255',
            'capacity' => 'required|integer|min:1',
        ]);
        CompanyRoom::create($request->only('name','capacity','description'));
        return redirect()->route('admin.rooms-config')->with('success', 'Sala añadida.');
    }

    public function destroyRoom($id)
    {
        CompanyRoom::findOrFail($id)->delete();
        return redirect()->route('admin.rooms-config')->with('success', 'Sala eliminada.');
    }

    // ── Car config ──────────────────────────────────────────────────────────
    public function carsConfig()
    {
        $cars = CompanyCar::all();
        return view('admin.cars-config', compact('cars'));
    }

    public function storeCar(Request $request)
    {
        $request->validate([
            'name'  => 'required|max:255',
            'plate' => 'required|max:20',
        ]);
        CompanyCar::create($request->only('name','plate','model'));
        return redirect()->route('admin.cars-config')->with('success', 'Vehículo añadido.');
    }

    public function destroyCar($id)
    {
        CompanyCar::findOrFail($id)->delete();
        return redirect()->route('admin.cars-config')->with('success', 'Vehículo eliminado.');
    }
}
