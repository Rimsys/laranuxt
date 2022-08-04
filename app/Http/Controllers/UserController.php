<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $this->has_err = !$user->update($request->validated());

        if ($this->has_err) {
            $this->message = 'Personal info could not be updated, please trg again';
        } else {
            $this->data['user'] = $user;
        }

        return $this->sendResponse();
    }

    public function getPersonalInfo()
    {
        $user = User::find(request()->user()->id);

        if ($user) {
            $this->has_err = false;
            $this->data['personal_info'] = $user;
        } else {
            $this->message = 'Personal info could not be retrieved, please trg again';

        }

        return $this->sendResponse();
    }

}
