<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseRequest;

class PurchaseController extends Controller
{
    use \App\Traits\ReservationTrait;

    private array $catalog = [
        '💻 Ordenador portátil','🖥️ Monitor','⌨️ Teclado','🖱️ Ratón',
        '🖨️ Impresora','📱 Móvil de empresa','🎧 Auriculares',
        '💺 Silla ergonómica','📦 Material de oficina','Otro',
    ];

    public function index()
    {
        $isAdmin = session('user_role') === 'admin';
        $items   = $isAdmin
            ? PurchaseRequest::with('user')->orderBy('created_at','desc')->paginate(15)
            : PurchaseRequest::where('user_id', session('user_id'))->orderBy('created_at','desc')->paginate(15);

        return view('purchases.index', ['items' => $items, 'catalog' => $this->catalog]);
    }

    public function create()
    {
        return view('purchases.create', ['catalog' => $this->catalog]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'item'     => 'required|max:255',
            'quantity' => 'required|integer|min:1|max:100',
            'reason'   => 'required',
        ], [
            'item.required'   => 'Selecciona o escribe el artículo.',
            'reason.required' => 'La justificación es obligatoria.',
        ]);

        $item = $request->item === 'Otro' ? ($request->custom_item ?: 'Otro') : $request->item;

        PurchaseRequest::create([
            'user_id'         => session('user_id'),
            'item'            => $item,
            'quantity'        => $request->quantity,
            'reason'          => $request->reason,
            'estimated_price' => $request->estimated_price,
            'status'          => 'pendiente',
        ]);

        return redirect()->route('purchases.index')->with('success', 'Solicitud enviada correctamente. El administrador la revisará pronto.');
    }

    public function destroy($id)
    {
        return $this->commonDestroy($id, PurchaseRequest::class, 'purchases.index', 'Solicitud eliminada.');
    }

    public function approve($id)
    {
        if (session('user_role') !== 'admin') abort(403);
        $req = PurchaseRequest::findOrFail($id);
        $req->update(['status' => 'aprobada', 'admin_notes' => request('admin_notes')]);
        return redirect()->back()->with('success', 'Solicitud aprobada.');
    }

    public function reject($id)
    {
        return $this->commonReject($id, PurchaseRequest::class, 'Solicitud rechazada.');
    }
}
