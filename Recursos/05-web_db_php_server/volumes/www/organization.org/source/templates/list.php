
<form>
    <div class="task-list">
        <div class="task-control">
            <button class="new">Nueva</button>
            <button class="copy">Duplicar</button>
            <button class="delete">Borrar</button>
        </div>
        <h3><b>TASK LIST:</b><input type="text" value="Nombre de la nueva lista"></h3>
        <ul>
            <?php
            for ($i = 1; $i <= $items; $i++) {
                require("../sources/templates/item.php");
            }
            ?>
        </ul>
        
    </div>
</form>


