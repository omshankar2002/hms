<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\HousekeepingTask;
use App\Models\Room;
use Illuminate\Http\Request;

class HousekeepingController extends Controller
{
    public function index(Request $request)
    {
        $query = HousekeepingTask::with('room.roomType');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('date')) {
            $query->whereDate('scheduled_date', $request->date);
        }

        $tasks = $query->orderBy('scheduled_date')->orderBy('priority', 'desc')->paginate(20);
        return view('admin.housekeeping.index', compact('tasks'));
    }

    public function create()
    {
        $rooms = Room::with('roomType')->orderBy('room_number')->get();
        return view('admin.housekeeping.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id'        => 'required|exists:rooms,id',
            'task_type'      => 'required|in:cleaning,inspection,maintenance,setup',
            'priority'       => 'required|in:low,normal,high,urgent',
            'scheduled_date' => 'required|date',
            'assigned_to'    => 'nullable|string',
            'notes'          => 'nullable|string',
        ]);

        HousekeepingTask::create($request->all());

        return redirect()->route('housekeeping.index')->with('success', 'Housekeeping task created.');
    }

    public function updateStatus(Request $request, HousekeepingTask $task)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,completed,skipped',
        ]);

        $data = ['status' => $request->status];

        if ($request->status === 'completed') {
            $data['completed_at'] = now();
            // Mark room as available after cleaning
            if ($task->task_type === 'cleaning') {
                $task->room->update(['status' => 'available']);
            }
        }

        $task->update($data);

        return back()->with('success', 'Task status updated.');
    }

    public function destroy(HousekeepingTask $task)
    {
        $task->delete();
        return redirect()->route('housekeeping.index')->with('success', 'Task deleted.');
    }
}
