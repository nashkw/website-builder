<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class AccountController extends Controller
{
    /**
     * Display the user's account form.
     */
    public function edit(Request $request): Response
    {
        $subdomain = User::find($request->user()->id)->property->website->subdomain;
        return Inertia::render('Account/Account', ['subdomain' => $subdomain]);
    }

    /**
     * Update the user's account information.
     */
    public function update(AccountUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());
        $request->user()->save();

        return Redirect::route('account');
    }

    /**
     * Update the user's subdomain information.
     */
    public function subdomain(Request $request): RedirectResponse
    {
        $request->validate([ 'subdomain' => [
            'required',
            'string',
            'lowercase',
            'alpha_dash',
            Rule::unique('websites')->ignore(User::find($request->user()->id)->property->id, 'property_id'),
        ]]);

        $website = User::find($request->user()->id)->property->website;
        $website->fill($request->all());
        $website->save();

        return Redirect::route('account');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
