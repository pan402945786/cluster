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
    const DMS = 22; // 数据维度

    const KINDS = [
        'Leptodactylidae',
        'Dendrobatidae',
        'Hylidae',
        'Bufonidae'
    ];

    public function index() {
        // 设置聚类组数
        $k = 9;
        // 加载数据
        $data = self::loadData();
        //聚类
        //list($clusterResults, $centerPoints, $clusterDistribution) = self::kMeans($data, $k);
        $clusterDistribution = self::kMeans($data, $k);
        // purity评价
        list($msg, $purity) = self::purity($clusterDistribution);
        echo $msg;
        // f-score评价
        $fscore = self::fscore($clusterDistribution);
        dd($purity,$fscore);
    }

    public static function loadData() {
        $fp = fopen("D:\\Frogs_MFCCs.csv", 'r') or die("can't open file");
        $data = [];
        $count = 0;
        while($csv_line = fgetcsv($fp)){
            //if($count++ > 250) break;
            if ($count++ == 0) continue;
            $data[] = $csv_line;
        }
        fclose($fp) or die("can't close file");
        return $data;
    }

    public static function getEuclidDist($one, $two) {
        $squareSum = 0;
        for ($i = 0; $i < self::DMS; $i++) {
            $squareSum += ($one[$i] - $two[$i]) * ($one[$i] - $two[$i]);
        }
        return sqrt($squareSum);
    }

    public static function calcCenterPoints($data, $k) {
        $centerPoint = [];
        foreach($data as $i => $datum){
            $points = array_column($data[$i], "point");
            for ($j = 0; $j < self::DMS; $j++) {
                $centerPoint[$i][$j] = array_sum(array_column($points, $j)) / count($points);
            }
        }
        return $centerPoint;
    }

    public static function getCenterPoints($data, $k) {
        $keys = array_rand($data, $k);
        $dataReturn = [];
        foreach ($keys as $value) {
            $dataReturn[] = $data[$value];
        }
        return [$dataReturn, $keys];
    }

    public static function getStaticCenterPoint($data, $k) {
        $kindCount = [];
        $dataReturn = [];
        $visited = [];
        for ($i = 0; $i < $k; $i++) {
            foreach($data as $key => $datum) {
                if(!in_array($datum[22], $kindCount) && !in_array($key,$visited)) {
                    $dataReturn[] = $datum;
                    $kindCount[] = $datum[22];
                    $visited[] = $key;
                    if(count($kindCount) == count(self::KINDS)) {
                        $kindCount = [];
                    }
                    break;
                }
            }
        }
        return $dataReturn;
    }

    public static function kMeans($data, $k) {
        // 初始化初始中心点
        //list($centerPoints,$keys] = self::getCenterPoints($data, $k);
        $centerPoints = self::getStaticCenterPoint($data, $k);
            // 初始化聚类收敛标志位变量
        $changeFlag = true;
        // 初始化聚类结果数组，并存储距中心点距离
        $clusterResults = [];
        // 初始化聚类分布数组
        $clusterDistribution = [];
        $cct = 0;
        // 聚类
        while($changeFlag) {
            //if($cct++ > 100) break;
            $cct++;
            $changeFlag = false;
            // 初始化聚类结果数组，并存储距中心点距离
            $clusterResults = [];
            $clusterDistribution = [];
            foreach($data as $datum) {
                $minDist = 99999;
                $minIndex = -1;
                for ($j = 0; $j < $k; $j++) {
                    // 计算每个数据点距离最近中心点
                    $dist = self::getEuclidDist($centerPoints[$j], $datum);
                    if ($dist < $minDist) {
                        if($dist < 0.0000000000000001) continue 2;
                        $minDist = $dist;
                        $minIndex = $j;
                    }
                }
                // 把这个点归类到那个中心点
//                $clusterResults[$minIndex][] = [
//                    'point' => $datum,
//                    'dist' => $minDist
//                ];
                // 统计聚类信息
                isset($clusterDistribution[$minIndex][$datum[22]]) ? $clusterDistribution[$minIndex][$datum[22]]++ : ($clusterDistribution[$minIndex][$datum[22]] = 1);
            }

            // 重新计算中心点
            $newCenterPoints = self::calcCenterPoints($clusterResults, $k);
            for($i = 0; $i < $k; $i++) {
                if (!isset($newCenterPoints[$i])) {
                    $newCenterPoints[$i] = $centerPoints[$i];
                }
            }
            for ($j = 0; $j < $k; $j++) {
                for($i = 0; $i < self::DMS; $i++) {
                    if($newCenterPoints[$j][$i] == $centerPoints[$j][$i]) {
                        continue;
                    } else {
                        $changeFlag = true;
                        $centerPoints = $newCenterPoints;
                        break 2;
                    }
                }
            }
        }

        // 数据处理
        foreach ($clusterDistribution as $ak => &$av) {
            foreach (self::KINDS as $kv) {
                if(!isset($av[$kv])) {
                    $av[$kv] = 0;
                }
            }
        }
        unset($av);
        // 数据返回，中心点位置和聚类结果
        //return [$clusterResults, $centerPoints, $clusterDistribution];
        return $clusterDistribution;
    }

    public static function purity($table) {
        $msg = "<table border='1'><tr><td>Group</td>";
        foreach(self::KINDS as $kv) {
            $msg .= "<td>" . $kv . "</td>";
        }
        $msg .= '</tr>';
        foreach ($table as $ak => $av) {
            $msg .= '<tr><td>' . $ak . "</td>";
            $sum = array_sum($av);
            foreach(self::KINDS as $kv) {
                $avValue = $av[$kv];
                $msg .= "<td>" . $avValue . "</td>";
            }
        }
        $msg .= '</table>';

        // purity
        $correctCount = 0;
        $total = 0;

        foreach(self::KINDS as $kv) {
            $correctCount += max(array_column($table, $kv));
            $total += array_sum(array_column($table, $kv));
        }
        return [$msg, $correctCount/$total];
    }

    public static function fscore($table) {
        $tpAndFp = 0;
        $tp = 0;
        foreach ($table as $key => $item) {
            $tpAndFp += self::calcComp2(array_sum($item));
            foreach ($item as $ik => $iv) {
                $tp += self::calcComp2($iv);
            }
        }
        $fp = $tpAndFp - $tp;

        $tnAndFn = 0;
        foreach ($table as $key => $item) {
            $visited[] = $key;
            $firstPart = array_sum($item);
            $secondPart = 0;
            foreach($table as $tk => $tv) {
                if (in_array($tk, $visited)) {
                    continue;
                }
                $secondPart += array_sum($tv);
            }
            $tnAndFn += $firstPart * $secondPart;
        }

        $fn = 0;
        foreach(self::KINDS as $item) {
            $visited = [];
            $column = array_column($table, $item);
            foreach ($column as $ck => $cv) {
                $visited[] = $ck;
                $firstPart = $cv;
                $secondPart = 0;
                foreach ($column as $ick => $icv) {
                    if (in_array($ick, $visited)) {
                        continue;
                    }
                    $secondPart += $icv;
                }
                $fn += $firstPart * $secondPart;
            }
        }

        $tn = $tnAndFn - $fn;

        $p = $tp / ($tp + $fp);
        $r = $tp / ($tp + $fn);
        $fscore = 2* ($p * $r) / ($p + $r);

        return $fscore;
    }

    public static function calcComp2($num) {
        return $num * ($num - 1) / 2;
    }

    public static function pam($data, $k) {
        // 随机选择k个中心点
        list($centerPoints,$keys) = self::getCenterPoints($data, $k);
        // 分配每个数据到离得最近的中心点
        // 初始化聚类收敛标志位变量
        $changeFlag = true;
        // 初始化聚类结果数组，并存储距中心点距离
        $clusterResults = [];
        // 初始化聚类分布数组
        $clusterDistribution = [];
        $cct = 0;
        // 中心点记录
        $visited = $keys;
        // 聚类
        foreach($data as $ik => $item) {
            //if($cct++ > 100) break;
            if(in_array($ik, $visited)) {
                continue;
            }
            // 初始化聚类结果数组，并存储距中心点距离
            $clusterResults = [];
            $clusterDistribution = [];
            $minTargetFunction = 1000000000000000;
            $targetFunction = 0;
            foreach($data as $dk => $datum) {
                $minDist = 99999;
                $minIndex = -1;
                for ($j = 0; $j < $k; $j++) {
                    // 计算每个数据点距离最近中心点
                    $dist = self::getEuclidDist($centerPoints[$j], $datum);
                    if ($dist < $minDist) {
                        if($dist < 0.0000000000000001) continue 2;
                        $minDist = $dist;
                        $minIndex = $j;
                    }
                }
                // 把这个点归类到那个中心点
                $clusterResults[$minIndex][] = [
                    //'point' => $datum,
                    'dist' => $minDist,
                    'id' => $dk
                ];
                // 计算目标函数
                $targetFunction += $minDist;
                // 统计聚类信息
                //isset($clusterDistribution[$minIndex][$datum[22]]) ? $clusterDistribution[$minIndex][$datum[22]]++ : ($clusterDistribution[$minIndex][$datum[22]] = 1);
            }

            if($targetFunction < $minTargetFunction) {
                // 记录新的目标函数值，同时记录该店已被访问过
                $minTargetFunction = $targetFunction;
                $visited[] = $ik;

                // 找到该点所在聚簇的中心点，并用这个点替代中心点，同时记录原有中心点
                $centerId = -1;
                foreach($clusterResults as $ck => $cv) {
                    foreach ($cv as $cck => $ccv) {
                        if ($ccv['id'] == $ik) {
                            $centerId = $ck;
                        }
                        break 2;
                    }
                }
                $oldCenterPoints = $centerPoints;


            } else {
                $centerPoints = $oldCenterPoints;
                continue;
            }

            // 用y替代所在聚类的中心点，重新计算目标函数
            // 重新计算中心点
            $newCenterPoints = self::calcCenterPoints($clusterResults, $k);
            for($i = 0; $i < $k; $i++) {
                if (!isset($newCenterPoints[$i])) {
                    $newCenterPoints[$i] = $centerPoints[$i];
                }
            }
            for ($j = 0; $j < $k; $j++) {
                for($i = 0; $i < self::DMS; $i++) {
                    if($newCenterPoints[$j][$i] == $centerPoints[$j][$i]) {
                        continue;
                    } else {
                        $changeFlag = true;
                        $centerPoints = $newCenterPoints;
                        break 2;
                    }
                }
            }


        }

    }
}



