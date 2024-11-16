<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Physician;
use Illuminate\Http\Request;

class PhysicianController extends Controller
{
        //Endpoints for physicians
    public function showAppointment($appointmentID)
    {
        $physician = Physician::findOrFail($physicianID);
        $appointments = $physician->appointments()
                                  ->where('is_active', true)
                                  ->orderBy('date', 'desc')
                                  ->get();
        return view('physician.appointments', compact('appointments'));
    }

    public function showAppointments($physicianID)
    {
        $physician = Physician::findOrFail($physicianID);
        $appointments = $physician->appointments()
                                  ->where('is_active', true)
                                  ->orderBy('date', 'desc')
                                  ->get();
        return view('physician.appointments', compact('appointments'));
    }

    public function updateAppointment(Request $request, $appointmentID)
    {
        $appointment = Appointment::findOrFail($appointmentID);
            // Ensure the physician is authorised to update the appointment
        if ($appointment->physician_id !== auth()->user()->id) {
            // Handle unauthorised access
        }
            // Validate the request data
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'comments' => 'nullable|string',
        ]);
        $appointment->update($request->all());

        return redirect()->route('physician.appointments')->with('success', 'Appointment updated successfully!');
    }

    public function updateComorbidities(Request $request, $userID)
    {
        // Ensure the physician is authorised to update the user's comorbidities
        // (e.g., check if the user is a patient of the physician)

        $user = User::findOrFail($userID);

        $request->validate([
            'comorbidities' => 'nullable|string',
        ]);

        $user->comorbidities = $request->comorbidities;
        $user->save();

            // Redirect or return a response
        return redirect()->back()->with('success', 'Comorbidities updated successfully.');
    }
}
