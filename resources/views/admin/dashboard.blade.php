@extends('admin.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Hotel Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="close" data-dismiss="alert">&times;</button></div>
    @endif

    {{-- Room Status Cards --}}
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $availableRooms }}</h3>
                    <p>Available Rooms</p>
                </div>
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <a href="{{ route('rooms.index', ['status' => 'available']) }}" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $bookedRooms }}</h3>
                    <p>Occupied Rooms</p>
                </div>
                <div class="icon"><i class="fas fa-bed"></i></div>
                <a href="{{ route('rooms.index', ['status' => 'booked']) }}" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $activeBookings }}</h3>
                    <p>Active Bookings</p>
                </div>
                <div class="icon"><i class="fas fa-calendar-check"></i></div>
                <a href="{{ route('bookings.index', ['status' => 'checked_in']) }}" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $occupancyRate }}%</h3>
                    <p>Occupancy Rate</p>
                </div>
                <div class="icon"><i class="fas fa-chart-pie"></i></div>
                <a href="{{ route('rooms.index') }}" class="small-box-footer">{{ $totalRooms }} Total Rooms <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    {{-- Revenue Cards --}}
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-rupee-sign"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Today's Revenue</span>
                    <span class="info-box-number">₹{{ number_format($todayRevenue, 2) }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="info-box">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-calendar-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">This Month</span>
                    <span class="info-box-number">₹{{ number_format($monthRevenue, 2) }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="info-box">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Guests</span>
                    <span class="info-box-number">{{ $totalGuests }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="info-box">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-broom"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pending Tasks Today</span>
                    <span class="info-box-number">{{ $pendingTasks }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Today Activity --}}
    <div class="row">
        <div class="col-md-3 col-6">
            <div class="info-box bg-gradient-teal">
                <span class="info-box-icon"><i class="fas fa-sign-in-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Today Check-Ins</span>
                    <span class="info-box-number">{{ $todayCheckIns }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="info-box bg-gradient-orange">
                <span class="info-box-icon"><i class="fas fa-sign-out-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Today Check-Outs</span>
                    <span class="info-box-number">{{ $todayCheckOuts }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="info-box bg-gradient-purple">
                <span class="info-box-icon"><i class="fas fa-clock"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pending Bookings</span>
                    <span class="info-box-number">{{ $pendingBookings }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="info-box bg-gradient-maroon">
                <span class="info-box-icon"><i class="fas fa-tools"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Maintenance Rooms</span>
                    <span class="info-box-number">{{ $maintenanceRooms }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Revenue Chart --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-chart-bar mr-1"></i> Revenue - Last 6 Months</h3>
                </div>
                <div class="card-body">
                    <canvas id="revenueChart" style="min-height:250px; height:250px;"></canvas>
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title text-white"><i class="fas fa-bolt mr-1"></i> Quick Actions</h3>
                </div>
                <div class="card-body p-2">
                    <a href="{{ route('bookings.create') }}" class="btn btn-success btn-block mb-2">
                        <i class="fas fa-plus mr-1"></i> New Booking
                    </a>
                    <a href="{{ route('guests.create') }}" class="btn btn-info btn-block mb-2">
                        <i class="fas fa-user-plus mr-1"></i> Add Guest
                    </a>
                    <a href="{{ route('housekeeping.create') }}" class="btn btn-warning btn-block mb-2">
                        <i class="fas fa-broom mr-1"></i> Assign Cleaning Task
                    </a>
                    <a href="{{ route('rooms.create') }}" class="btn btn-secondary btn-block mb-2">
                        <i class="fas fa-door-open mr-1"></i> Add Room
                    </a>
                    <a href="{{ route('room-types.create') }}" class="btn btn-dark btn-block">
                        <i class="fas fa-bed mr-1"></i> Add Room Type
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Bookings --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-calendar-alt mr-1"></i> Recent Bookings</h3>
                    <div class="card-tools">
                        <a href="{{ route('bookings.index') }}" class="btn btn-sm btn-primary">View All</a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Booking #</th>
                                <th>Guest</th>
                                <th>Room</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentBookings as $booking)
                            <tr>
                                <td><strong>{{ $booking->booking_number }}</strong></td>
                                <td>{{ $booking->guest->name }}</td>
                                <td>{{ $booking->room->room_number }} <small class="text-muted">({{ $booking->room->roomType->name }})</small></td>
                                <td>{{ $booking->check_in->format('d M Y') }}</td>
                                <td>{{ $booking->check_out->format('d M Y') }}</td>
                                <td>₹{{ number_format($booking->grand_total, 2) }}</td>
                                <td>
                                    @php $statusColors = ['pending'=>'warning','confirmed'=>'info','checked_in'=>'success','checked_out'=>'secondary','cancelled'=>'danger']; @endphp
                                    <span class="badge badge-{{ $statusColors[$booking->status] ?? 'secondary' }}">
                                        {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                                    </span>
                                </td>
                                <td>
                                    @php $payColors = ['unpaid'=>'danger','partial'=>'warning','paid'=>'success']; @endphp
                                    <span class="badge badge-{{ $payColors[$booking->payment_status] ?? 'secondary' }}">
                                        {{ ucfirst($booking->payment_status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-xs btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="9" class="text-center text-muted py-3">No bookings yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
</section>
@endsection

@section('customJs')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('revenueChart').getContext('2d');
const chartData = @json($chartData);
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: chartData.map(d => d.month),
        datasets: [{
            label: 'Revenue (₹)',
            data: chartData.map(d => d.revenue),
            backgroundColor: 'rgba(60,141,188,0.7)',
            borderColor: 'rgba(60,141,188,1)',
            borderWidth: 1
        }]
    },
    options: { responsive: true, scales: { y: { beginAtZero: true } } }
});
</script>
@endsection
