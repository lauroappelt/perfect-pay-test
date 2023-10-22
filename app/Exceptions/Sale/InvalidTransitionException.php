<?php

namespace App\Exceptions\Sale;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InvalidTransitionException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request): Response
    {
        return response(['success' => false, 'error' => $this->getMessage()], 400);
    }
}
