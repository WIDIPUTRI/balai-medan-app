<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalEmployees = \App\Models\Staff::count();

        $gender = \App\Models\Staff::selectRaw('gender, COUNT(*) as total')
            ->groupBy('gender')
            ->pluck('total', 'gender');

        $education = \App\Models\Staff::all()
            ->groupBy(function ($item) {
                $edu = strtoupper($item->education);
                return match (true) {
                    str_contains($edu, 'S-1') || str_contains($edu, 'S1') => 'S1',
                    str_contains($edu, 'S-2') || str_contains($edu, 'S2') => 'S2',
                    str_contains($edu, 'S-3') || str_contains($edu, 'S3') => 'S3',
                    str_contains($edu, 'D-3') || str_contains($edu, 'D3') => 'D3',
                    str_contains($edu, 'D-IV') || str_contains($edu, 'D4') => 'D4',
                    str_contains($edu, 'SMA') || str_contains($edu, 'SMK') => 'SMA/SMK',
                    default => 'Lainnya',
                };
            })
            ->map(fn($g) => $g->count());

        $ageGroups = [
            '18-25' => \App\Models\Staff::whereBetween('birth_date', [now()->subYears(25), now()->subYears(18)])->count(),
            '26-35' => \App\Models\Staff::whereBetween('birth_date', [now()->subYears(35), now()->subYears(26)])->count(),
            '36-45' => \App\Models\Staff::whereBetween('birth_date', [now()->subYears(45), now()->subYears(36)])->count(),
            '46-55' => \App\Models\Staff::whereBetween('birth_date', [now()->subYears(55), now()->subYears(46)])->count(),
            '56+' => \App\Models\Staff::where('birth_date', '<=', now()->subYears(56))->count(),
        ];

        $recentEmployees = \App\Models\Staff::latest()->limit(5)->get();

        return view('dashboard.index', compact(
            'totalEmployees',
            'gender',
            'education',
            'ageGroups',
            'recentEmployees'
        ));
    }
}