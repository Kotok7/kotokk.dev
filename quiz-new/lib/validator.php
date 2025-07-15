<?php
function validate_quiz(array $q): array {
    $e = [];

    if (empty($q['title'])) {
        $e[] = 'Title required';
    }
    if (empty($q['author'])) {
        $e[] = 'Author required';
    }
    if (empty($q['questions']) || !is_array($q['questions'])) {
        $e[] = 'At least one question';
    }

    foreach ($q['questions'] as $i => $Q) {
        $type = $Q['type'] ?? 'single';
        if ($type === 'text') {
            $type = 'short';
        }

        if (empty($Q['question'])) {
            $e[] = "Question #{$i} text missing";
            continue;
        }

        if (in_array($type, ['single', 'multiple'], true)) {
            if (empty($Q['options']) || count($Q['options']) < 2) {
                $e[] = "Question #{$i} needs ≥2 options";
            }
        }

        switch ($type) {
            case 'single':
                if (!isset($Q['answer']) || !is_int($Q['answer'])
                    || $Q['answer'] < 0 || $Q['answer'] >= count($Q['options'])
                ) {
                    $e[] = "Question #{$i} invalid answer index";
                }
                break;

            case 'multiple':
                if (empty($Q['answer']) || !is_array($Q['answer'])) {
                    $e[] = "Question #{$i} needs at least one correct answer";
                } else {
                    foreach ($Q['answer'] as $ans) {
                        if (!is_int($ans) || $ans < 0 || $ans >= count($Q['options'])) {
                            $e[] = "Question #{$i} has invalid answer index {$ans}";
                        }
                    }
                }
                break;

            case 'boolean':
                if (!isset($Q['answer']) || !is_bool($Q['answer'])) {
                    $e[] = "Question #{$i} invalid boolean answer";
                }
                break;

            case 'short':
                if (!isset($Q['answer']) || $Q['answer'] === '') {
                    $e[] = "Question #{$i} needs a text answer";
                }
                break;

            default:
                $e[] = "Question #{$i} has unknown type '{$type}'";
        }
    }

    return $e;
}