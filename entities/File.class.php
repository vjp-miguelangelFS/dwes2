<?php
require 'exceptions/FileException.class.php';
require 'utils/const.php';

const ERROR_NO_SELECCIONADO = "Debes seleccionar un fichero";
const ERROR_MEDIANTE_FORMULARIO = "El archivo no se ha subido mediante el formulario";
const ERROR_MOVER_FICHERO = "No se puede mover el fichero a su destino";
const ERROR_TIPO_FICHERO_NO_SOPORTADO = "Tipo de fichero no soportado";
class File
{
    private $file;
    private $fileName;

    public function __construct($fileName,  array $arrTypes)
    {
        $this->file = $_FILES[$fileName];
        $this->fileName = '';

        if (!isset($this->file)) {
            // Mostrar un error
            throw new FileException(ERROR_NO_SELECCIONADO);
        }
        if ($this->file['error'] !== UPLOAD_ERR_OK) {
            throw new FileException(getErrorString($this->file['error']));
        }

        if (in_array($this->file['type'], $arrTypes) === false) {
            //Error, tipo no sportado
            throw new FileException(ERROR_TIPO_FICHERO_NO_SOPORTADO);
        }
    }
    public function getFileName()
    {
        return $this->fileName;
    }

    public function saveUploadFile(string $rutaDestino)
    {
        if (is_uploaded_file($this->file['tmp_name']) === false) {
            throw new FileException(ERROR_MEDIANTE_FORMULARIO);
        }
        $this->fileName = $this->file['name'];
        $ruta = $rutaDestino . $this->fileName;

        if (is_file($ruta) == true) {
            $arrayNombreYExtension = (explode(".", $this->fileName));
            $contador = 1;
            $arrayNombreYExtension[0] = substr_replace($arrayNombreYExtension[0], '(' . $contador++ . ')', strlen($arrayNombreYExtension[0]), 0);
            while (is_file($ruta)) {
                $arrayNombreYExtension[0] = substr_replace($arrayNombreYExtension[0], '(' . $contador++ . ')', strlen($arrayNombreYExtension[0]) - 3, 3);
                $this->fileName = implode(".", $arrayNombreYExtension);
                $ruta = $rutaDestino . $this->fileName;
            }


            $ruta = $rutaDestino . $this->fileName;
        }

        if (move_uploaded_file($this->file['tmp_name'], $ruta) === false) {

            throw new FileException(ERROR_STRINGS[ERROR_MV_UP_FILE]);
        }
    }
    public function copyFile(string $rutaOrigen, string $rutaDestino)
    {
        $origen = $rutaOrigen . $this->fileName;
        $destino = $rutaDestino . $this->fileName;

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
