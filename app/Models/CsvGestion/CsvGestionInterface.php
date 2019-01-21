<?php
/**
 * Created by PhpStorm.
 * User: CED
 * Date: 10/06/2018
 * Time: 21:46
 */

namespace App\Models\CsvGestion;

use App\Http\Requests\CsvRequest;

interface CsvGestionInterface
{
    public function save(CsvRequest $request);
}