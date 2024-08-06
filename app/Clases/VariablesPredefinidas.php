<?php

namespace App\Clases;

use App\Models\Entidad;
use App\Models\Divipos_Municipios;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Clase que me permite obtener y manipular variables predefinidas
 *
 */
class VariablesPredefinidas
{
    private static $Instance = null;
    private static $Variables = [];
    private $Replace = [];
    private static $connections = ['xiltrion' => 'mysql2', 'xiltrion_inspeccion' => 'mysql'];
    private static $connection = 'mysql';

    public static function setFrom(array $Tables): ?VariablesPredefinidas
    {
        foreach ($Tables as $table => $id) {
            $dbTable = explode('.', $table);

            if (count($dbTable) > 1) {
                self::$connection = self::$connections[$dbTable[0]];
                $query = DB::connection(self::$connections[$dbTable[0]])->table($dbTable[1])->where('id', $id)->first();
                $tabla = $dbTable[1];
            } else {
                $query = DB::table($table)->where('id', $id)->first();
                $tabla = $table;
            }

            $columns = Schema::connection(self::$connection)->getColumnListing($tabla);
            foreach ($columns as $column) {
                $key = "${column}";
                self::$Variables["$tabla.$column"] = $query->$key ?? null;
            }
        }
        if (!self::$Instance instanceof self) self::$Instance = new self;
        return self::$Instance;
    }

    public function getVars(): array
    {
        return VariablesPredefinidas::$Variables;
    }

    public function replaceString(string $Text = null, string $title = null): ?VariablesPredefinidas
    {
        $replaced = $Text;

        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $fecha = strftime("%d de mes de %Y");
        $mes = date("n");
        $meses[date('n') - 1];
        $fecha = str_ireplace("mes", $meses[date('n') - 1], $fecha);
        $replaced = str_ireplace("[[fecha_sistema]]", $fecha, $replaced);

        $entidad = Entidad::first();
        $municipio = Divipos_Municipios::find($entidad->id_divipos_municipios);
        $replaced = str_replace('[[entidad.nombre]]', $entidad->nombre, $replaced);
        $replaced = str_replace('[[entidad.ciudad]]', ucfirst(mb_strtolower($municipio->nombre_municipio)), $replaced);

        foreach (VariablesPredefinidas::$Variables as $key => $value) {
            $replaced = str_ireplace("[[$key]]", $value, $replaced);
        }

        $this->Replace[$title] = $replaced;
        return $this;
    }

    public function getReplace()
    {
        return count($this->Replace) > 1 ? $this->Replace : current($this->Replace);
    }

    public function getReplaceToObject(): object
    {
        return (object) $this->Replace;
    }

    public function replaceSpecific($var, $template, $content = null, $title = null)
    {
        if (is_array($template)) {
            $data = DB::connection($template['connection'] ?? VariablesPredefinidas::$connection)->table($template['table'])->find($template['id']);
            $column = $template['column'];
            $key = "${column}";

            if ($title) {
                $this->Replace[$title] = str_replace($var, $data->$key, $content ?? $this->Replace[$title]);
            } else {
                foreach ($this->Replace as $key => $replaced) {
                    $this->Replace[$key] = str_replace($var, $data->$key, $replaced);
                }
            }
        } else {
            if ($title) {
                $this->Replace[$title] = str_replace($var, $template,  $content ?? $this->Replace[$title]);
            } else {
                foreach ($this->Replace as $key => $replaced) {
                    $this->Replace[$key] = str_replace($var, $template, $replaced);
                }
            }
        }

        return $this;
    }
}
