<?php

namespace App\Exceptions\Costomer;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DuplicateCostomerException extends Exception
{
    /**
     * Report the exception.
     */
    public function report(): void
    {
        // ...
    }
 
    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request): Response
    {
        return response(['success' => false, 'error' => $this->getMessage()], 422);
    }
}
