<?php
function abrirBD()
{
    $servername = "localhost:3308";
    $username = "root";
    $password = "pMhYmJ09h4TxtWQ*";
    $bd = "pokedex";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$bd", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function cerrarBD($conn)
{
    return $conn = null;
}

function selectAllPokes($conn)
{
    $arrayPokes = [];

    try {

        //Preparamos la consulta
        $stmt = $conn->prepare("SELECT * FROM pokemons");

        //La ejecutamos
        $stmt->execute();

        // Queremos un array asociativo sin índices, por eso ponemos el FETCH_ASSOC
        // Agrupamos los resultados
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //Almaceno el nº de resultados
        $row_count = $stmt->rowCount();

        //Validamos que haya resultados
        // Si existe al menos una fila, la guardamos en el array
        if ($row_count > 0) {
            foreach ($resultado as $poke) {
                array_push($arrayPokes, $poke);
            }
        }
        return $arrayPokes;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function selectAllTipos($conn)
{
    $arrayTipos = [];

    try {

        //Preparamos la consulta
        $stmt = $conn->prepare('SELECT * FROM tipos ORDER BY id ASC');

        //La ejecutamos
        $stmt->execute();

        // Queremos un array asociativo sin índices, por eso ponemos el FETCH_ASSOC
        // Agrupamos los resultados
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //Almaceno el nº de resultados
        $row_count = $stmt->rowCount();

        //Validamos que haya resultados
        // Si existe al menos una fila, la guardamos en el array
        if ($row_count > 0) {
            foreach ($resultado as $tipo) {
                array_push($arrayTipos, $tipo);
            }
        }
        return $arrayTipos;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


function selectAllRegiones($conn)
{
    $arrayRegiones = [];

    try {

        //Preparamos la consulta
        $stmt = $conn->prepare('SELECT * FROM regiones');

        //La ejecutamos
        $stmt->execute();

        // Queremos un array asociativo sin índices, por eso ponemos el FETCH_ASSOC
        // Agrupamos los resultados
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //Almaceno el nº de resultados
        $row_count = $stmt->rowCount();

        //Validamos que haya resultados
        // Si existe al menos una fila, la guardamos en el array
        if ($row_count > 0) {
            foreach ($resultado as $region) {
                array_push($arrayRegiones, $region);
            }
        }
        return $arrayRegiones;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function selectPoke($conn, $idPoke)
{
    $pokemon = [];

    try {

        //Preparamos la consulta
        $stmt = $conn->prepare("SELECT * FROM pokemons WHERE id=$idPoke");

        //La ejecutamos
        $stmt->execute();

        // Queremos un array asociativo sin índices, por eso ponemos el FETCH_ASSOC
        // Agrupamos los resultados
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //Almaceno el nº de resultados
        $row_count = $stmt->rowCount();

        //Validamos que haya resultados
        // Si existe al menos una fila, la guardamos en el array
        if ($row_count > 0) {
            foreach ($resultado as $poke) {
                array_push($pokemon, $poke);
            }
        }
        return $pokemon;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function selectTiposPokemon($conn, $idPoke)
{
    $tipos = [];

    try {

        //Preparamos la consulta
        $stmt = $conn->prepare("
        SELECT * from tipos_has_pokemons
        JOIN tipos 
        ON tipos_has_pokemons.tipos_id = tipos.id
        where pokemons_id = $idPoke");

        //La ejecutamos
        $stmt->execute();

        // Queremos un array asociativo sin índices, por eso ponemos el FETCH_ASSOC
        // Agrupamos los resultados
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //Almaceno el nº de resultados
        $row_count = $stmt->rowCount();

        //Validamos que haya resultados
        // Si existe al menos una fila, la guardamos en el array
        if ($row_count > 0) {
            foreach ($resultado as $tipo) {
                array_push($tipos, $tipo);
            }
        }
        return $tipos;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function tipos($tipos)
{
    $arrayNumTipos = [];

    foreach ($tipos as $tipo) {
        switch ($tipo) {
            case 'Agua':
                array_push($arrayNumTipos, 5);
                break;
            case 'Bicho':
                array_push($arrayNumTipos, 8);
                break;
            case 'Eléctrico':
                array_push($arrayNumTipos, 6);
                break;
            case 'Fuego':
                array_push($arrayNumTipos, 3);
                break;
            case 'Hada':
                array_push($arrayNumTipos, 7);
                break;
            case 'Lucha':
                array_push($arrayNumTipos, 9);
                break;
            case 'Planta':
                array_push($arrayNumTipos, 1);
                break;
            case 'Psíquico':
                array_push($arrayNumTipos, 10);
                break;
            case 'Veneno':
                array_push($arrayNumTipos, 2);
                break;
            case 'Volador':
                array_push($arrayNumTipos, 4);
                break;
        }
    }
    return $arrayNumTipos;
}

function insertPoke($conn, $numPoke, $nombrePoke, $region, $altura, $peso, $evolucion, $imagen, $tipos)
{

    //Pasamos los tipos a número para poder insertarlos en la tabla
    $arrayNumTipos = tipos($tipos);

    try {
        //Preparamos la consulta para la tabla Pokemons
        $stmt = $conn->prepare("INSERT INTO pokemons (numero, nombre, altura, peso, evolucion, imagen, regiones_id) VALUES (:numero, :nombre, :altura, :peso, :evolucion, :imagen, :region)");

        //Añadimos los parámetros a la consulta
        $stmt->bindParam(':numero', $numPoke);
        $stmt->bindParam(':nombre', $nombrePoke);
        $stmt->bindParam(':altura', $altura);
        $stmt->bindParam(':peso', $peso);
        $stmt->bindParam(':evolucion', $evolucion);
        $stmt->bindParam(':imagen', $imagen);
        $stmt->bindParam(':region', $region);

        //Ejecutamos la consulta
        $stmt->execute();

        //Preparamos la consulta para obtener el último ID registrado
        // Esto nos permite obtener el ID producido por el auto_increment
        $sql = $conn->prepare("SELECT @@identity AS id");

        //Ejecutamos la consulta
        $sql->execute();

        //Cogemos la fila obtenida
        $resultado = $sql->fetch();

        //Si existe una fila obtenida, nos quedamos con el ID
        if ($resultado) {
            $idPoke = trim($resultado[0]);
        }

        //Recorremos el array con los números de los Tipos
        // y por cada tipo realizamos un INSERT en la tabla Tipos_Has
        // de este modo, si un Pokémon tiene varios tipos, se registran
        // ttodos junto al Pokémon.
        foreach ($arrayNumTipos as $tipo) {

            //Preparamos la consulta para los tipos
            $query = $conn->prepare("INSERT INTO tipos_has_pokemons (tipos_id, pokemons_id) VALUES (:tipoId, :pokemonId)");

            //Añadimos los parámetros a la consulta
            $query->bindParam(':tipoId', $tipo);
            $query->bindParam(':pokemonId', $idPoke);

            //Ejecutamos la consulta
            $query->execute();
        }

        return $idPoke;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function deletePoke($conn, $idPoke)
{

    try {
        //Preparamos la consulta para la tabla Pokemons
        $stmt = $conn->prepare("
        delete pokemons, tipos_has_pokemons
        from pokemons
        join tipos_has_pokemons
        on pokemons.id=tipos_has_pokemons.pokemons_id
        where pokemons.id=$idPoke");

        //Ejecutamos la consulta
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function obtenerIdTiposAnteriores($conn, $idPoke)
{
    $tiposAnteriores = selectTiposPokemon($conn, $idPoke);
    $nuevoArray = [];

    foreach ($tiposAnteriores as $tipo) {
        $viejoTipo = $tipo["tipos_id"];
        array_push($nuevoArray, $viejoTipo);
    }

    return $nuevoArray;
}

function updatePoke($conn, $idPoke, $numPoke, $nombrePoke, $region, $altura, $peso, $evolucion, $imagen, $tipos)
{
    try {
        //Preparamos la consulta para la tabla Pokemons
        $stmt = $conn->prepare("
        UPDATE pokemons
        SET numero=:numero, nombre=:nombre, altura=:altura, peso=:peso, evolucion=:evolucion, imagen=:imagen, regiones_id=:region
        WHERE id = $idPoke");

        //Añadimos los parámetros a la consulta
        $stmt->bindParam(':numero', $numPoke);
        $stmt->bindParam(':nombre', $nombrePoke);
        $stmt->bindParam(':altura', $altura);
        $stmt->bindParam(':peso', $peso);
        $stmt->bindParam(':evolucion', $evolucion);
        $newImagen = $imagen;

        //Si la imagen es nula, debemos dejar la ruta que ya existe en la BD
        // Para ello, hacemos un SELECT
        if ($imagen = "" || is_null($imagen)) {
            $query = $conn->prepare("SELECT imagen FROM pokemons WHERE id = $idPoke");
            $query->execute();
            $imagen = $query->fetch(PDO::FETCH_ASSOC); //recuperamos la ruta ya existente
            $imagen = implode($imagen); //pasamos la consulta a string
            $stmt->bindParam(':imagen', $imagen);
        } else {
            $stmt->bindParam(':imagen', $newImagen);
        }
        $stmt->bindParam(':region', $region);

        //Pasamos los tipos nuevos a número para poder insertarlos en la tabla
        $tiposNuevos = tipos($tipos);

        //Obtenemos los tipos que ya están en la tabla
        $tiposAnteriores = obtenerIdTiposAnteriores($conn, $idPoke);

        // Comparamos arrays, si algún ID coincide, querrá decir que no se actualiza ese tipo
        // Esto lo hacemos para evitar el error de registro duplicado en la tabla
        // Por lo tanto, obtenemos aquellos ID de tipo que sean nuevos
        $i = 0;

        foreach ($tiposAnteriores as $tipo) {
                //Preparamos la consulta para los tipos
                $sql = $conn->prepare("DELETE FROM tipos_has_pokemons WHERE pokemons_id=:pokemonId AND tipos_id=:tipoViejo");

                //Añadimos los parámetros a la consulta
                // $sql->bindParam(':tipoViejo', $tiposAnteriores[$i]);
                $sql->bindParam(':tipoViejo', $tipo);
                $sql->bindParam(':pokemonId', $idPoke);

                //Ejecutamos la consulta
                $sql->execute();
            
        }

        foreach ($tiposNuevos as $tipo) {

            //Preparamos la consulta para los tipos
            $sql = $conn->prepare("INSERT INTO tipos_has_pokemons (tipos_id, pokemons_id) VALUES (:tipoNuevo, :pokemonId)");

            //Añadimos los parámetros a la consulta
            // $sql->bindParam(':tipoViejo', $tiposAnteriores[$i]);
            $sql->bindParam(':tipoNuevo', $tipo);
            $sql->bindParam(':pokemonId', $idPoke);

            //Ejecutamos la consulta
            $sql->execute();
            $i++;
        }

        //Ejecutamos la consulta
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
