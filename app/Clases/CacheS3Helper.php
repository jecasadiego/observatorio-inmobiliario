<?php

namespace App\Clases;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File as FileFacade;
use Illuminate\Http\File as HttpFile;
use Illuminate\Support\Str;

use App\helpers\FileCacheManager;

class CacheS3Helper
{
    protected $destinationS3;
    protected $path;
    protected $pathS3;
    private static $Instance = null;
    private $extension = null;
    private $originalName = null;
    const DIR_NAME_CACHE = 'cache';

    public function __construct(UploadedFile $file, $destinationS3 = 'docs', $newHashName = false, $original = null)
    {
        $this->destinationS3 = $destinationS3;
        $this->extension = $file->getClientOriginalExtension();
        $this->originalName = $file->getClientOriginalName();

        if ($newHashName) {
            if (!is_null($original)) {
                $this->path = storage_path('app/') . $file->storeAs('cache', $original, 'local');
            } else {
                $newHash = $this->generateNewFileName();
                $this->path = storage_path('app/') . $file->storeAs('cache', $newHash, 'local');
            }
        } else {
            $this->path = storage_path('app/') . $file->store('cache', 'local');
        }

        $this->pathS3 = $destinationS3 . '/' . FileFacade::basename($this->path);
        $infoPath = pathinfo(storage_path($this->path));

        // Verifica si la extensión está presente en el nombre del archivo
        if (!isset($infoPath['extension']) || substr($this->path, -4) !== '.pdf') {
            $this->path .= '.pdf'; // Concatena '.pdf' si no está presente
            // Actualiza la ruta S3 solo si el nombre del archivo ha cambiado
            $this->pathS3 = $destinationS3 . '/' . FileFacade::basename($this->path);
        }
    }

    public function uploadS3As()
    {
        Storage::disk('s3')->putFileAs($this->destinationS3, new HttpFile($this->path), FileFacade::basename($this->path));
    }

    public function getS3Path()
    {
        return $this->pathS3;
    }

    public function getCachePath()
    {
        return $this->path;
    }

    static public function generateFakeFile($mimetype, $destinationS3 = 'docs', $nameFile = null)
    {
        $mimes =  require_once base_path('app/helpers/mimetype.php');
        $nameFakeFile =  $nameFile ? $nameFile . $mimes[$mimetype] : time() . $mimes[$mimetype];
        $tmp = tmpfile();
        $pathTmp = stream_get_meta_data($tmp)['uri'];
        $uploadFileInstanche = new UploadedFile($pathTmp, $nameFakeFile, $mimes[$mimetype]);

        if (!self::$Instance instanceof self) self::$Instance = new CacheS3Helper($uploadFileInstanche, $destinationS3);

        return self::$Instance;
    }

    static public function generateFakeFilewOriginal($mimetype, $destinationS3 = 'docs', $nameFile = null)
    {
        $mimes = require_once base_path('app/helpers/mimetype.php');
        $nameFakeFile = $nameFile ? $nameFile . $mimes[$mimetype] : time() . $mimes[$mimetype];
        $tmp = tmpfile();
        $pathTmp = stream_get_meta_data($tmp)['uri'];
        $uploadFileInstanche = new UploadedFile($pathTmp, $nameFakeFile, $mimes[$mimetype]);

        // Usamos un array para almacenar instancias basadas en el nombre del archivo
        static $instances = [];

        // Verificamos si ya existe una instancia para este nombre de archivo
        if (!isset($instances[$nameFakeFile])) {
            $instances[$nameFakeFile] = new CacheS3Helper($uploadFileInstanche, $destinationS3, $nameFakeFile, $nameFakeFile);
        }

        // Devolvemos la instancia específica para este nombre de archivo
        return $instances[$nameFakeFile];
    }


    // FUNCION BACKUP ANTES DE MODIFICAR POR ANDRES:
    // static public function generateFakeFilewOriginal($mimetype, $destinationS3 = 'docs', $nameFile = null)
    // {
    //     $mimes =  require_once base_path('app/helpers/mimetype.php');
    //     $nameFakeFile =  $nameFile ? $nameFile . $mimes[$mimetype] : time() . $mimes[$mimetype];
    //     $tmp = tmpfile();
    //     $pathTmp = stream_get_meta_data($tmp)['uri'];
    //     $uploadFileInstanche = new UploadedFile($pathTmp, $nameFakeFile, $mimes[$mimetype]);

    //     if (!self::$Instance instanceof self) self::$Instance = new CacheS3Helper($uploadFileInstanche, $destinationS3, $nameFakeFile, $nameFakeFile);

    //     return self::$Instance;
    // }
    // ====================

    public function uploadS3()
    {
        $this->pathS3 = Storage::disk('s3')->putFile($this->destinationS3, new HttpFile($this->path));
        return $this;
    }

    public function getUrlFakeFile()
    {
        return Storage::disk('s3')->url($this->pathS3);
    }

    public function getOriginalName()
    {
        return $this->originalName;
    }

    static public function getS3ContentToCache($s3path, $isPreserv = false)
    {
        $fileS3Name = FileFacade::basename($s3path);
        $content = Storage::disk('s3')->get($s3path);
        $filePath = self::DIR_NAME_CACHE . '/' . $fileS3Name;
        Storage::disk('local')->put($filePath, $content);

        return new FileCacheManager($filePath, $s3path, $isPreserv);
    }

    public function __destruct()
    {
        $this->uploadS3As();
        FileFacade::delete($this->path);
    }

    private function generateNewFileName()
    {
        $str = Str::random(30);

        return $str . '.' . $this->extension;
    }
}
