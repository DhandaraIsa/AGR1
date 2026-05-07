<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EventAdminController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('date_start', 'desc')->get();

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_start' => 'required|date',
            'date_end' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('img/eventos'), $filename);

            $data['banner_image'] = 'img/eventos/' . $filename;
        }

        $data['status'] = $request->has('status') ? 1 : 0;

        Event::create($data);

        return redirect()->route('admin.events.index')->with('success', 'Evento criado com sucesso!');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_start' => 'required|date',
            'date_end' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('banner_image')) {
            if ($event->banner_image && File::exists(public_path($event->banner_image))) {
                File::delete(public_path($event->banner_image));
            }

            $image = $request->file('banner_image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('img/eventos'), $filename);

            $data['banner_image'] = 'img/eventos/' . $filename;
        }

        $data['status'] = $request->has('status') ? 1 : 0;

        $event->update($data);

        return redirect()->route('admin.events.index')->with('success', 'Evento atualizado com sucesso!');
    }

    public function destroy(Event $event)
    {
        if ($event->banner_image && File::exists(public_path($event->banner_image))) {
            File::delete(public_path($event->banner_image));
        }

        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Evento excluído com sucesso!');
    }
}