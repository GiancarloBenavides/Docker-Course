<footer>
    <ul>
        <li><b>Version: </b>  <?php echo $version; ?></li>
        <li><b>Date: </b>     <?php echo date("d.m.Y");?></li>
        <li><b>Time: </b>     <?php echo date("H:i:s");?></li>
    </ul>
    <?php echo "<b>Autor: </b><a href=" . $webpage . ">" . $author . "</a> - ";?>
    <?php echo "<b>Visitas: </b>" . $contador;?>
</footer>

