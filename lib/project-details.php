<?php

function resume_project_details()
{
    return [
        'Bicycle Renting System' => [
            'problem' => 'Students and users need a clearer way to check bicycle availability, submit rental information, and manage bookings without relying on manual records.',
            'role' => 'Full-stack student developer responsible for interface design, form flow, and database-backed rental records.',
            'technologies' => ['PHP', 'MySQL', 'Bootstrap', 'HTML', 'CSS'],
            'features' => [
                'Bicycle listing and rental request flow',
                'User-friendly booking form structure',
                'Database storage for rental information',
                'Responsive pages for desktop and mobile users',
            ],
            'outcome' => 'Delivered a diploma final year project that demonstrates CRUD flow, form handling, and practical web application structure.',
        ],
        'District Office Web System' => [
            'problem' => 'Internal administrative users needed support maintaining web pages and improving usability for official district office workflows.',
            'role' => 'Intern web developer assisting with maintenance, UI improvements, troubleshooting, and responsive updates.',
            'technologies' => ['PHP', 'HTML', 'CSS', 'Bootstrap'],
            'features' => [
                'Internal web page maintenance',
                'Responsive interface improvements',
                'Issue checking and troubleshooting support',
                'Content and layout updates for official use',
            ],
            'outcome' => 'Gained real workplace exposure by supporting internal government web systems and collaborating with senior staff.',
        ],
        'UI/UX Redesign' => [
            'problem' => 'The original interface needed better visual hierarchy, clearer navigation, and improved readability for users.',
            'role' => 'UI/UX designer responsible for analyzing user flow, redesigning screens, and improving presentation quality.',
            'technologies' => ['Wireframing', 'Prototyping', 'UI Design', 'Usability Review'],
            'features' => [
                'Improved page layout and spacing',
                'Clearer visual hierarchy and call-to-action placement',
                'More consistent colors and component styling',
                'User-centered screen flow improvements',
            ],
            'outcome' => 'Produced a cleaner interface concept that improved usability, structure, and professional presentation.',
        ],
        'Register Form' => [
            'problem' => 'Users need a simple and clear registration interface that supports data entry with readable layout and basic validation.',
            'role' => 'Frontend developer building the registration form interface and validation-focused user experience.',
            'technologies' => ['HTML', 'CSS', 'JavaScript', 'Bootstrap'],
            'features' => [
                'Responsive registration form layout',
                'Input grouping for clearer data entry',
                'Basic client-side validation pattern',
                'Clean form styling for better readability',
            ],
            'outcome' => 'Created a practical authentication interface component that demonstrates frontend structure and user input handling.',
        ],
        'PharmaTrack' => [
            'problem' => 'Community pharmacies often manage patient health and medication records manually, causing scattered records and slower monitoring.',
            'role' => 'Laravel developer and QA tester responsible for feature implementation, interface support, testing, and UAT documentation.',
            'technologies' => ['Laravel 12', 'MySQL', 'Tailwind CSS', 'Face-API.js', 'OCR', 'Katalon'],
            'features' => [
                'Patient registration and profile management',
                'Medication tracking and health monitoring records',
                'AI-assisted recommendation concept',
                'Face recognition and OCR-supported workflow',
                'UAT test cases and quality validation',
            ],
            'outcome' => 'Achieved 100% pass rate across 26 UAT test cases with 8 respondents, showing successful validation of core workflows.',
        ],
    ];
}

function resume_project_detail_for($project)
{
    $title = is_array($project) ? ($project['title'] ?? '') : $project;
    $details = resume_project_details();
    $fallback = $details[$title] ?? [
        'problem' => 'This project addresses a practical software or interface requirement through structured development work.',
        'role' => 'Project contributor responsible for development, testing, and documentation support.',
        'technologies' => ['Web Development', 'UI/UX', 'Documentation'],
        'features' => ['Responsive interface', 'Structured project workflow', 'Clear user interaction flow'],
        'outcome' => 'Completed as part of portfolio development and practical software learning.',
    ];

    if (!is_array($project)) {
        return $fallback;
    }

    return [
        'problem' => trim((string)($project['problem'] ?? '')) ?: $fallback['problem'],
        'role' => trim((string)($project['role'] ?? '')) ?: $fallback['role'],
        'technologies' => resume_project_list_value($project['technologies'] ?? null, $fallback['technologies']),
        'features' => resume_project_list_value($project['features'] ?? null, $fallback['features']),
        'outcome' => trim((string)($project['outcome'] ?? '')) ?: $fallback['outcome'],
        'screenshots' => resume_project_list_value($project['screenshots'] ?? null, []),
    ];
}

function resume_project_list_value($value, array $fallback = [])
{
    if (is_array($value)) {
        $items = array_values(array_filter(array_map('trim', array_map('strval', $value))));
        return $items ?: $fallback;
    }

    if (is_string($value) && trim($value) !== '') {
        $parts = preg_split('/\r\n|\r|\n|,/', $value);
        $items = array_values(array_filter(array_map('trim', $parts)));
        return $items ?: $fallback;
    }

    return $fallback;
}

/**
 * Human-readable caption from a screenshot filename, e.g.
 * "assets/img/.../2-pharmacist-dashboard.jpg" -> "Pharmacist dashboard".
 * Returns '' for auto-generated upload names (timestamps/hashes) that carry no meaning.
 */
function resume_screenshot_caption($path)
{
    $name = pathinfo((string)$path, PATHINFO_FILENAME);
    $name = preg_replace('/^\d+[-_ ]*/', '', $name);
    if ($name === '' || preg_match('/^[0-9a-f-]+$/i', $name)) {
        return '';
    }
    $caption = trim(preg_replace('/[-_]+/', ' ', $name));
    $caption = preg_replace_callback('/\b(ai|ui|ux|qa|uat|ocr|pdf|api)\b/i', fn($m) => strtoupper($m[1]), $caption);
    return ucfirst($caption);
}
