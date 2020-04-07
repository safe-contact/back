<?php

namespace App\Exceptions;

use Exception;

class CovidException extends Exception
{

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()->json([
            'data' => [
                'status' => 'error',
                'error' => $this->getMessage(),
            ]
        ], 400);
    }
}
