

<?php
    exec('pg_dump --dbname=postgresql://gncdev:postgres@postgres:5432/todo_db > ./db_bck.sql',$output);
    print_r($output);
?>