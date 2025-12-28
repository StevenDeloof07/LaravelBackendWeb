<?php

namespace App;

use Exception;
use Illuminate\Http\Request;

trait validateRequest
{
    /**
     * Used to validate a request
     * @param Request $request web Request to validate
     * @param array $validateParams parameters to validate and their rules
     * @return array Validated request
     */
    public function validateRequest($request, $validateParams, $exceptionMessage = "Niet alle waarden zijn correct ingevuld") {
        try {
            $validated = $request->validate($validateParams);
        } catch(Exception $e) {
            throw new Exception($exceptionMessage);
        }
        return $validated;
    }
}
