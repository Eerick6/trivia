<?php
require_once 'config/db.php';

class FacilModel {

    public function getQuestionsWithAnswers() {
        global $conn;

        // Consulta corregida: Seleccionar 3 preguntas aleatorias y todas sus respuestas
        $query = "
            SELECT q.id AS question_id, q.description, q.question, q.level, q.created_at, q.deleted_at,
                   a.id AS answer_id, a.answer, a.is_correct
            FROM questions q
            LEFT JOIN answers a ON q.id = a.question_id
            WHERE q.level = 'easy' 
              AND q.deleted_at IS NULL
              AND q.id IN (
                SELECT id FROM (
                  SELECT id 
                  FROM questions 
                  WHERE level = 'easy' AND deleted_at IS NULL 
                  ORDER BY RAND() 
                  LIMIT 3
                ) AS temp
              )
        ";

        if ($stmt = $conn->prepare($query)) {
            $stmt->execute();
            $result = $stmt->get_result();
            
            $questions = [];

            while ($row = $result->fetch_assoc()) {
                $question_id = $row['question_id'];

                if (!isset($questions[$question_id])) {
                    $questions[$question_id] = [
                        'question_id' => $question_id,
                        'question' => $row['question'],
                        'description' => $row['description'],
                        'level' => $row['level'],
                        'created_at' => $row['created_at'],
                        'deleted_at' => $row['deleted_at'],
                        'answers' => []
                    ];
                }

                $questions[$question_id]['answers'][] = [
                    'answer_id' => $row['answer_id'],
                    'answer' => $row['answer'],
                    'is_correct' => $row['is_correct']
                ];
            }

            foreach ($questions as &$question) {
                shuffle($question['answers']);
            }

            $stmt->close();
            return array_values($questions);
        }

        return false;
    }
}
?>