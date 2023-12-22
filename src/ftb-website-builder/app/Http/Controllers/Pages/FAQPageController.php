<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerServices;
use App\Http\Controllers\PropertyController;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class FAQPageController extends Controller
{
    /**
     * Display a preview of the generated site FAQ page.
     */
    public function preview(Request $request): Response
    {
        return Inertia::render(
            'GeneratedSite/FAQPreview',
            [
                'faq_page' => $this->getFAQPageData($request->user()->id),
                'property' => PropertyController::getPropertyData($request->user()->id),
            ]
        );
    }

    /**
     * Display the edit subpage for the generated site FAQ page.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render(
            'EditContent/EditFAQ',
            $this->getFAQPageData($request->user()->id)
        );
    }

    /**
     * Update the user's generated site FAQ page information.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'faq_page_section_header' => ['required', 'string', 'max:255'],
            'faq_page_section_paragraph' => ['required', 'string', 'max:65535'],
            'faq_page_section_image' => ['nullable', 'image'],
            'remove_faq_page_section_image' => ['required', 'boolean'],
        ]);

        $faqPage = User::find($request->user()->id)->property->faqPage;
        $data = $request->all();

        $data = ControllerServices::uploadImage(
            $request,
            'faq_page_section_image',
            'remove_faq_page_section_image',
            'images/sectionImages/faqPrimary/',
            $faqPage,
            $data
        );

        $faqPage->fill($data);
        $faqPage->save();

        return Redirect::route('edit.faq');
    }

    private function getFAQPageData(int $userID): array
    {
        $faqPage = User::find($userID)->property->faqPage;
        $data = $faqPage->toArray();

        $questionAndAnswers = [];
        foreach ($faqPage->questionAndAnswers as $questionAndAnswer) {
            $questionAndAnswers[] = $questionAndAnswer->toArray();
        }
        $data['question_and_answers'] = $questionAndAnswers;

        $data['faq_page_section_image'] = ControllerServices::getImageIfExists($data['faq_page_section_image']);

        return $data;
    }
}
