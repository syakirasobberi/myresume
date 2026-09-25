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
            'headline' => 'Software Engineering Student & Web Developer.',
            'typed_items' => 'Student, Designer, Freelancer',
            'background_image' => 'assets/img/bg1.png',
            'profile_image' => 'assets/img/profile1.jpg',
            'facebook' => 'https://www.facebook.com/share/1FxBo2mosS/?mibextid=wwXIfr',
            'instagram' => 'https://www.instagram.com/sykirahs',
            'linkedin' => 'https://www.linkedin.com/in/nurul-syakirah-b553072a6?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app',
        ],
        'about' => [
            'intro' => 'I am Nurul Syakirah a final-year Software Engineering student with a passion for developing web-based systems and enhancing user experiences. My academic journey has been complemented by hands-on experience through coursework and an internship at Pejabat Daerah Perak Tengah. I enjoy exploring UI/UX design, system development, and multimedia learning principles, and I am always eager to learn new technologies and collaborate on innovative projects.',
            'tagline' => 'Passionate software engineering student with experience in building web-based applications. Enthusiastic about UI/UX design and system development.',
            'birthday' => '1 October 2003',
            'website' => 'http://d09097.schtg.com/',
            'phone' => '012-5764231',
            'city' => 'Seri Iskandar, Perak, Malaysia',
            'age' => '21',
            'degree' => "Bachelor's in Software Engineering",
            'email' => 'Syakirahnurul438@gmail.com',
            'freelance' => 'available',
            'details' => 'Completed internship at Pejabat Daerah Perak Tengah, where I assisted in developing and maintaining internal web systems. Currently developing a multimedia-based learning platform as part of my final year project.',
        ],
        'skills' => [
            ['id' => 1, 'name' => 'HTML', 'percentage' => 100],
            ['id' => 2, 'name' => 'CSS', 'percentage' => 90],
            ['id' => 3, 'name' => 'JavaScript', 'percentage' => 50],
            ['id' => 4, 'name' => 'PHP', 'percentage' => 80],
            ['id' => 5, 'name' => 'WordPress/CMS', 'percentage' => 70],
            ['id' => 6, 'name' => 'Photoshop', 'percentage' => 55],
        ],
        'resume' => [
            'intro' => 'Dedicated Software Engineering student with hands-on experience in full-stack web development, user-centered design, and multimedia-based systems. Passionate about building intuitive, effective digital solutions.',
            'summary_name' => 'Nurul Syakirah Binti Sobberi',
            'summary_text' => 'Motivated and detail-oriented Software Engineering student with experience in developing web-based systems and multimedia learning platforms. Capable of designing and implementing user-friendly applications using modern web technologies.',
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
            'intro' => 'This portfolio highlights my academic and personal projects in software engineering, including web applications, system development, and UI/UX design. Each project demonstrates my growth, creativity, and passion for building technology that matters.',
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
