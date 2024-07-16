<?php

namespace App\Http\Controllers;

use App\Http\ResponseTransformers\RegisterPatientTransformer;
use App\Repositories\SqlPatientRepository;
use Illuminate\Http\Request;
use John\Fun\Application\RegisterPatientRequest;
use John\Fun\Application\RegisterPatient;
use John\Fun\Application\PatientRepository;

use John\Fun\Core\SsnFactory;

class PatientController extends Controller
{
    
    public function register(Request $request, PatientRepository $patientRepo, RegisterPatient $registerPatientService, RegisterPatientTransformer $responseTransformer)
    {
        $jsonRequest = $request->input();
        
        $registerPatientRequest = new RegisterPatientRequest(
            $jsonRequest["name"],
            $jsonRequest["email"],
            $jsonRequest["ssnCountry"],
            $jsonRequest["ssnString"],
        );
        
        $patient =  $registerPatientService->handle($registerPatientRequest);
      
        return response()->json($responseTransformer->transform($patient));
    }
}
