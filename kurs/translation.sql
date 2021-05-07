
SELECT
    t.id,
    IF(tt.id IS NOT NULL, JSON_VALUE(tt.content,'$.text'), t.text) AS text
FROM todos t
LEFT JOIN translations tt ON
    tt.translatable_id = t.id
    AND tt.translatable_type='App\\Models\\Todo'
    AND tt.language = "de"
WHERE t.id = 23
