<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ValidationController extends Controller
{
    public function siteSettingsRules(): array
    {
        return [
            'site_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255',
            'phone' => 'sometimes|string|max:255',
            'international_phone' => 'nullable|string|max:255',
            'fax' => 'nullable|string|max:255',
            'address' => 'sometimes|string|max:255',
            'availability' => 'nullable|string|max:255',
            'indication' => 'sometimes|string',
        ];
    }

    public function socialLinksRules(): array
    {
        return [
            'links' => 'array',
            'links.*' => 'nullable|url:http,https',
        ];
    }

    public function pagesRules(?int $id = null, ?string $table_name = ''): array
    {
        $unique = $id ? '' : Rule::unique($table_name)->ignore($id);
        return [
            'name' => ['required', 'string', 'max:255', $unique],
            'menu_section' => 'sometimes|string',
            'content' => 'required|string',
        ];
    }

    public function dataRules(?string $table = ''): array
    {
        $rules = [
            'title' => 'sometimes|string|max:255',
            'introduction' => 'sometimes|string|max:500',
            'intro' => 'sometimes|string|max:500',
            'description' => 'nullable|string',
        ];

        if ($table == 'trips')
            $rules = array_merge(
                $rules,
                [
                    'duration' => 'nullable|string|max:255',
                    'pricing' => 'sometimes|string|max:255',
                    'travelers_limit' => 'nullable|integer|min:1',
                    'countries' => 'nullable|string|max:255',
                    'can_be_private' => 'nullable|integer|in:0,1',
                ]
            );
        return $rules;
    }

    public function dataMediaRules(): array
    {
        return [
            'data' => ['required', "array"],
            'files' => ['required', "array", "min:1"],
            'files.*' => ["required", "file", "mimes:jpg,png,jpeg,heic,pdf", "max:" . 1024 * 10],
        ];
    }

    public function regionTripsCountriesRules(): array
    {
        return [
            'datas' => 'required|array|min:1',
            'id' => 'required|integer',
        ];
    }

    public function tripRules(): array
    {
        return [
            'id' => 'required|integer',

            'highlights' => 'sometimes|array',
            'highlights.*.title' => 'sometimes|string|max:255',
            'highlights.*.text' => 'sometimes|string',

            'faqs' => 'sometimes|array',
            'faqs.*.question' => 'sometimes|string|max:255',
            'faqs.*.response' => 'sometimes|string',

            'dates' => 'sometimes|array',
            'dates.*.departure' => 'sometimes|date',
            'dates.*.return' => 'sometimes|date',
            'dates.*.notes' => 'nullable|string',
            'dates.*.year' => 'sometimes|date_format:Y',

            'overview' => 'sometimes|array',
            'overview.subtitle' => 'sometimes|string|max:255',
            'overview.intro' => 'sometimes|string',
        ];
    }

    public function modalFormRules(): array
    {
        return [
            'email' => ['sometimes', "email", "max:255"],
            'first_name' => ['sometimes', "string", "max:255"],
            'last_name' => ['sometimes', "string", "max:255"],
        ];
    }
}