<?php
/**
 * Generator books.json dari link Google Drive
 * Jalankan sekali: php tools/build-books-json.php
 */

require_once dirname(__DIR__) . '/config.php';

$driveLinks = [
    'https://drive.google.com/file/d/1bb4-V_rTZo-CmKl5L05mCSqcsMuOxikD/view?usp=drive_link',
    'https://drive.google.com/file/d/1qef0dehAbnAsmEiqWSAHdZrLwnDgXMcb/view?usp=drive_link',
    'https://drive.google.com/file/d/14oYoZJzunwSRrVpmMJ4CWbXRGUfAkCmT/view?usp=drive_link',
    'https://drive.google.com/file/d/1lfhKRhRIymTA5qTSRcmXnG461_uVx86u/view?usp=drive_link',
    'https://drive.google.com/file/d/1ApeLo6CJ87FxDd2b2q-3Flb4ws6-SH1i/view?usp=drive_link',
    'https://drive.google.com/file/d/1aKzGRl2gNNHLmyW9bFTKxV_Rm6905DWA/view?usp=drive_link',
    'https://drive.google.com/file/d/19nrifdjbXXUceVCo705ew5ZHQ1O82suZ/view?usp=drive_link',
    'https://drive.google.com/file/d/1kl7-Y6a7CwoJk6TQ93vRy3C86mLvBZ_9/view?usp=drive_link',
    'https://drive.google.com/file/d/1SvDlUUNtCXD8kLMd-xGc50i0zuYuiwOE/view?usp=drive_link',
    'https://drive.google.com/file/d/1PL15GbmEXzdrNczYSptGNYFY0uP1cOHf/view?usp=drive_link',
    'https://drive.google.com/file/d/10wdJX5M_QA9S9RrLzQM8mUP_IBNtDleA/view?usp=drive_link',
    'https://drive.google.com/file/d/1gqm1XgFcUAO170IH9lk5tp9kxZSPQz8g/view?usp=drive_link',
    'https://drive.google.com/file/d/1jXTMlmEwEyAUXWxc1DSxLex0Y0d-I11A/view?usp=drive_link',
    'https://drive.google.com/file/d/1pU0qoJizbXfvR2Ety-HBvzjYDWx9za1O/view?usp=drive_link',
    'https://drive.google.com/file/d/1EjX3iW33RHQK5mD4XxO5ZV5i5EFs3YZ6/view?usp=drive_link',
    'https://drive.google.com/file/d/1rEZWU58Z2YoIUbbarYXvTku-bnQK6IUO/view?usp=drive_link',
    'https://drive.google.com/file/d/1a-dZ2jGZ_mfYgiYL4dqRBjTukvkcATEU/view?usp=drive_link',
    'https://drive.google.com/file/d/1sQUBa4N4qcf97UM3SfqrgTlfHDYzNcy5/view?usp=drive_link',
    'https://drive.google.com/file/d/1xjZWbf57aLFKFHgcBeqX6JS6KPs6xDk0/view?usp=drive_link',
    'https://drive.google.com/file/d/1w2yZOSoJkXUx3E-P5rPkfIERlnfnA8G-/view?usp=drive_link',
    'https://drive.google.com/file/d/1VbeCQs8wvzH1ijbGMWZx0iZ7JglckW4D/view?usp=drive_link',
    'https://drive.google.com/file/d/12Eo0EycTFBLAU6JUwgi-E0Kqi4XuIW4S/view?usp=drive_link',
    'https://drive.google.com/file/d/1YZrcxvpGBElHTrB2j8tXjBNithsGg9ae/view?usp=drive_link',
    'https://drive.google.com/file/d/1nm56lktr1eNhdgz_ibi571uH9X3FtwOI/view?usp=drive_link',
    'https://drive.google.com/file/d/1hfwXZc2DPgvpG9ONjB-QGiAgMInMxAef/view?usp=drive_link',
    'https://drive.google.com/file/d/1YaTm50DXC4FLXPDMp1ncKr6I5IYesHU2/view?usp=drive_link',
    'https://drive.google.com/file/d/1g6gONXFeW9qpMZlj4CeiuEyI_WnZcoss/view?usp=drive_link',
    'https://drive.google.com/file/d/1OxfT73Gkhhci3N3dKEHNMuYFzNsgRbpX/view?usp=drive_link',
    'https://drive.google.com/file/d/1KYWEV5do1p9La9kgvqlRXLCNQ6rE8BVA/view?usp=drive_link',
    'https://drive.google.com/file/d/17zFlApgn9f6W1oHnk6HRyiMzXoFURsS3/view?usp=drive_link',
    'https://drive.google.com/file/d/1NLW55-2cFYwo3dJV0ikeGXFy8HdVRH1E/view?usp=drive_link',
    'https://drive.google.com/file/d/16hsTRKR7SnTOZkuudXy1mhhwZQucyawg/view?usp=drive_link',
    'https://drive.google.com/file/d/1oMGR-xClc0URRnShXPpzUecNMefb3wgE/view?usp=drive_link',
    'https://drive.google.com/file/d/1xVbIwwLrAwRynza8zUM6WrkfSSSsg61S/view?usp=drive_link',
    'https://drive.google.com/file/d/1PwIwdWxr5p0_Wr9LC7j8oINpRN2Tnu6d/view?usp=drive_link',
    'https://drive.google.com/file/d/15dptvrrww8iqdnwoOsKVc1ixYq7RZmrx/view?usp=drive_link',
    'https://drive.google.com/file/d/1iIbMpzo1MAQbVYFs5FFTpR1Gg2t213lO/view?usp=drive_link',
    'https://drive.google.com/file/d/1PnhmpKv6LSDPwT6ztaSlLqaFxSbXhqj2/view?usp=drive_link',
    'https://drive.google.com/file/d/1NJwXy_Pk_NUwn3q7gYTFA9zLWYyUZD3t/view?usp=drive_link',
];

function extractDriveId(string $url): ?string
{
    if (preg_match('#/d/([^/]+)/#', $url, $m)) {
        return $m[1];
    }
    return null;
}

function fetchDriveFilename(string $driveId): string
{
    $url = 'https://drive.google.com/file/d/' . $driveId . '/view';
    $ctx = stream_context_create([
        'http' => [
            'timeout' => 15,
            'header' => "User-Agent: Mozilla/5.0\r\n",
        ],
    ]);
    $html = @file_get_contents($url, false, $ctx);
    if ($html === false) {
        return 'Buku ' . substr($driveId, 0, 8) . '.pdf';
    }

    if (preg_match('/<meta\s+property="og:title"\s+content="([^"]+)"/i', $html, $m)) {
        return html_entity_decode($m[1], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }
    if (preg_match('/<title>([^<]+)<\/title>/i', $html, $m)) {
        $title = trim(str_replace(' - Google Drive', '', html_entity_decode($m[1], ENT_QUOTES | ENT_HTML5, 'UTF-8')));
        return $title ?: 'Buku.pdf';
    }

    return 'Buku ' . substr($driveId, 0, 8) . '.pdf';
}

$books = [];
$usedIds = [];

foreach ($driveLinks as $link) {
    $driveId = extractDriveId($link);
    if (!$driveId) {
        continue;
    }

    echo "Fetching: $driveId ... ";
    $filename = fetchDriveFilename($driveId);
    echo $filename . "\n";

    $parsed = parsePdfFilename($filename);
    $category = detectCategory($parsed['title'], $filename);
    $slug = makeBookId($filename);

    if (isset($usedIds[$slug])) {
        $slug .= '-' . substr($driveId, 0, 6);
    }
    $usedIds[$slug] = true;

    $books[] = [
        'id' => $slug,
        'id_drive' => $driveId,
        'title' => $parsed['title'],
        'author' => $parsed['author'],
        'category' => $category,
        'description' => 'E-book PDF dari Google Drive — kategori ' . $category . '.',
    ];
}

usort($books, function ($a, $b) {
    $catOrder = array_flip(CATEGORY_ORDER);
    $catA = $catOrder[$a['category']] ?? 99;
    $catB = $catOrder[$b['category']] ?? 99;
    if ($catA !== $catB) {
        return $catA <=> $catB;
    }
    return strcasecmp($a['title'], $b['title']);
});

$jsonPath = dirname(__DIR__) . '/data/books.json';
file_put_contents($jsonPath, json_encode($books, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\n");

echo "\nSelesai: " . count($books) . " buku disimpan ke data/books.json\n";
