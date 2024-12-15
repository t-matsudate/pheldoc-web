<?php

namespace App\Http\Controllers;

use App\Enums\RegistrationStatus;
use App\Exceptions\NotFoundException;
use App\Exceptions\NotLoggedInException;
use App\Exceptions\NotDraftOwnerException;
use App\Exceptions\UpdateFailureException;
use App\Http\Requests\PhelFunctionRegistrationRequest;
use App\Models\PhelFunction;
use App\Models\PhelNamespace;
use App\Models\RegistrationRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PhelFunctionController extends Controller
{
    /**
     * Shows a Phel's function.
     *
     * @param string $namespace One of Phel's namespace.
     * @param string $name One of Phel's function name.
     * @throws NotFoundException When either specified namespace or specified name didn't find.
     * @return View When both of specified namespace and specified name found.
     */
    public function show(string $namespace, string $name): View
    {
        $phel_namespace = PhelNamespace::where('namespace', '=', $namespace)->first();

        if (is_null($phel_namespace)) {
            throw new NotFoundException("function.show", $namespace);
        }

        $function = PhelFunction::where(['phel_namespace_id' => $phel_namespace->id, 'name' => $name])->first();

        if (is_null($function)) {
            throw new NotFoundException("function.show", $name);
        }

        return view('function.show', ['function' => $function]);
    }

    /**
     * Shows the registration form for a draft of a Phel's function.
     *
     * @param Request $request Currently this is received just in case.
     * @return View When requesing user has already logged in.
     */
    public function createDraft(Request $request): View
    {
        return view('function.draft.create');
    }

    /**
     * Registers a Phel function as a draft.
     *
     * @param PhelFunctionRegistrationRequest $request Checks whether requested draft satisfies all rules of form fields.
     * @return RedirectResponse A response to redirect to the page to show registered draft. This is returned when its request satisfied following things:
     *                          <ul>
     *                          <li>Requesting user has already logged in.</li>
     *                          <li>Its request contained both of namespace, name and symbol_type at least.</li>
     *                          </ul>
     */
    public function storeDraft(PhelFunctionRegistrationRequest $request): RedirectResponse
    {
        $validated = $request->safe();
        $draft = RegistrationRequest::create([
            'user_id' => $request->user()->id,
            'phelNamespace' => $validated->phelNamespace,
            'name' => $validated->name,
            'symbol_type' => $validated->symbol_type,
            'description' => $validated->description,
            'status' => RegistrationStatus::Requested,
        ]);

        return redirect(route('function.draft.show', ['id' => $draft->id]));
    }

    /**
     * Shows a draft of a Phel's function.
     *
     * @param string $id The ID of its draft.
     * @throws NotFoundException When requested draft didn't find.
     * @return View When requested draft found.
     */
    public function showDraft(string $id): View
    {

        $draft = RegistrationRequest::find(intval($id));

        if (is_null($draft)) {
            throw new NotFoundException("function.draft.show", $id);
        }

        return view('function.draft.show', ['draft' => $draft]);
    }

    /**
     * Shows the edit form for a draft of a Phel's function.
     *
     * @param Request $request Checks whether requesting user is the owner of its draft.
     * @param string $id The ID of its draft.
     * @throws NotDraftOwnerException When requesting user isn't the owner of its draft.
     * @throws NotFoundException When requested draft didn't find.
     * @return View The edit form for a draft of a Phel's function. This is returned when its request satisfied following things:
     *              <ul>
     *              <li>Requesting user has already logged in.</li>
     *              <li>Requested draft found.</li>
     *              </ul>
     */
    public function editDraft(Request $request, string $id): View
    {
        $draft = RegistrationRequest::find(intval($id));

        if (is_null($draft)) {
            throw new NotFoundException("function.draft.edit", $id);
        }

        if ($request->user()->id !== $draft->user->id) {
            throw new NotDraftOwnerException("function.draft.edit", $request->user()->id, $id);
        }

        return view('function.draft.edit', ['draft' => $draft]);
    }

    /**
     * Updates a Phel function as a draft.
     *
     * @param PhelFunctionRegistrationRequest $request Checks whether requested draft satisfies all rules of form fields.
     * @param string $id The ID of its draft.
     * @throws NotDraftOwnerException When requesting user isn't the owner of its draft. 
     * @throws NotFoundException When requested draft didn't find.
     * @throws UpdateFailureException When server couldn't update its draft by some cause.
     * @return RedirectResponse A response to redirect to the page to show registered draft. This is returned when its request satisfied following things:
     *                          <ul>
     *                          <li>Requesting user has already logged in.</li>
     *                          <li>Its request contained both of namespace, name and symbol_type at least.</li>
     *                          </ul>
     */
    public function updateDraft(PhelFunctionRegistrationRequest $request, string $id): RedirectResponse
    {
        $draft = RegistrationRequest::find(intval($id));

        if (is_null($draft)) {
            throw new NotFoundException('function.draft.update', $id);
        }

        if ($request->user()->id !== $draft->user->id) {
            throw new NotDraftOwnerException("function.draft.update", $request->user()->id, $id);
        }

        if ($draft->update($request->safe()->all())) {
            return redirect(route('function.draft.show', ['id' => $id]));
        } else {
            throw new UpdateFailureException('function.draft.update', $id);
        }
    }
}
