<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Physician;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
        //Endpoints for users
    public function showAppointments($userID)
    {
        $user = User::findOrFail($userID);
        $appointments = $user->appointments()
                             ->where('is_active', true)
                             ->orderBy('date', 'desc')
                             ->get();
        return view('user.appointments', compact('appointments'));
    }

    public function bookAppointmentForm($userID)
    {
        $user = User::findOrFail($userID);
        $physicians = Physician::all();

            // Return to the required view
        return view('user.book-appointment', compact('user', 'physicians'));
    }

    public function bookAppointment(Request $request)   //Since it comes from a form
    {
            // Validate the request data
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'comments' => 'nullable|string',
            'physician_id' => 'required|exists:physicians,id',
        ]);

            // Create a new appointment
        $appointment = new Appointment();
            $appointment->date = $request->date;
            $appointment->time = $request->time;
            $appointment->comments = $request->comments;
            $appointment->physician_id = $request->physician_id;
            $appointment->user_id = auth()->id(); // Assuming authenticated user
        $appointment->save();

            // Redirect or display a success message
        return redirect()->route('user.appointments')->with('success', 'Appointment booked successfully!');
    }

    public function cancelAppointment($appointmentID)
    {
            // Check if the user is authorised to cancel the appointment
        $appointment = Appointment::findOrFail($appointmentID);
        if ($appointment->user_id !== auth()->id()) {
            // Handle unauthorised access, e.g., redirect or show an error message
        }

        $appointment->is_active = false;
        $appointment->save();
        return redirect()->route('user.appointments')->with('success', 'Appointment cancelled successfully!');
    }
}
