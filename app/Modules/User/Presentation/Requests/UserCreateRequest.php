<?php

namespace Modules\User\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class UserCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre'     => 'required|max:50|string',
            'apellidos'  => 'required|max:50|string',
            'telefono'   => 'nullable|max:20|string|regex:/^\+\d{1,3}\d{6,14}$/',
            'email'      => 'required|string|email|max:100|unique:tbl_usuario,Email|regex:/^[\w._%+-]+@gmail\.com$/',
            'contrasena' => 'required|string|max:255|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
            'rolId'      => 'required|integer|exists:tbl_rol,RolID'
        ];
    }
    public function messages()
    {
        return [
            // Nombre
            'nombre.required'    => 'El nombre es obligatorio.',
            'nombre.max'         => 'El nombre no puede tener más de 50 caracteres.',
            'nombre.string'      => 'El nombre debe ser un texto válido.',

            // Apellidos
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'apellidos.max'      => 'Los apellidos no pueden tener más de 50 caracteres.',
            'apellidos.string'   => 'Los apellidos deben ser un texto válido.',

            // Teléfono
            'telefono.max'       => 'El teléfono no puede tener más de 20 caracteres.',
            'telefono.string'    => 'El teléfono debe ser un texto válido.',
            'telefono.regex'     => 'El teléfono debe tener formato internacional, por ejemplo +51987654321.',

            // Email
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.string'   => 'El correo electrónico debe ser un texto válido.',
            'email.email'    => 'El correo electrónico debe tener un formato válido.',
            'email.max'      => 'El correo electrónico no puede superar los 100 caracteres.',
            'email.unique'   => 'Este correo electrónico ya está registrado en el sistema.',
            'email.regex'    => 'El correo electrónico debe ser una cuenta de Gmail válida.',


            // Contraseña
            'contrasena.required' => 'La contraseña es obligatoria.',
            'contrasena.max'     => 'La contraseña no puede exceder 255 caracteres.',
            'contrasena.string'  => 'La contraseña debe ser un texto válido.',
            'contrasena.regex'   => 'La contraseña debe tener al menos una mayúscula, una minúscula, un número y un símbolo.',

            // Rol
            'rolId.required' => 'Debe seleccionar un rol para el usuario.',
            'rolId.integer'  => 'El rol seleccionado no es válido.',
            'rolId.exists'   => 'El rol seleccionado no existe en el sistema.',

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
