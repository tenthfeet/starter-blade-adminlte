<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Throwable;

class BusinessException extends Exception
{
    public function __construct($message = '', $code = 400, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function report()
    {
        return true;
    }

    public function render(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $message = $this->getMessage();

            return response()->json(['message' => $message], $this->getCode());
        }

        return false;
    }

    public static function throwIf(bool $condition, string $message, int $code = 400): void
    {
        if ($condition) {
            throw new static($message, $code);
        }
    }

    public static function throwUnless(bool $condition, string $message, int $code = 400): void
    {
        if (! $condition) {
            throw new static($message, $code);
        }
    }

    public static function withMessage(string $message, int $code = 400): self
    {
        return new static($message, $code);
    }

    public static function denied(string $message = 'This action is unauthorized.'): self
    {
        return new static($message, 403);
    }

    public static function invalid(string $message): self
    {
        return new static($message, 422);
    }
}
