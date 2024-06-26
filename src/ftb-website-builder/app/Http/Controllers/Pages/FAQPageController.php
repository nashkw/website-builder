<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerServices;
use App\Http\Controllers\PageFlagsController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\WebsiteController;
use App\Http\Requests\PageCreation\FAQPageCreationRequest;
use App\Http\Requests\PageUpdates\FAQPageUpdateRequest;
use App\Models\FAQPage\FAQPage;
use App\Models\FAQPage\QuestionAndAnswer;
use App\Models\User;
use App\Models\Website;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class FAQPageController extends Controller
{
    /**
     * Display the generated site FAQ page.
     */
    public function display(Request $request): Response|RedirectResponse
    {
        $subdomain = $request->route()->parameters()['subdomain'];
        $website = Website::firstWhere('subdomain', $subdomain);
        if (!$website) {
            return Redirect::route('landing');
        } else if ($website->preview_only) {
            return Redirect::route('preview.faq');
        }

        $user = $website->property->user_id;
        $page_flags = PageFlagsController::getPageFlagsData($user);
        if ($page_flags['has_faq_page']) {
            return Inertia::render(
                'GeneratedSite/GenerateFAQ',
                [
                    'faq_page' => $this->getFAQPageData($user),
                    'property' => PropertyController::getPropertyData($user),
                    'website' => WebsiteController::getWebsiteData($user),
                    'page_flags' => $page_flags,
                    'routes' => ControllerServices::getRoutes('website', ['subdomain' => $subdomain]),
                    'isPreview' => false,
                ]
            );
        } else {
            return Redirect::route('website', ['subdomain' => $website->subdomain]);
        }
    }

    /**
     * Display a preview of the generated site FAQ page.
     */
    public function preview(Request $request): Response|RedirectResponse
    {
        $website = User::find($request->user()->id)->property->website;
        if (!$website->preview_only) {
            return Redirect::route('website.faq', ['subdomain' => $website->subdomain]);
        }

        $page_flags = PageFlagsController::getPageFlagsData($request->user()->id);
        if ($page_flags['has_faq_page']) {
            return Inertia::render(
                'GeneratedSite/GenerateFAQ',
                [
                    'faq_page' => $this->getFAQPageData($request->user()->id),
                    'property' => PropertyController::getPropertyData($request->user()->id),
                    'website' => WebsiteController::getWebsiteData($request->user()->id),
                    'page_flags' => $page_flags,
                    'routes' => ControllerServices::getRoutes('preview'),
                    'isPreview' => true,
                ]
            );
        } else {
            return Redirect::route('preview');
        }
    }

    /**
     * Display the edit subpage for the generated site FAQ page.
     */
    public function edit(Request $request): Response|RedirectResponse
    {
        $page_flags = PageFlagsController::getPageFlagsData($request->user()->id);

        if ($page_flags['has_faq_page']) {
            return Inertia::render(
                'EditContent/EditFAQ',
                $this->getFAQPageData($request->user()->id)
            );
        } else {
            return Redirect::route('add.faq');
        }
    }

    /**
     * Display the add subpage for the generated site FAQ page.
     */
    public function add(Request $request): Response|RedirectResponse
    {
        $page_flags = PageFlagsController::getPageFlagsData($request->user()->id);

        if ($page_flags['has_faq_page']) {
            return Redirect::route('edit.faq');
        } else {
            return Inertia::render('AddContent/AddFAQ');
        }
    }

    /**
     * Create the user's generated site FAQ page information.
     */
    public function create(FAQPageCreationRequest $request): RedirectResponse
    {
        $request->validated();

        $property = User::find($request->user()->id)->property;
        $imagePath = 'images/' . $property->id . '/';
        $faqPage = new FAQPage;
        $faqPage->property_id = $property->id;
        $data = $request->all();

        $data = ControllerServices::uploadImage(
            $request,
            'faq_page_section_image',
            'remove_faq_page_section_image',
            $imagePath,
            $faqPage,
            $data
        );

        if (array_key_exists('questions_and_answers', $data)) {
            foreach ($data['questions_and_answers'] as $questionAndAnswer) {
                $newQuestionAndAnswer = new QuestionAndAnswer;
                $newQuestionAndAnswer->property_id = $property->id;
                $newQuestionAndAnswer->fill($questionAndAnswer);
                $newQuestionAndAnswer->save();
            }
        }
        unset($data['questions_and_answers']);

        $faqPage->fill($data);
        $faqPage->save();

        $pageFlags = $property->pageFlags;
        $pageFlags->has_faq_page = true;
        $pageFlags->save();

        return Redirect::route('add');
    }

    /**
     * Update the user's generated site FAQ page information.
     */
    public function update(FAQPageUpdateRequest $request): RedirectResponse
    {
        $request->validated();

        $imagePath = 'images/' . User::find($request->user()->id)->property->id . '/';
        $faqPage = User::find($request->user()->id)->property->faqPage;
        $data = $request->all();

        $data = ControllerServices::uploadImage(
            $request,
            'faq_page_section_image',
            'remove_faq_page_section_image',
            $imagePath,
            $faqPage,
            $data
        );

        if (array_key_exists('questions_and_answers_to_remove', $data)) {
            foreach ($data['questions_and_answers_to_remove'] as $questionAndAnswerID) {
                QuestionAndAnswer::find($questionAndAnswerID)->delete();
            }
        }
        unset($data['questions_and_answers_to_remove']);

        if (array_key_exists('questions_and_answers', $data)) {
            foreach ($data['questions_and_answers'] as $questionAndAnswer) {
                if ($questionAndAnswer['id']) {
                    $existingQuestionAndAnswer = QuestionAndAnswer::find($questionAndAnswer['id']);
                } else {
                    $existingQuestionAndAnswer = new QuestionAndAnswer;
                    $existingQuestionAndAnswer->property_id = $faqPage->property_id;
                }

                unset($questionAndAnswer['id']);
                unset($questionAndAnswer['property_id']);

                $existingQuestionAndAnswer->fill($questionAndAnswer);
                $existingQuestionAndAnswer->save();
            }
        }
        unset($data['questions_and_answers']);

        $faqPage->fill($data);
        $faqPage->save();

        return Redirect::route('edit.faq');
    }

    public static function getFAQPageData(int $userID, bool $getURL = true): array
    {
        $faqPage = User::find($userID)->property->faqPage;
        $data = $faqPage->toArray();

        $questionsAndAnswers = [];
        foreach ($faqPage->questionsAndAnswers as $questionAndAnswer) {
            $questionsAndAnswers[] = $questionAndAnswer->toArray();
        }
        $data['questions_and_answers'] = $questionsAndAnswers;

        $data['faq_page_section_image'] = ControllerServices::getImageIfExists($data['faq_page_section_image'], $getURL);

        return $data;
    }
}
