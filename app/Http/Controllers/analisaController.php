<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Library\Wp as Wp;
use App\Kriteria;
use App\Alternatif;
use DB;

class analisaController extends Controller
{
    function get_kepentingan(){
        $kepentingan = DB::table('kriteria')->select()->get();
        
        // $b = kriteria::where('id_kriteria','=',1)->first();

        // $kep = ['id_kriteria','kriteria','kepentingan','cost_benefit'];

        // $convert = $kepentingan->kepentingan;



        // $i=0;
        // while ($row = $kepentingan->fetch_assoc()) {
        //     @$kep[$i] = $row["kepentingan"];
        //     $i++;
        // }
        return compact('kep');
    }
    
    function get_costbenefit(){
        $cb = kriteria::get()->toArray();
        // $i=0;
        // while ($row = $costbenefit->fetch_assoc()) {
        //     @$cb[$i] = $row["cost_benefit"];
        //     $i++;
        // }
        return $cb;
    }
    
    function get_alt_name(){ 
        $alt = kriteria::get()->toArray();
        // $i=0;
        // while ($row = $alternatif->fetch_assoc()) {
        //     @$alt[$i] = $row["alternatif"];
        //     $i++;
        // }
        return $alt;
    }
    
    function get_alternatif(){ 
        $alt = kriteria::get()->toArray();
        // $i=0;
        // while ($row = $alternatif->fetch_assoc()) {
        //     @$alt[$i][0] = $row["k1"];
        //     @$alt[$i][1] = $row["k2"];
        //     @$alt[$i][2] = $row["k3"];
        //     @$alt[$i][3] = $row["k4"];
        //     @$alt[$i][4] = $row["k5"];
        //     $i++;
        // }
        return $alt;
    }
    
    function cmp($a, $b){
        if ($a == $b) {
            return 0;
        }
        return ($a < $b) ? -1 : 1;
    }

    function print_ar(array $x){	//just for print array
        echo "<pre>";
        print_r($x);
        echo "</pre></br>";
    }
                    
    public function analisa(){

        $alt = DB::table('alternatif')->select()->get();
        // DB::table('alternatif')->pluck('k1','k2','k3','k4','k5')->get();
        $alt_name = DB::table('alternatif')->pluck('alternatif')->all();
        // DB::table('alternatif')->pluck('alternatif')->all();
        end($alt_name); 
        $arl2 = key($alt_name)+1; //new
        
        $kep = self::get_kepentingan();
        // DB::table('kriteria')->pluck('kepentingan')->all();
        $cb = self::get_costbenefit();
        // DB::table('kriteria')->pluck('cost_benefit')->all();
        $k = kriteria::count();
        $a = alternatif::count();
        $tkep = 0;
        $tbkep = 0;
        
        // for($i=0;$i<$k;$i++){
        //     $tkep = $tkep + $kep[$i];  //180
        // }
        // for($i=0;$i<$k;$i++){
        //     $bkep[$i] = ($kep[$i]/$tkep); //5/18
        //     $tbkep = $tbkep + $bkep[$i]; //0,2778 + dst
        // }
        // for($i=0;$i<$k;$i++){
        //     if($cb[$i]=="cost"){
        //         $pangkat[$i] = (-1) * $bkep[$i];
        //     }
        //     else{
        //         $pangkat[$i] = $bkep[$i];
        //     }
        // }
        // for($i=0;$i<$a;$i++){
        //     for($j=0;$j<$k;$j++){
        //         $s[$i][$j] = pow(($alt[$i][$j]),$pangkat[$j]);
        //     }
        // $ss[$i] = $s[$i][0]*$s[$i][1]*$s[$i][2]*$s[$i][3]*$s[$i][4];
        
        // }
        // // echo "<b>Hasil Akhir</b></br>";
		// // 		echo "<table class='table table-striped table-bordered table-hover'>";
		// // 		echo "<thead><tr><th>Alternatif</th><th>V</th></tr></thead>";
		// 		$total = 0;
		// 		for($i=0;$i<$a;$i++){
		// 			$total = $total + $ss[$i];
		// 		}
		// 		for($i=0;$i<$a;$i++){
		// 			echo "<tr><td><b>".$alt_name[$i]."</b></td>";
		// 			$v[$i] = round($ss[$i]/$total,6);
		// 			echo "<td>".$v[$i]."</td></tr>";
		// 		}
		// 		echo "</table><hr>";
		// 		// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> vektor S <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< //
		// 		uasort($v,'cmp');
		// 					for($i=0;$i<$arl2;$i++){ //new for 8 lines below
		// 						if($i==0)
		// 							echo "<div class='alert alert-dismissible alert-info'><b><i>Dari tabel tersebut dapat disimpulkan bahwa ".$alt_name[array_search((end($v)), $v)]." mempunyai hasil paling tinggi, yaitu ".current($v);
		// 						elseif($i==($arl2-1))
		// 							echo "</br>Dan terakhir ".$alt_name[array_search((prev($v)), $v)]." dengan nilai ".current($v).".</i></b></div>";
		// 						else
		// 							echo "</br>Lalu diikuti dengan ".$alt_name[array_search((prev($v)), $v)]." dengan nilai ".current($v);
        //                     }
                            
        return view('analisa',compact('ss','alt','alt_name','kep'));
    }

    function analisis(){

        $alternatif = DB::table('alternatif')->select()->get();
        $alt = DB::table('alternatif')->select('k1','k2','k3','k4','k5')->get();
        $altn = DB::table('alternatif')->select('alternatif')->get();
        $kriteria = DB::table('kriteria')->select()->get();
        $kcount = kriteria::count();
        $altcount = alternatif::count();
        $kepentingan = DB::table('kriteria')->select('kepentingan')->get();
        $tkep = 0;
        $tbkep = 0;
        $cb = DB::table('kriteria')->select('cost_benefit')->get();
        
        foreach($altn as $key => $value){
            foreach($value as $v){

                $alt_name[$key] = $v;
                
            }
            
        }
        foreach($kepentingan as $nama => $value){
            foreach($value as $isi){
                
                $tkep = $tkep + $isi;
            }
            
        }
        // for($i=0;$i<$kcount;$i++){
        //     $tkep = $tkep + $kep[$i];  //18
        // }
        
        foreach($kepentingan as $nama => $value){
            foreach($value as $v){
                
                $bkep[$nama] = ($v/$tkep);
                
            }
            
            
            $tbkep = $tbkep+$bkep[$nama];
        }
        

        // for($i=0;$i<$kcount;$i++){
        //     $bkep[$i] = ($kep[$i]/$tkep); //5/18
        //     $tbkep = $tbkep + $bkep[$i]; //0,2778 + dst
        // }

        foreach($cb as $nama => $isi){
            if($isi=="COST"){
                $pangkat[$nama] = (-1) * $bkep[$nama];
            }
            else{
                $pangkat[$nama] = $bkep[$nama];
            }
            
        }
        
        // for($i=0;$i<$kcount;$i++){
        //     if($cb[$i]=="cost"){
        //         $pangkat[$i] = (-1) * $bkep[$i];
        //     }
        //     else{
        //         $pangkat[$i] = $bkep[$i];
        //     }
        // }
        foreach($alt as $nama => $isi){
            $i=0;
            foreach($isi as $v){
                
                $s[$nama][$i] = pow($v,$pangkat[$nama]);
                $i++;
            }
            // dd($s[0][0]);
            $ss[$nama] = $s[$nama][0]*$s[$nama][1]*$s[$nama][2]*$s[$nama][3]*$s[$nama][4];
        }
        // dd($ss);
        // for($i=0;$i<$altcount;$i++){
        //     for($j=0;$j<$kcount;$j++){
        //         $s[$i][$j] = pow(($alt[$i][$j]),$pangkat[$j]);
        //     }
        // $ss[$i] = $s[$i][0]*$s[$i][1]*$s[$i][2]*$s[$i][3]*$s[$i][4];
        // }


        $total = 0;
        // for($i=0;$i<$altcount;$i++){
        //     $total = $total + $ss[$i];
        // }
        
        foreach($ss as $key){
            
            $total = $total + $ss[$key];
        }
        //  dd($ss);
        foreach($ss as $key => $value){
            
            $vs[$key] = $ss[$key]/$total;
        }
        
        // for($i=0;$i<$altcount;$i++){
        //     // echo "<tr><td><b>".$alt_name[$i]."</b></td>";
        //     $v[$i] = round($ss[$i]/$total,6);
        //     // echo "<td>".$v[$i]."</td></tr>";
        // }

        return view('analisa', compact('alternatif','kriteria','altcount','kcount','ss','alt_name','vs'));
    }
    
    function jum_kep(){
        $i=0;
        $alternatif = DB::table('alternatif')->select()->get();
        foreach($alternatif as $tkep){
            $tkep = $tkep + $tkep[$i];
            $i++;
        }
        return $tkep;
    }
    function hitung(){
        
        for($i=0;$i<$k_count;$i++){
            $bkep[$i] = ($kep[$i]/$tkep); //5/18
            $tbkep = $tbkep + $bkep[$i]; //0,2778 + dst
        }
    }

    function fix (){

        // $alternatif = DB::table('alternatif')->select('k1', 'k2', 'k3', 'k4', 'k5')->get();
        $alternatif = alternatif::get(['k1', 'k2', 'k3', 'k4', 'k5'])->toArray();
        $kriteria = DB::table('kriteria')->select('kepentingan')->get();
        
        
        $wp = new Wp($alternatif, $kriteria);
        $hasil = $wp->make();


        foreach($hasil as $key => $value){

            $res[$key] = [
                'id' => $key + 1,
                'hasil' => $value
            ]; 
        }

        DB::table('hasil')->insert($res);

        return view('analisa',compact('res'));
    }
    
    
}