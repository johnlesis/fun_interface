<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use John\Fun\Application\PatientRepository;
use John\Fun\Core\Ssn;
use John\Fun\Core\Patient;


class SqlPatientRepository implements PatientRepository
{
    public function patientExists(Ssn $ssn): bool
    {
        return DB::table('patients')->where('ssn', $ssn->toString())->count() > 0;
    }

    public function persistNewPatient(Patient $patient): bool
    {
        DB::table('patients')->insert([
            'name' => $patient->getName(),
            'email' => $patient->getEmail(),
            'ssn' => $patient->getSsn()->toString(),
            'ssn_country' => $patient->getSsn()->getCountry(),
        ]);

        return true;
    }
}