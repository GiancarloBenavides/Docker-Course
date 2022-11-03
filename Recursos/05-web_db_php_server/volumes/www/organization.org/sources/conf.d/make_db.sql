--CREATE USER IF NOT EXISTS todo;
--CREATE DATABASE IF NOT EXISTS todo_db;
--GRANT ALL PRIVILEGES ON DATABASE todo_db TO todo;


DROP TABLE
    IF EXISTS public.dbt_categories,
    public.dbt_jobs,
    CASCADE;


-- Table: public.dbt_categories
-------------------------------
CREATE TABLE
    IF NOT EXISTS public.dbt_categories (
        description VARCHAR(255) NOT NULL,
        created_at timestamp NOT NULL DEFAULT NOW(),
        updated_at timestamp NOT NULL DEFAULT NOW(),
        id INT NOT NULL GENERATED ALWAYS AS IDENTITY,
        PRIMARY KEY (id)
    );


-- Table: public.dbt_jobs
-------------------------
CREATE TABLE
    IF NOT EXISTS public.dbt_jobs (
        description VARCHAR(255) NOT NULL,
        created_at timestamp NOT NULL DEFAULT NOW(),
        updated_at timestamp NOT NULL DEFAULT NOW(),
        category_id integer,
        id integer NOT NULL GENERATED ALWAYS AS IDENTITY,
        PRIMARY KEY (id),
        CONSTRAINT fk_jobs FOREIGN KEY (category_id) REFERENCES public.dbt_categories (id)
    )