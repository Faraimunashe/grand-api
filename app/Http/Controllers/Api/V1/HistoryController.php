<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Physiotherapy;
use App\Models\User;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $history = Physiotherapy::where('physiotherapies.user_id', Auth::id())
        ->get();

        $response = [
            'history' => $history
        ];

        return response($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'patient' => ['required', 'string'],
            'symptoms' => ['required', 'string'],
            'self' => ['required', 'integer']
        ]);

        $relatedInjury = $this->findRelatedInjuryByWordMatches($request->symptoms);


        $patient = $request->patient;
        if($request->self)
        {
            $user = User::find(Auth::id());
            $patient = $user->name;
        }

        $p = new Physiotherapy();
        $p->user_id = Auth::id();
        $p->patient = $patient;
        $p->symptoms = $request->symptoms;
        $p->diagnosis = $relatedInjury['Possible Diagnoses'];
        $p->recover_time = $relatedInjury['Recovery Time'];
        $p->exercises = $relatedInjury['Recommended Exercises'];
        $p->save();

        $response = [
            'data' => $p
        ];

        return response($response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function magic($word)
    {
        
        
    }

    

    

    function findRelatedInjuryByWordMatches($userInput) {
        $injuries = [
            [
                "Injury Description" => "Pain in the knee after long-distance running",
                "Affected Area" => "Knee",
                "Possible Diagnoses" => "Runner's Knee",
                "Recovery Time" => "4-8 weeks",
                "Recommended Exercises" => "Quadriceps and hamstring strengthening"
            ],
            [
                "Injury Description" => "Pain in the lower back after bending",
                "Affected Area" => "Lower Back",
                "Possible Diagnoses" => "Lumbar Strain",
                "Recovery Time" => "2-4 weeks",
                "Recommended Exercises" => "Gentle stretching and strengthening exercises"
            ],
            [
                "Injury Description" => "Pain in the hip after a fall",
                "Affected Area" => "Hip",
                "Possible Diagnoses" => "Hip Contusion",
                "Recovery Time" => "3-6 weeks",
                "Recommended Exercises" => "Rest and gradual return to activity"
            ],
            [
                "Injury Description" => "Pain in the hip after a fall",
                "Affected Area" => "Hip",
                "Possible Diagnoses" => "Hip Fracture",
                "Recovery Time" => "12-16 weeks",
                "Recommended Exercises" => "Rehabilitation under supervision"
            ],
            [
                "Injury Description" => "Pain in the shoulder after a fall",
                "Affected Area" => "Shoulder",
                "Possible Diagnoses" => "Shoulder Dislocation",
                "Recovery Time" => "8-12 weeks",
                "Recommended Exercises" => "Rehabilitation exercises"
            ],
            [
                "Injury Description" => "Pain in the lower back when bending",
                "Affected Area" => "Lower Back",
                "Possible Diagnoses" => "Lumbar Sprain",
                "Recovery Time" => "3-6 weeks",
                "Recommended Exercises" => "Core stability exercises"
            ],
            [
                "Injury Description" => "Pain in the ankle after high-impact sports",
                "Affected Area" => "Ankle",
                "Possible Diagnoses" => "Achilles Tendinopathy",
                "Recovery Time" => "4-8 weeks",
                "Recommended Exercises" => "Calf and ankle strengthening exercises"
            ],
            [
                "Injury Description" => "Pain in the knee after playing basketball",
                "Affected Area" => "Knee",
                "Possible Diagnoses" => "Jumpers Knee",
                "Recovery Time" => "4-8 weeks",
                "Recommended Exercises" => "Quadriceps strengthening exercises"
            ],
            [
                "Injury Description" => "Pain in the knee after prolonged sitting",
                "Affected Area" => "Knee",
                "Possible Diagnoses" => "Chondromalacia Patella",
                "Recovery Time" => "4-6 weeks",
                "Recommended Exercises" => "Quadriceps strengthening exercises"
            ],
            [
                "Injury Description" => "Pain in the foot after excessive walking",
                "Affected Area" => "Foot",
                "Possible Diagnoses" => "Metatarsalgia",
                "Recovery Time" => "3-6 weeks",
                "Recommended Exercises" => "Foot strengthening exercises"
            ],
            [
                "Injury Description" => "Pain in the ankle during physical activity",
                "Affected Area" => "Ankle",
                "Possible Diagnoses" => "Achilles Tendonitis",
                "Recovery Time" => "4-6 weeks",
                "Recommended Exercises" => "Calf and ankle strengthening exercises"
            ],
            [
                "Injury Description" => "Knee pain and swelling after running",
                "Affected Area" => "Knee",
                "Possible Diagnoses" => "Ligament Tear",
                "Recovery Time" => "3-6 weeks",
                "Recommended Exercises" => "Gentle range-of-motion exercises"
            ],
            [
                "Injury Description" => "Soreness in the forearm after playing tennis",
                "Affected Area" => "Forearm",
                "Possible Diagnoses" => "Forearm Strain",
                "Recovery Time" => "3-5 weeks",
                "Recommended Exercises" => "Forearm stretching and strengthening exercises"
            ],
            [
                "Injury Description" => "Pain in the upper back after slouching",
                "Affected Area" => "Upper Back",
                "Possible Diagnoses" => "Upper Crossed Syndrome",
                "Recovery Time" => "3-6 weeks",
                "Recommended Exercises" => "Postural exercises"
            ],
            [
                "Injury Description" => "Pain in the groin area after sprinting",
                "Affected Area" => "Groin",
                "Possible Diagnoses" => "Groin Strain",
                "Recovery Time" => "3-5 weeks",
                "Recommended Exercises" => "Gentle stretching exercises"
            ],
            [
                "Injury Description" => "Hip pain after long-distance running",
                "Affected Area" => "Hip",
                "Possible Diagnoses" => "Hip Flexor Strain",
                "Recovery Time" => "2-6 weeks",
                "Recommended Exercises" => "Hip mobility exercises"
            ],
            [
                "Injury Description" => "Pain in the knee after twisting",
                "Affected Area" => "Knee",
                "Possible Diagnoses" => "Meniscus Tear",
                "Recovery Time" => "6-12 weeks",
                "Recommended Exercises" => "Rehabilitation and strengthening"
            ],
            [
                "Injury Description" => "Pain and swelling in the shoulder after repetitive throwing",
                "Affected Area" => "Shoulder",
                "Possible Diagnoses" => "Shoulder Tendonitis",
                "Recovery Time" => "3-6 weeks",
                "Recommended Exercises" => "Shoulder strengthening and stretching exercises"
            ],
            [
                "Injury Description" => "Pain in the foot during walking",
                "Affected Area" => "Foot",
                "Possible Diagnoses" => "Metatarsalgia",
                "Recovery Time" => "4-6 weeks",
                "Recommended Exercises" => "Foot strengthening exercises"
            ],
            [
                "Injury Description" => "Pain in the knee after climbing stairs",
                "Affected Area" => "Knee",
                "Possible Diagnoses" => "Patellar Tendonitis",
                "Recovery Time" => "4-8 weeks",
                "Recommended Exercises" => "Quadriceps strengthening exercises"
            ],
            [
                "Injury Description" => "Pain in the hip during running",
                "Affected Area" => "Hip",
                "Possible Diagnoses" => "Iliotibial Band Syndrome",
                "Recovery Time" => "4-6 weeks",
                "Recommended Exercises" => "IT band stretching exercises"
            ],
            [
                "Injury Description" => "Sharp pain in the knee when climbing stairs",
                "Affected Area" => "Knee",
                "Possible Diagnoses" => "Patellar Tendinopathy",
                "Recovery Time" => "4-6 weeks",
                "Recommended Exercises" => "Quadriceps and hamstring strengthening exercises"
            ],
            [
                "Injury Description" => "Pain in the shoulder after swimming",
                "Affected Area" => "Shoulder",
                "Possible Diagnoses" => "Shoulder Impingement",
                "Recovery Time" => "4-8 weeks",
                "Recommended Exercises" => "Shoulder mobility and strengthening exercises"
            ],
            [
                "Injury Description" => "Pain in the neck after a long phone call",
                "Affected Area" => "Neck",
                "Possible Diagnoses" => "Cervical Strain",
                "Recovery Time" => "2-4 weeks",
                "Recommended Exercises" => "Neck mobility exercises"
            ],
            [
                "Injury Description" => "Pain in the thigh during running",
                "Affected Area" => "Thigh",
                "Possible Diagnoses" => "Quadriceps Strain",
                "Recovery Time" => "4-6 weeks",
                "Recommended Exercises" => "Quadriceps stretching and strengthening"
            ],
            [
                "Injury Description" => "Pain in the heel after prolonged standing",
                "Affected Area" => "Heel",
                "Possible Diagnoses" => "Achilles Tendinopathy",
                "Recovery Time" => "4-6 weeks",
                "Recommended Exercises" => "Calf stretches and strengthening"
            ],
            [
                "Injury Description" => "Pain in the wrist after playing sports",
                "Affected Area" => "Wrist",
                "Possible Diagnoses" => "Repetitive Strain Injury",
                "Recovery Time" => "4-6 weeks",
                "Recommended Exercises" => "Wrist mobility exercises"
            ],
            [
                "Injury Description" => "Pain in the heel when starting to walk",
                "Affected Area" => "Heel",
                "Possible Diagnoses" => "Plantar Fasciitis",
                "Recovery Time" => "4-8 weeks",
                "Recommended Exercises" => "Stretching and strengthening exercises"
            ],
            [
                "Injury Description" => "Pain in the heel after running on hard surfaces",
                "Affected Area" => "Heel",
                "Possible Diagnoses" => "Plantar Fasciitis",
                "Recovery Time" => "4-6 weeks",
                "Recommended Exercises" => "Foot and calf strengthening exercises"
            ],
            [
                "Injury Description" => "Pain in the lower back during squats",
                "Affected Area" => "Lower Back",
                "Possible Diagnoses" => "Lumbar Strain",
                "Recovery Time" => "4-6 weeks",
                "Recommended Exercises" => "Strengthening exercises for the core"
            ]
        ];
        $mostMatchingInjury = null;
        $maxWordMatches = 0;
    
        // Convert user input to lowercase and split into words
        $userWords = array_unique(explode(' ', strtolower($userInput)));
    
        foreach ($injuries as $injury) {
            $injuryDescription = strtolower($injury['Injury Description']);
            
            // Split injury description into words and make them unique
            $injuryWords = array_unique(explode(' ', $injuryDescription));
    
            // Find the number of matching words
            $wordMatches = count(array_intersect($userWords, $injuryWords));
    
            // Update the most matching injury if this one has more word matches
            if ($wordMatches > $maxWordMatches) {
                $maxWordMatches = $wordMatches;
                $mostMatchingInjury = $injury;
            }
        }
    
        return $mostMatchingInjury;
    }
}
