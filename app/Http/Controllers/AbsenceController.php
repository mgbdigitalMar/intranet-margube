<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absence;

class AbsenceController extends Controller
{
    use \App\Traits\ReservationTrait;

    private array $types = ['Vacaciones','Baja médica','Asunto personal','Formación externa','Visita médica','Otro'];

    public function index()
    {
        $isAdmin = session('user_role') === 'admin';
        $mine    = Absence::with('user')->where('user_id', session('user_id'))->orderBy('start_date','desc')->paginate(15);
        $all     = $isAdmin ? Absence::with('user')->orderBy('start_date','desc')->paginate(15) : collect();
        return view('absences.index', ['mine' => $mine, 'all' => $all, 'types' => $this->types]);
    }

    public function create()
    {
        return view('absences.create', ['types' => $this->types]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type'       => 'required',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ], [
            'start_date.required'       => 'La fecha de inicio es obligatoria.',
            'end_date.after_or_equal'   => 'La fecha de fin debe ser igual o posterior al inicio.',
        ]);

        Absence::create([
            'user_id'    => session('user_id'),
            'type'       => $request->type,
            'start_date' => $request->start_date,
            'end_date'   => $request->end_date,
            'reason'     => $request->reason,
            'status'     => 'pendiente',
        ]);

        return redirect()->route('absences.index')->with('success', 'Ausencia notificada. Pendiente de aprobación.');
    }

    public function destroy($id)
    {
        return $this->commonDestroy($id, Absence::class, 'absences.index', 'Ausencia eliminada.');
    }

    public function approve($id)
    {
        return $this->commonApprove($id, Absence::class, 'Ausencia aprobada.');
    }

    public function reject($id)
    {
        return $this->commonReject($id, Absence::class, 'Ausencia rechazada.');
    }
}
