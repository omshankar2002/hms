<?php

// App\Http\Controllers\Admin\AppointmentController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::orderBy('id', 'desc')->paginate(10); // ✅ this enables pagination

        return view('admin.appointments.index', compact('appointments'));
    }

        public function show($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('admin.appointments.show', compact('appointment'));
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        
        return redirect()->route('admin.appointments')
            ->with('success', 'Appointment deleted successfully');
    }
}