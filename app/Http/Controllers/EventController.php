<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        // Örnek etkinlik verileri
        $events = [
            [
                'title' => 'Yılbaşı Gala Yemeği',
                'date' => '2024-12-31',
                'time' => '20:00',
                'description' => 'Muhteşem bir yılbaşı kutlaması için sizleri lüks otelimize bekliyoruz.',
                'image' => 'https://images.unsplash.com/photo-1574391884720-bbc3740c59d1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80'
            ],
            [
                'title' => 'Düğün Organizasyonu',
                'date' => '2024-06-15',
                'time' => '18:00',
                'description' => 'Hayalinizdeki düğün için lüks salonlarımız ve profesyonel ekibimizle hizmetinizdeyiz.',
                'image' => 'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2098&q=80'
            ],
            [
                'title' => 'İş Toplantıları',
                'date' => 'Her Gün',
                'time' => '09:00 - 18:00',
                'description' => 'Modern toplantı salonlarımızda iş toplantılarınızı gerçekleştirin.',
                'image' => 'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2069&q=80'
            ]
        ];

        return view('events.index', compact('events'));
    }
} 