<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

require __DIR__ . '/../lib/utils.php';
require __DIR__ . '/../lib/validator.php';

header('Content-Type: application/json');

$in = json_decode(file_get_contents('php://input'), true);

$quiz = [
    'id'          => generate_uuid(),
    'title'       => sanitize($in['title'] ?? ''),
    'description' => sanitize($in['description'] ?? ''),
    'author'      => sanitize($in['author'] ?? ''),
    'created_at'  => date('c'),
    'tags'        => array_map('sanitize', $in['tags'] ?? []),
    'questions'   => []
];

foreach ($in['questions'] as $Q) {
    $type = $Q['type'] ?? 'single';
    if ($type === 'text') {
        $type = 'short';
    }

    $item = [
        'type'     => $type,
        'question' => sanitize($Q['question']),
        'options'  => [],
        'answer'   => null
    ];

    if (in_array($type, ['single', 'multiple'], true)) {
        foreach ($Q['options'] as $opt) {
            $item['options'][] = sanitize($opt);
        }
    }

    switch ($type) {
        case 'single':
            $item['answer'] = intval($Q['answer']);
            break;

        case 'multiple':
            if (is_string($Q['answer'])) {
                $parts = array_filter(explode(',', $Q['answer']), fn($x) => $x !== '');
                $item['answer'] = array_map('intval', $parts);
            } elseif (is_array($Q['answer'])) {
                $item['answer'] = array_map('intval', $Q['answer']);
            } else {
                $item['answer'] = [];
            }
            break;

        case 'boolean':
            $item['answer'] = filter_var($Q['answer'], FILTER_VALIDATE_BOOLEAN);
            break;

        case 'short':
            $item['answer'] = sanitize($Q['answer']);
            break;

        default:
            $item['answer'] = $Q['answer'];
    }

    $quiz['questions'][] = $item;
}

$errors = validate_quiz($quiz);
if ($errors) {
    http_response_code(400);
    echo json_encode(['status'=>'error', 'errors'=>$errors]);
    exit;
}

$all   = load_quizzes();
$all[] = $quiz;
save_quizzes($all);

echo json_encode(['status'=>'success', 'id'=>$quiz['id']]);