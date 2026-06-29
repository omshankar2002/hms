<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Guest;
use App\Models\HousekeepingTask;
use App\Models\Payment;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Room stats
        $totalRooms     = Room::count();
        $availableRooms = Room::where('status', 'available')->count();
        $bookedRooms    = Room::where('status', 'booked')->count();
        $maintenanceRooms = Room::where('status', 'maintenance')->count();

        // Booking stats
        $totalBookings     = Booking::count();
        $todayCheckIns     = Booking::whereDate('check_in', today())->whereIn('status', ['confirmed', 'checked_in'])->count();
        $todayCheckOuts    = Booking::whereDate('check_out', today())->where('status', 'checked_in')->count();
        $activeBookings    = Booking::whereIn('status', ['confirmed', 'checked_in'])->count();
        $pendingBookings   = Booking::where('status', 'pending')->count();

        // Revenue stats
        $totalRevenue      = Payment::where('status', 'completed')->sum('amount');
        $todayRevenue      = Payment::where('status', 'completed')->whereDate('paid_at', today())->sum('amount');
        $monthRevenue      = Payment::where('status', 'completed')
                                    ->whereMonth('paid_at', now()->month)
                                    ->whereYear('paid_at', now()->year)
                                    ->sum('amount');
        $lastMonthRevenue  = Payment::where('status', 'completed')
                                    ->whereMonth('paid_at', now()->subMonth()->month)
                                    ->whereYear('paid_at', now()->subMonth()->year)
                                    ->sum('amount');

        // Guest stats
        $totalGuests       = Guest::count();
        $newGuestsThisMonth= Guest::whereMonth('created_at', now()->month)->count();

        // Housekeeping
        $pendingTasks      = HousekeepingTask::where('status', 'pending')->whereDate('scheduled_date', today())->count();

        // Recent bookings
        $recentBookings = Booking::with('guest', 'room.roomType')
                                 ->latest()->limit(8)->get();

        // Occupancy rate
        $occupancyRate = $totalRooms > 0 ? round(($bookedRooms / $totalRooms) * 100, 1) : 0;

        // Monthly revenue chart data (last 6 months)
        $chartData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $chartData[] = [
                'month'   => $month->format('M Y'),
                'revenue' => Payment::where('status', 'completed')
                                    ->whereMonth('paid_at', $month->month)
                                    ->whereYear('paid_at', $month->year)
                                    ->sum('amount'),
            ];
        }

        return view('admin.dashboard', compact(
            'totalRooms', 'availableRooms', 'bookedRooms', 'maintenanceRooms',
            'totalBookings', 'todayCheckIns', 'todayCheckOuts', 'activeBookings', 'pendingBookings',
            'totalRevenue', 'todayRevenue', 'monthRevenue', 'lastMonthRevenue',
            'totalGuests', 'newGuestsThisMonth', 'pendingTasks',
            'recentBookings', 'occupancyRate', 'chartData'
        ));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
