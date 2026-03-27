<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomReservation;
use App\Models\CompanyRoom;

class RoomController extends Controller
{
    use \App\Traits\ReservationTrait;

    public function index()
    {
        $today        = now()->toDateString();
        $rooms        = \Cache::remember('rooms_all', 3600, fn() => CompanyRoom::all());
        $allRes       = RoomReservation::with('user')->orderBy('date','desc')->orderBy('hour')->limit(50)->get();
        $myRes        = RoomReservation::with('user')->where('user_id', session('user_id'))->orderBy('date','desc')->get();
        $todayRes     = RoomReservation::where('date', $today)->get();
        return view('rooms.index', compact('rooms','allRes','myRes','todayRes'));
    }

    public function create()
    {
        $rooms = CompanyRoom::all();
        return view('rooms.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room'     => 'required',
            'date'     => 'required|date|after_or_equal:today',
            'hour'     => 'required',
            'duration' => 'required|integer|min:1|max:8',
            'reason'   => 'required|max:255',
        ], [
            'date.after_or_equal' => 'La fecha no puede ser anterior a hoy.',
            'room.required'       => 'Selecciona una sala.',
            'reason.required'     => 'Indica el motivo de la reserva.',
        ]);

\DB::transaction(function () use ($request) {
            RoomReservation::create([
                'user_id'  => session('user_id'),
                'room'     => $request->room,
                'date'     => $request->date,
                'hour'     => $request->hour,
                'duration' => $request->duration,
                'reason'   => $request->reason,
                'status'   => 'pendiente',
            ]);
        });

        \Cache::forget('rooms_all');

        return redirect()->route('rooms.index')->with('success', 'Reserva solicitada correctamente. Pendiente de confirmación.');
    }

    public function destroy($id)
    {
        return $this->commonDestroy($id, RoomReservation::class, 'rooms.index', 'Reserva cancelada.');
    }

    public function approve($id)
    {
        return $this->commonApprove($id, RoomReservation::class, 'confirmada', 'Reserva confirmada.');
    }
}
