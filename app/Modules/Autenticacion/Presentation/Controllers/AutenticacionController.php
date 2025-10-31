<?php

namespace Modules\Autenticacion\Presentation\Controllers;

use Illuminate\Routing\Controller;
use Modules\Autenticacion\Application\DTOs\LoginDTO;
use Modules\Autenticacion\Application\Services\AutenticacionService;
use Modules\Autenticacion\Presentation\Requests\LoginRequest;
use Modules\Autenticacion\Presentation\Resources\LoginResource;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class AutenticacionController extends Controller
{
    private AutenticacionService $autenticacionService;

    public function __construct(AutenticacionService $autenticacionService)
    {
        $this->autenticacionService = $autenticacionService;
    }
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        $loginDTO = new LoginDTO(...$validated);

        $user = $this->autenticacionService->login($loginDTO);
        return new ApiResponseResource($user, LoginResource::class);
    }
}
