<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HotelSeeder extends Seeder
{
    public function run(): void
    {
        // ── Room Types ──────────────────────────────────────────────
        $roomTypes = [
            [
                'name'         => 'Standard Room',
                'slug'         => 'standard-room',
                'description'  => 'A comfortable and well-appointed room with all essential amenities for a pleasant stay.',
                'base_price'   => 3500,
                'max_adults'   => 2,
                'max_children' => 1,
                'total_rooms'  => 10,
                'status'       => 'active',
            ],
            [
                'name'         => 'Deluxe Room',
                'slug'         => 'deluxe-room',
                'description'  => 'A spacious deluxe room with premium furnishings, a king-size bed, and city views.',
                'base_price'   => 5500,
                'max_adults'   => 2,
                'max_children' => 2,
                'total_rooms'  => 8,
                'status'       => 'active',
            ],
            [
                'name'         => 'Executive Suite',
                'slug'         => 'executive-suite',
                'description'  => 'An elegant suite with a separate living area, premium amenities, and panoramic views.',
                'base_price'   => 9500,
                'max_adults'   => 3,
                'max_children' => 2,
                'total_rooms'  => 5,
                'status'       => 'active',
            ],
            [
                'name'         => 'Presidential Suite',
                'slug'         => 'presidential-suite',
                'description'  => 'The pinnacle of luxury — a grand suite with butler service, private dining, and breathtaking views.',
                'base_price'   => 18000,
                'max_adults'   => 4,
                'max_children' => 2,
                'total_rooms'  => 2,
                'status'       => 'active',
            ],
            [
                'name'         => 'Family Room',
                'slug'         => 'family-room',
                'description'  => 'Designed for families, this spacious room features two double beds and child-friendly amenities.',
                'base_price'   => 7000,
                'max_adults'   => 4,
                'max_children' => 3,
                'total_rooms'  => 6,
                'status'       => 'active',
            ],
        ];

        foreach ($roomTypes as $rt) {
            DB::table('room_types')->updateOrInsert(['slug' => $rt['slug']], array_merge($rt, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // ── Rooms ───────────────────────────────────────────────────
        $rtIds = DB::table('room_types')->pluck('id', 'slug');

        $rooms = [
            // Standard Rooms (101–110)
            ['room_type_id' => $rtIds['standard-room'],    'room_number' => '101', 'floor' => 1],
            ['room_type_id' => $rtIds['standard-room'],    'room_number' => '102', 'floor' => 1],
            ['room_type_id' => $rtIds['standard-room'],    'room_number' => '103', 'floor' => 1],
            ['room_type_id' => $rtIds['standard-room'],    'room_number' => '104', 'floor' => 1],
            ['room_type_id' => $rtIds['standard-room'],    'room_number' => '201', 'floor' => 2],
            ['room_type_id' => $rtIds['standard-room'],    'room_number' => '202', 'floor' => 2],
            // Deluxe Rooms (203–210)
            ['room_type_id' => $rtIds['deluxe-room'],      'room_number' => '203', 'floor' => 2],
            ['room_type_id' => $rtIds['deluxe-room'],      'room_number' => '204', 'floor' => 2],
            ['room_type_id' => $rtIds['deluxe-room'],      'room_number' => '301', 'floor' => 3],
            ['room_type_id' => $rtIds['deluxe-room'],      'room_number' => '302', 'floor' => 3],
            // Executive Suites (401–405)
            ['room_type_id' => $rtIds['executive-suite'],  'room_number' => '401', 'floor' => 4],
            ['room_type_id' => $rtIds['executive-suite'],  'room_number' => '402', 'floor' => 4],
            ['room_type_id' => $rtIds['executive-suite'],  'room_number' => '403', 'floor' => 4],
            // Presidential Suite
            ['room_type_id' => $rtIds['presidential-suite'],'room_number'=> '501', 'floor' => 5],
            ['room_type_id' => $rtIds['presidential-suite'],'room_number'=> '502', 'floor' => 5],
            // Family Rooms
            ['room_type_id' => $rtIds['family-room'],      'room_number' => '303', 'floor' => 3],
            ['room_type_id' => $rtIds['family-room'],      'room_number' => '304', 'floor' => 3],
            ['room_type_id' => $rtIds['family-room'],      'room_number' => '305', 'floor' => 3],
        ];

        foreach ($rooms as $room) {
            DB::table('rooms')->updateOrInsert(
                ['room_number' => $room['room_number']],
                array_merge($room, [
                    'status'     => 'available',
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }

        // ── Hotel Services ──────────────────────────────────────────
        $services = [
            ['name' => 'Airport Pickup',      'category' => 'transport',    'price' => 800,  'unit' => 'per trip',    'status' => 'active'],
            ['name' => 'Airport Drop',        'category' => 'transport',    'price' => 800,  'unit' => 'per trip',    'status' => 'active'],
            ['name' => 'Laundry (per kg)',     'category' => 'laundry',      'price' => 150,  'unit' => 'per kg',      'status' => 'active'],
            ['name' => 'Dry Cleaning',        'category' => 'laundry',      'price' => 300,  'unit' => 'per item',    'status' => 'active'],
            ['name' => 'Spa Session (60 min)','category' => 'spa',          'price' => 2000, 'unit' => 'per session', 'status' => 'active'],
            ['name' => 'Breakfast (per head)','category' => 'food',         'price' => 500,  'unit' => 'per person',  'status' => 'active'],
            ['name' => 'Room Dinner',         'category' => 'food',         'price' => 1200, 'unit' => 'per meal',    'status' => 'active'],
            ['name' => 'Mini Bar Refill',     'category' => 'beverage',     'price' => 800,  'unit' => 'per refill',  'status' => 'active'],
            ['name' => 'Extra Bed',           'category' => 'accommodation','price' => 1500, 'unit' => 'per night',   'status' => 'active'],
            ['name' => 'City Tour (half day)','category' => 'excursion',    'price' => 2500, 'unit' => 'per person',  'status' => 'active'],
        ];

        foreach ($services as $service) {
            DB::table('hotel_services')->updateOrInsert(
                ['name' => $service['name']],
                array_merge($service, ['created_at' => now(), 'updated_at' => now()])
            );
        }

        $this->command->info('Hotel seed data inserted successfully!');
        $this->command->info('  Room Types : ' . count($roomTypes));
        $this->command->info('  Rooms      : ' . count($rooms));
        $this->command->info('  Services   : ' . count($services));
    }
}
