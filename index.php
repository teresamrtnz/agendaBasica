<?php
if (isset($_POST['enviar'])) {
    
    //Recogemos los datos
    $nombre = filter_input(INPUT_POST, 'nombre');
    $tel = filter_input(INPUT_POST, 'tel');
    $contactos = $_POST['contactos'];

    /**
     * Si $nombre es nulo o $tel no es numerico saltará un error.
     */
    if (($nombre === null) || (!is_numeric($tel))) {
        echo "<div id='error'>ERROR! El nombre esta vacio o el telefono no es numerico</div>";
    } else {
        if ($tel == null) {
            //Si el telefono esta vacío se elimina el registro del array.
            unset($contactos [$nombre]);
        } else {
            //Si va todo bien se añade al array.
            $contactos [$nombre] = $tel;
        }
        
    }
    
    /*
     * Mostraremos la agenda si el array no esta vacio.
     * De esta manera si salta un error la agenda se sigue mostrando.
     */
    if($contactos!==null){
        echo "<div id='agenda'><h3>Agenda telefonos</h3><br />";
        foreach ($contactos as $nombre => $tel) {
            echo $nombre . " " . $tel . "<br />";
        }
        echo "</div>";
    }
}
?> 

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="estilo.css"/>
    </head>
    <body>
        <div id="formu">
            <form action="." method="POST">
                Nombre <input type="text" name="nombre" value=""/><br />
                Telefono <input type="text" name="tel" value="" maxlength="9"/><br />
                <?php
                //Se envía un input con el contenido de cada contacto.
                foreach ($contactos as $nombre => $tel) {
                    echo "<input type='hidden' name='contactos[$nombre]' value=$tel />";
                }
                ?>
                <input type="submit" name="enviar" value="enviar" />
            </form>
        </div>
    </body>
</html>
