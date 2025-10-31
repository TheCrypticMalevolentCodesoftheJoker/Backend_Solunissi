<?php

namespace Modules\Autenticacion\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'      => ['required', 'string', 'email', 'regex:/^[\w._%+-]+@gmail\.com$/'],
            'contrasena' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo debe tener un formato válido.',
            'email.regex' => 'Solo se permiten correos @gmail.com.',
            'contrasena.required' => 'La contraseña es obligatoria.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = collect($validator->errors()->messages())
            ->map(function ($messages) {
                return $messages[0];
            })
            ->toArray();

        $messageDto = new MessageDTO(
            false,
            'Errores de validación',
            422,
            $errors
        );

        throw new HttpResponseException(
            (new ApiResponseResource($messageDto))->toResponse(request())
        );
    }
}
