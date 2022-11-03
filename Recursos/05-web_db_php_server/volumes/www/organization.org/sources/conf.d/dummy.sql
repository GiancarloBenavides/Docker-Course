INSERT INTO
    public.dbt_categories (description)
VALUES ('Urgentes'), ('Importantes');

INSERT INTO
    public.dbt_jobs (description, category_id)
VALUES ('Tarea uno', 2), ('Tarea dos - Urgente!', 1), ('Tarea tres - Urgente!', 1), ('Tarea cuatro', 2), ('Tarea cinco', 2);