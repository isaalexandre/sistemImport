<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Imports\ExcelImport;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index(){
        return view('admin.pages.index');
    }

    public function import(Request $request)
    {
        $dataSet1 = (new ExcelImport)->toArray(request()->file('dataSet1'));
        $dataSet2 = (new ExcelImport)->toArray(request()->file('dataSet2'));
        $arrayVelocity = [];

        $stances = in_array('STANCE', $dataSet1[0][0]) ? $dataSet1[0] : $dataSet2[0];

        if($stances[0][0] != null){
            foreach ($stances as $stance) {
                if (in_array('bipedal', $stance)) {
                    $specie[] = $stance;

                    foreach ($dataSet1[0] as $data1) {
                        if ($data1[0] == $stance[0]) {
                            $data = [
                                'name' => $data1[0],
                                'velocity' => (($stance[1] / $data1[1]) - 1) * sqrt($data1[1]*9.8)
                            ];

                            $arrayDatas[] = $data;
                            array_push( $arrayVelocity, $data['velocity']);
                        }
                    }
                }
            }

            $arrayOrder = [];
            rsort ($arrayVelocity);

            foreach($arrayVelocity as $chave => $valor ){
                array_push($arrayOrder, $chave = $valor);
            }

            foreach($arrayOrder as $velocity)
            {
                foreach($arrayDatas as $data){
                    if($velocity == $data['velocity'])
                    $arrayName[] = $data['name'];
                }
            }

            return $arrayName;
        }

        return;
    }
}
