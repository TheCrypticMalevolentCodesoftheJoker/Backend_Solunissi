<?php

namespace Modules\User\Presentation\Controllers;

use Illuminate\Routing\Controller;
use Modules\User\Application\Services\UserService;
use Modules\Shared\Presentation\Resources\ApiResponseResource;
use Modules\User\Application\DTOs\UserCreateDTO;
use Modules\User\Application\DTOs\UserUpdateDTO;
use Modules\User\Presentation\Requests\UserCreateRequest;
use Modules\User\Presentation\Requests\UserUpdateRequest;
use Modules\User\Presentation\Resources\UserDeatailResource;
use Modules\User\Presentation\Resources\UserListResource;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-//
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-//
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-//
    public function index()
    {
        $user = $this->userService->ListUsers();
        return new ApiResponseResource($user, UserListResource::class);
    }

    public function store(UserCreateRequest $request)
    {
        $validated = $request->validated();
        $userDTO = new UserCreateDTO(...$validated);
        $user = $this->userService->createUser($userDTO);
        return new ApiResponseResource($user, UserDeatailResource::class);
    }

    public function show(int $id)
    {
        $user = $this->userService->DetailUser($id);
        return new ApiResponseResource($user, UserDeatailResource::class);
    }

    public function update(UserUpdateRequest $request, int $id)
    {
        $validated = $request->validated();
        $userDTO = new UserUpdateDTO(...$validated);
        $user = $this->userService->UpdateUser($userDTO);
        return new ApiResponseResource($user, UserDeatailResource::class);
    }

    public function destroy($id)
    {
        $user = $this->userService->deleteUser($id);
        return new ApiResponseResource($user, UserDeatailResource::class);
    }
}
