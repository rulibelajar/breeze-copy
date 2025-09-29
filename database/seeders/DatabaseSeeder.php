<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Aircraft;
use App\Models\Airport;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(100)->create();

        {
            $users = [
                [
                    'name' => 'Alice',
                    'username' => 'alice',
                    'email' => 'alice@example.com',
                    'password' => Hash::make('password'),
                ],
                [
                    'name' => 'Bob',
                    'username' => 'bob',
                    'email' => 'bob@example.com',
                    'password' => Hash::make('password'),
                ],
                [
                    'name' => 'User One',
                    'username' => 'user',
                    'email' => 'user@example.com',
                    'password' => Hash::make('password'),
                ],
                [
                    'name' => 'Admin One',
                    'username' => 'admin',
                    'role' => 'admin',
                    'email' => 'admin@example.com',
                    'password' => Hash::make('password'),
                ],
                [
                    'name' => 'Ricardo Simatupang',
                    'username' => 'ricardo',
                    'role' => 'user',
                    'email' => 'ricardo@example.com',
                    'password' => Hash::make('password'),
                ]
            ];

            // masukkan semua users ke database
            foreach ($users as $user) {
                User::create($user);
            }
        }

        $aircrafts = [
            [
                'aircraft_name' => 'Boeing 737-800',
                'manufacturer'  => 'Boeing',
                'capacity'      => 189,
                'range_km'      => 5436,
                'is_active'     => true,
            ],
            [
                'aircraft_name' => 'Airbus A320',
                'manufacturer'  => 'Airbus',
                'capacity'      => 180,
                'range_km'      => 6150,
                'is_active'     => true,
            ],
            [
                'aircraft_name' => 'Bombardier Q400',
                'manufacturer'  => 'Bombardier',
                'capacity'      => 78,
                'range_km'      => 2545,
                'is_active'     => true,
            ],
            [
                'aircraft_name' => 'Embraer E190',
                'manufacturer'  => 'Embraer',
                'capacity'      => 100,
                'range_km'      => 4537,
                'is_active'     => true,
            ],
        ];

        foreach ($aircrafts as $aircraft) {
            Aircraft::create($aircraft);
        }

        $airports = [
            ['iata_code' => 'CGK', 'icao_code' => 'WIII', 'name' => 'Soekarno–Hatta International Airport', 'city' => 'Jakarta', 'country' => 'Indonesia', 'latitude' => -6.125567, 'longitude' => 106.655897],
            ['iata_code' => 'DPS', 'icao_code' => 'WADD', 'name' => 'Ngurah Rai International Airport', 'city' => 'Denpasar', 'country' => 'Indonesia', 'latitude' => -8.748169, 'longitude' => 115.167172],
            ['iata_code' => 'SIN', 'icao_code' => 'WSSS', 'name' => 'Changi Airport', 'city' => 'Singapore', 'country' => 'Singapore', 'latitude' => 1.350189, 'longitude' => 103.994433],
            ['iata_code' => 'KUL', 'icao_code' => 'WMKK', 'name' => 'Kuala Lumpur International Airport', 'city' => 'Kuala Lumpur', 'country' => 'Malaysia', 'latitude' => 2.745578, 'longitude' => 101.709917],
            ['iata_code' => 'BKK', 'icao_code' => 'VTBS', 'name' => 'Suvarnabhumi Airport', 'city' => 'Bangkok', 'country' => 'Thailand', 'latitude' => 13.6811, 'longitude' => 100.7473],
            ['iata_code' => 'HKG', 'icao_code' => 'VHHH', 'name' => 'Hong Kong International Airport', 'city' => 'Hong Kong', 'country' => 'China', 'latitude' => 22.3089, 'longitude' => 113.9144],
            ['iata_code' => 'NRT', 'icao_code' => 'RJAA', 'name' => 'Narita International Airport', 'city' => 'Tokyo', 'country' => 'Japan', 'latitude' => 35.7647, 'longitude' => 140.3864],
            ['iata_code' => 'HND', 'icao_code' => 'RJTT', 'name' => 'Haneda Airport', 'city' => 'Tokyo', 'country' => 'Japan', 'latitude' => 35.5494, 'longitude' => 139.7798],
            ['iata_code' => 'ICN', 'icao_code' => 'RKSI', 'name' => 'Incheon International Airport', 'city' => 'Seoul', 'country' => 'South Korea', 'latitude' => 37.4602, 'longitude' => 126.4407],
            ['iata_code' => 'PEK', 'icao_code' => 'ZBAA', 'name' => 'Beijing Capital International Airport', 'city' => 'Beijing', 'country' => 'China', 'latitude' => 40.0801, 'longitude' => 116.5846],
            ['iata_code' => 'DXB', 'icao_code' => 'OMDB', 'name' => 'Dubai International Airport', 'city' => 'Dubai', 'country' => 'UAE', 'latitude' => 25.2528, 'longitude' => 55.3644],
            ['iata_code' => 'DOH', 'icao_code' => 'OTHH', 'name' => 'Hamad International Airport', 'city' => 'Doha', 'country' => 'Qatar', 'latitude' => 25.2731, 'longitude' => 51.6081],
            ['iata_code' => 'LHR', 'icao_code' => 'EGLL', 'name' => 'Heathrow Airport', 'city' => 'London', 'country' => 'United Kingdom', 'latitude' => 51.4706, 'longitude' => -0.4619],
            ['iata_code' => 'CDG', 'icao_code' => 'LFPG', 'name' => 'Charles de Gaulle Airport', 'city' => 'Paris', 'country' => 'France', 'latitude' => 49.0097, 'longitude' => 2.5479],
            ['iata_code' => 'AMS', 'icao_code' => 'EHAM', 'name' => 'Amsterdam Schiphol Airport', 'city' => 'Amsterdam', 'country' => 'Netherlands', 'latitude' => 52.3086, 'longitude' => 4.7639],
            ['iata_code' => 'FRA', 'icao_code' => 'EDDF', 'name' => 'Frankfurt am Main Airport', 'city' => 'Frankfurt', 'country' => 'Germany', 'latitude' => 50.0379, 'longitude' => 8.5622],
            ['iata_code' => 'JFK', 'icao_code' => 'KJFK', 'name' => 'John F. Kennedy International Airport', 'city' => 'New York', 'country' => 'USA', 'latitude' => 40.6413, 'longitude' => -73.7781],
            ['iata_code' => 'LAX', 'icao_code' => 'KLAX', 'name' => 'Los Angeles International Airport', 'city' => 'Los Angeles', 'country' => 'USA', 'latitude' => 33.9416, 'longitude' => -118.4085],
            ['iata_code' => 'ORD', 'icao_code' => 'KORD', 'name' => "O'Hare International Airport", 'city' => 'Chicago', 'country' => 'USA', 'latitude' => 41.9742, 'longitude' => -87.9073],
            ['iata_code' => 'SYD', 'icao_code' => 'YSSY', 'name' => 'Sydney Kingsford Smith Airport', 'city' => 'Sydney', 'country' => 'Australia', 'latitude' => -33.9399, 'longitude' => 151.1753],
        ];

        foreach ($airports as $airport) {
            Airport::create($airport);
        }
    }
}
