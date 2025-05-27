<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ApplicabilityService
{
    /**
     * Validate that only one of the relationship fields is present
     *
     * @param array $data
     * @return bool
     * @throws ValidationException
     */
    public function validateApplicability(array $data): bool
    {
        $validator = Validator::make($data, [
            'institution_id' => 'nullable|exists:institutions,id',
            'area_id' => 'nullable|exists:areas,id',
            'rol_id' => 'nullable|exists:rols,id',
            'position_id' => 'nullable|exists:positions,id',
            'worker_id' => 'nullable|exists:workers,id',
        ]);

        $validator->after(function ($validator) use ($data) {
            $fields = ['institution_id', 'area_id', 'rol_id', 'position_id', 'worker_id'];
            $filledFields = array_filter($fields, fn($field) => !empty($data[$field]));

            if (count($filledFields) > 1) {
                $validator->errors()->add(
                    'applicability',
                    'Only one of institution, area, role, position, or worker can be specified.'
                );
            }

            if (empty($filledFields)) {
                $validator->errors()->add(
                    'applicability',
                    'At least one of institution, area, role, position, or worker must be specified.'
                );
            }
        });

        $validator->validate();

        return true;
    }
}
