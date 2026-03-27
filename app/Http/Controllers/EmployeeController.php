<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class EmployeeController extends Controller
{
    private array $departments = ['IT','Marketing','RRHH','Ventas','Finanzas','Operaciones','Dirección','Logística','Atención al cliente'];

    public function index(Request $request)
    {
        $query = User::orderBy('name');
        if ($request->search) {
            $s = $request->search;
            $query->where(function($q) use ($s) {
                $q->where('name','like',"%$s%")
                  ->orWhere('department','like',"%$s%")
                  ->orWhere('position','like',"%$s%");
            });
        }
        if ($request->department) $query->where('department', $request->department);
        $employees   = $query->paginate(15);
        $departments = $this->departments;
        return view('employees.index', compact('employees','departments'));
    }

    public function create()
    {
        $departments = $this->departments;
        return view('employees.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|max:255',
            'email'      => 'required|email|unique:users,email',
            'department' => 'required',
            'position'   => 'required|max:255',
            'birthday'   => 'nullable|date',
            'role'       => 'required|in:admin,employee',
        ], [
            'name.required'       => 'El nombre es obligatorio.',
            'email.required'      => 'El correo es obligatorio.',
            'email.unique'        => 'Ya existe un empleado con ese correo.',
            'department.required' => 'Selecciona un departamento.',
            'position.required'   => 'El cargo es obligatorio.',
        ]);

        User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password ?? 'emp123'),
            'role'       => $request->role,
            'department' => $request->department,
            'position'   => $request->position,
            'phone'      => $request->phone,
            'birthday'   => $request->birthday,
        ]);

        return redirect()->route('employees.index')->with('success', "Empleado {$request->name} añadido correctamente. Contraseña inicial: emp123");
    }

    public function edit($id)
    {
        $employee    = User::findOrFail($id);
        $departments = $this->departments;
        return view('employees.edit', compact('employee','departments'));
    }

    public function update(Request $request, $id)
    {
        $employee = User::findOrFail($id);
        $request->validate([
            'name'       => 'required|max:255',
            'email'      => "required|email|unique:users,email,{$id}",
            'department' => 'required',
            'position'   => 'required|max:255',
            'birthday'   => 'nullable|date',
            'role'       => 'required|in:admin,employee',
        ]);

        $data = [
            'name'       => $request->name,
            'email'      => $request->email,
            'role'       => $request->role,
            'department' => $request->department,
            'position'   => $request->position,
            'phone'      => $request->phone,
            'birthday'   => $request->birthday,
        ];
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $employee->update($data);
        return redirect()->route('employees.index')->with('success', 'Empleado actualizado correctamente.');
    }

    public function destroy($id)
    {
        if ($id == session('user_id')) {
            return redirect()->route('employees.index')->with('error', 'No puedes eliminarte a ti mismo.');
        }
        User::findOrFail($id)->delete();
        return redirect()->route('employees.index')->with('success', 'Empleado eliminado.');
    }

    public function toggleRole($id)
    {
        $user = User::findOrFail($id);
        if ($id == session('user_id')) {
            return redirect()->back()->with('error', 'No puedes cambiar tu propio rol.');
        }
        $user->update(['role' => $user->role === 'admin' ? 'employee' : 'admin']);
        return redirect()->back()->with('success', 'Rol actualizado.');
    }
}
