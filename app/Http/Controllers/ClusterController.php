<?php
/**
 * Created by PhpStorm.
 * User: Hainan
 * Date: 2018/12/8
 * Time: 20:16
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class ClusterController extends Controller
{
    public function index() {
        $fp = fopen("D:\\Frogs_MFCCs.csv", 'r') or die("can't open file");
        print "<table>\n";
        //while($csv_line = fgetcsv($fp)){
        $count = 0;
        while($csv_line = fgetcsv($fp)){
//            if($count++ > 20) break;
            print '<tr>';
            for($i=0, $j=count($csv_line); $i<$j; $i++){
                // print '<td>'.htmlentities($csv_line[$i]).'</td>';
                print '<td>'.htmlentities(iconv("gb2312","utf-8",$csv_line[$i])).'</td>';
            }
            print "</tr>\n";
        }
        print "</table>\n";
        fclose($fp) or die("can't close file");
    }
}
