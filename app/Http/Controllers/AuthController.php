<?php

namespace App\Http\Controllers;

use App\Actions\IAuthAction;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends ApiBaseController
{
    public function __construct(protected IAuthAction $authAction)
    {
    }

    public function __invoke(LoginRequest $request): JsonResponse
    {
        $authUser = $this->authAction->handle($request);
        return $authUser ? $this->respondSuccess($authUser) : $this->respondError(errors: 'Unauthorized',message: 'Unauthorized', status: Response::HTTP_UNAUTHORIZED);
    }
}
