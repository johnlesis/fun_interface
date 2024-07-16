<?php

namespace App\Http\ResponseTransformers;

use John\Fun\Core\Patient;

class RegisterPatientTransformer implements ResponseTransformer
{
    public function transform(Patient $patient): array
    {
        return [
            'name'      => $patient->getName(),
            'email'     => $patient->getEmail(),
            'ssn'       => $patient->getSsn()->toString(),
        ];
    }
}