<?php

function resume_content_path()
{
    return __DIR__ . '/../data/content.json';
}

function resume_default_content()
{
    return [
        'profile' => [
            'name' => 'Nurul Syakirah',
            'headline' => 'Software Engineering Student & Web Developer',
            'typed_items' => 'Web Developer, QA Analyst, Software Engineering Student',
            'background_image' => 'assets/img/bg1.png',
            'profile_image' => 'assets/img/profile1.jpg',
            'facebook' => 'https://www.facebook.com/share/1FxBo2mosS/?mibextid=wwXIfr',
            'instagram' => 'https://www.instagram.com/sykirahs',
            'linkedin' => 'https://www.linkedin.com/in/nurul-syakirah-b553072a6?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app',
        ],
        'about' => [
            'intro' => 'I am Nurul Syakirah, a Software Engineering student focused on building practical, reliable, and user-friendly web applications. My experience includes academic software projects, QA testing, UI improvements, and internship exposure in government and corporate environments. I am seeking opportunities to contribute to professional technology teams while continuing to strengthen my engineering and problem-solving skills.',
            'tagline' => 'Web development and QA-focused software engineering candidate with strong interest in dependable systems, clear user experiences, and collaborative delivery.',
            'birthday' => '1 October 2003',
            'website' => 'http://d09097.schtg.com/',
            'phone' => '012-5764231',
            'city' => 'Seri Iskandar, Perak, Malaysia',
            'age' => '21',
            'degree' => "Bachelor's in Software Engineering",
            'email' => 'Syakirahnurul438@gmail.com',
            'freelance' => 'available',
            'details' => 'Completed internship experience at Pejabat Daerah Perak Tengah and Synergy Alliance Sdn. Bhd., contributing to internal systems, application testing, responsive interfaces, and project documentation.',
        ],
        'skills' => [
            ['id' => 1, 'name' => 'HTML', 'percentage' => 100],
            ['id' => 2, 'name' => 'CSS', 'percentage' => 90],
            ['id' => 3, 'name' => 'JavaScript', 'percentage' => 50],
            ['id' => 4, 'name' => 'PHP', 'percentage' => 80],
            ['id' => 5, 'name' => 'WordPress/CMS', 'percentage' => 70],
            ['id' => 6, 'name' => 'Photoshop', 'percentage' => 55],
        ],
        'highlights' => [
            ['icon' => 'bi-code-slash', 'title' => 'Web Development', 'description' => 'Experience building PHP, Laravel, JavaScript, and database-backed web systems.'],
            ['icon' => 'bi-bug', 'title' => 'QA Testing', 'description' => 'Hands-on application testing experience using Katalon and structured UAT workflows.'],
            ['icon' => 'bi-check2-circle', 'title' => 'Project Delivery', 'description' => 'Completed academic and internship projects with documentation, UI work, and testing support.'],
            ['icon' => 'bi-people', 'title' => 'Team Ready', 'description' => 'Prepared to contribute in structured teams with clear communication and continuous learning.'],
        ],
        'tech_stack' => ['HTML', 'CSS', 'JavaScript', 'PHP', 'Laravel', 'MySQL', 'Bootstrap', 'Tailwind CSS', 'Katalon', 'Git', 'UI/UX', 'Documentation'],
        'cta' => [
            'label' => 'Open To Opportunities',
            'title' => 'Available for graduate trainee, junior developer, and QA analyst roles.',
            'text' => 'I am ready to contribute to professional software teams through web development, testing, documentation, and continuous improvement.',
        ],
        'resume' => [
            'intro' => 'Software Engineering candidate with hands-on experience in web development, QA testing, UI implementation, and database-backed systems. Prepared to contribute in structured, professional software teams.',
            'summary_name' => 'Nurul Syakirah Binti Sobberi',
            'summary_text' => 'Motivated and detail-oriented Software Engineering student with experience developing web-based systems, validating application quality, and improving user interfaces. Comfortable working with requirements, testing workflows, documentation, and modern web technologies.',
            'summary_location' => 'Seri Iskandar, Perak',
            'summary_phone' => '(60) 12-5764231',
            'summary_website' => 'http://d09097.schtg.com/',
            'education' => [
                ['id' => 1, 'title' => 'Bachelor of Software Engineering (Hons.)', 'period' => '2021 - 2023', 'institution' => 'Universiti Pendidikan Sultan Idris, Tanjung Malim, Perak', 'description' => 'Focusing on software development, web application engineering, UI/UX design, and system analysis. Currently developing a multimedia learning platform as a final year project.'],
                ['id' => 2, 'title' => 'Diploma in Computer Science', 'period' => '2021-2023', 'institution' => 'Universiti Pendidikan Sultan Idris, Tanjung Malim, Perak', 'description' => 'Focusing on learning in basic develop website.'],
            ],
            'experience' => [
                ['id' => 1, 'title' => 'Internship - Web Developer', 'period' => 'June 2023 - August 2023', 'institution' => 'Pejabat Daerah Perak Tengah', 'description' => "Assisted in maintaining and enhancing internal web systems for district administration.\nCollaborated with senior developers to troubleshoot and resolve software issues.\nParticipated in UI improvements and responsive design updates for official portals."],
                ['id' => 2, 'title' => 'Final Year Project - Bicycle Rental website', 'period' => '2017 - 2018', 'institution' => 'Universiti Pendidikan Sultan Idris, Tanjung Malim, Perak', 'description' => "Designing UI using modern frameworks and ensuring accessibility across devices.\nConducting user testing and performance optimization for enhanced usability."],
            ],
        ],
        'portfolio' => [
            'intro' => 'Selected projects showing practical experience in web application development, UI/UX design, QA testing, and system documentation. Each item reflects applied coursework, internship tasks, or independent software delivery.',
            'items' => [
                ['id' => 1, 'title' => 'Bicycle Renting System', 'category' => 'Projects', 'description' => 'Final Year Project', 'image' => 'assets/img/masonry-portfolio/masonry-portfolio-1.png', 'link' => '#'],
                ['id' => 2, 'title' => 'District Office Web System', 'category' => 'Internship', 'description' => 'Internship Project', 'image' => 'assets/img/masonry-portfolio/masonry-portfolio-2.png', 'link' => '#'],
                ['id' => 3, 'title' => 'UI/UX Redesign', 'category' => 'Assignments', 'description' => 'Class Project', 'image' => 'assets/img/masonry-portfolio/masonry-portfolio-3.jpg', 'link' => '#'],
                ['id' => 4, 'title' => 'Register Form', 'category' => 'Assignments', 'description' => 'Authentication System', 'image' => 'assets/img/masonry-portfolio/masonry-portfolio-6.png', 'link' => '#'],
            ],
        ],
    ];
}

function resume_get_content()
{
    static $content = null;

    if ($content !== null) {
        return $content;
    }

    $default = resume_default_content();
    $path = resume_content_path();

    if (!is_file($path)) {
        $content = $default;
        return $content;
    }

    $json = file_get_contents($path);
    $saved = json_decode($json, true);

    if (!is_array($saved)) {
        $content = $default;
        return $content;
    }

    $content = resume_merge_content($default, $saved);
    return $content;
}

function resume_is_list_array(array $array)
{
    if ($array === []) {
        return true;
    }

    return array_keys($array) === range(0, count($array) - 1);
}

function resume_merge_content(array $default, array $saved)
{
    foreach ($saved as $key => $value) {
        if (is_array($value) && isset($default[$key]) && is_array($default[$key]) && !resume_is_list_array($value)) {
            $default[$key] = resume_merge_content($default[$key], $value);
        } else {
            $default[$key] = $value;
        }
    }

    return $default;
}

function resume_save_content(array $content)
{
    $path = resume_content_path();
    $dir = dirname($path);

    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }

    return file_put_contents($path, json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), LOCK_EX) !== false;
}

function resume_next_id(array $items)
{
    $max = 0;
    foreach ($items as $item) {
        $max = max($max, (int)($item['id'] ?? 0));
    }

    return $max + 1;
}

function h($value)
{
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function resume_filter_class($category)
{
    $category = strtolower((string)$category);

    if ($category === 'projects') {
        return 'filter-app';
    }

    if ($category === 'internship') {
        return 'filter-product';
    }

    if ($category === 'assignments') {
        return 'filter-branding';
    }

    return '';
}
