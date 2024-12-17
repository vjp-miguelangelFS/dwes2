<?php

namespace proyecto\entities;

use proyecto\exceptions\FileException;
use proyecto\utils;

// Mesajes de algunos errores
const ERROR_NO_SELECCIONADO = "Debes seleccionar un fichero";
const ERROR_MEDIANTE_FORMULARIO = "El archivo no se ha subido mediante el formulario";
const ERROR_MOVER_FICHERO = "No se puede mover el fichero a su destino";
const ERROR_TIPO_FICHERO_NO_SOPORTADO = "Tipo de fichero no soportado";
// Clase File
class File
{
    // Variable necesarias para la clase
    private $file;
    private $fileName;

    /**
     * Constructor de la clase File
     *
     * @param [type] $fileName
     * @param array $arrTypes
     */
    public function __construct($fileName,  array $arrTypes)
    {
        $this->file = $_FILES[$fileName];
        $this->fileName = '';

        // Valida el fichero y en caso de que ocurra algun error mostrara un mensaje
        if (!isset($this->file)) {
            throw new FileException(ERROR_NO_SELECCIONADO);
        }
        if ($this->file['error'] !== UPLOAD_ERR_OK) {
            throw new FileException(utils\getErrorString($this->file['error']));
        }

        if (in_array($this->file['type'], $arrTypes) === false) {
            //Error, tipo no sportado
            throw new FileException(ERROR_TIPO_FICHERO_NO_SOPORTADO);
        }
    }
    /**
     * Get de FileName
     *
     * @return void
     */
    public function getFileName()
    {
        return $this->fileName;
    }
    /**
     * Función que almacena el fichero guardado en un directorio especifico
     *
     * @param string $rutaDestino
     * @return void
     */
    public function saveUploadFile(string $rutaDestino)
    {
        // Control de error en caso de que el fichero ya este subido
        if (is_uploaded_file($this->file['tmp_name']) === false) {
            throw new FileException(ERROR_MEDIANTE_FORMULARIO);
        }
        // Estable el nombre del fichero como la variable $fileName
        $this->fileName = $this->file['name'];
        // Concatena la ruta de destino con el nombre del fichero
        $ruta = $rutaDestino . $this->fileName;

        // En caso de que exista el nombre del fichero de añadira un número para diferenciar los ficheros con el mismo nombre
        if (is_file($ruta) == true) {
            $arrayNombreYExtension = (explode(".", $this->fileName));
            $contador = 1;
            $arrayNombreYExtension[0] = substr_replace($arrayNombreYExtension[0], '(' . $contador++ . ')', strlen($arrayNombreYExtension[0]), 0);
            while (is_file($ruta)) {
                $arrayNombreYExtension[0] = substr_replace($arrayNombreYExtension[0], '(' . $contador++ . ')', strlen($arrayNombreYExtension[0]) - 3, 3);
                $this->fileName = implode(".", $arrayNombreYExtension);
                $ruta = $rutaDestino . $this->fileName;
            }
            // Concatena la ruta destino con el nombre del fichero con un número
            $ruta = $rutaDestino . $this->fileName;
        }

        // Control de error en caso de que no se pueda mover el fichero
        if (move_uploaded_file($this->file['tmp_name'], $ruta) === false) {

            throw new FileException(ERROR_STRINGS[ERROR_MV_UP_FILE]);
        }
    }
    /**
     * Copia el fichero subido al directorio gallery a portafilio
     *
     * @param string $rutaOrigen
     * @param string $rutaDestino
     * @return void
     */
    public function copyFile(string $rutaOrigen, string $rutaDestino)
    {
        // Concatena las rutas de origen y destino con el nombre del fichero
        $origen = $rutaOrigen . $this->fileName;
        $destino = $rutaDestino . $this->fileName;

        // Valida los errores y te muestran un mensaje en caso de que ocurrra el error
        if (is_file($origen) === false) {
            throw new FileException("No existe el fichero $origen que intentas copiar");
        }
        if (is_file($destino) === true) {
            throw new FileException("El fichero $destino ya existe y no se puede sobreescribirlo");
        }
        if (copy($origen, $destino) === false) {
            throw new FileException("No se ha podido copiar el fichero $origen a $destino");
        }
    }
}
