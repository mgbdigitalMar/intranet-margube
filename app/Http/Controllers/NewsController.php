<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::with('author')->orderBy('created_at', 'desc');
        if ($request->type && $request->type !== 'all') {
            $query->where('type', $request->type);
        }
        $news = $query->paginate(12);
        return view('news.index', compact('news'));
    }

    public function create()
    {
        if (session('user_role') !== 'admin') abort(403);
        return view('news.create');
    }

    public function store(Request $request)
    {
        if (session('user_role') !== 'admin') abort(403);
        $request->validate([
            'type'       => 'required|in:noticia,evento',
            'title'      => 'required|max:255',
            'body'       => 'required',
            'event_date' => 'nullable|date',
        ], [
            'title.required' => 'El título es obligatorio.',
            'body.required'  => 'El contenido es obligatorio.',
        ]);

        News::create([
            'user_id'    => session('user_id'),
            'type'       => $request->type,
            'title'      => $request->title,
            'body'       => $request->body,
            'event_date' => $request->event_date,
        ]);

        return redirect()->route('news.index')->with('success', 'Publicación creada correctamente.');
    }

    public function edit($id)
    {
        if (session('user_role') !== 'admin') abort(403);
        $item = News::findOrFail($id);
        return view('news.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        if (session('user_role') !== 'admin') abort(403);
        $item = News::findOrFail($id);
        $request->validate([
            'type'       => 'required|in:noticia,evento',
            'title'      => 'required|max:255',
            'body'       => 'required',
            'event_date' => 'nullable|date',
        ]);
        $item->update([
            'type'       => $request->type,
            'title'      => $request->title,
            'body'       => $request->body,
            'event_date' => $request->event_date,
        ]);
        return redirect()->route('news.index')->with('success', 'Publicación actualizada.');
    }

    public function destroy($id)
    {
        if (session('user_role') !== 'admin') abort(403);
        News::findOrFail($id)->delete();
        return redirect()->route('news.index')->with('success', 'Publicación eliminada.');
    }
}
