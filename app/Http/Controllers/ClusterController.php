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
        // 设置维度
        $n = 2;

        // 加载数据
        $data = self::loadData();
        // 获取中心点


        //聚类



    }

    public static function loadData() {
        $fp = fopen("D:\\Frogs_MFCCs.csv", 'r') or die("can't open file");
        print "<table>\n";
        //while($csv_line = fgetcsv($fp)){
        $count = 0;
        $data = [];
        while($csv_line = fgetcsv($fp)){
            $data[] = $csv_line;
        }
        print "</table>\n";
        fclose($fp) or die("can't close file");
        return $data;
    }

    public static function getEuclidDist($one, $two, $n) {
        $squareSum = 0;
        for ($i = 0; $i < $n; $i++) {
            $squareSum += ($one[$i] - $two[$i]) * ($one[$i] - $two[$i]);
        }
        return sqrt($squareSum);
    }

    public static function getCenterPoints() {

    }

    public static function kMeans($data, $k = 4) {
        $m = shape(dataSet)[0]
32     $clusterAssment = mat(zeros((m,2)))    # 用于存放该样本属于哪类及质心距离
33     # $clusterAssment第一列存放该数据所属的中心点，第二列是该数据到中心点的距离
34     $centroids = createCent(dataSet, k)要继续迭代
45             $clusterAssment[i,:] = minIndex,minDist**2   # 并将第i个数据点的分配情况存入字典
35     $clusterChanged = True   # 用来判断聚类是否已经收敛
36     while $clusterChanged:
            $clusterChanged = False;
            38         for i in range(m):  # 把每一个数据点划分到离它最近的中心点
            39             minDist = inf; minIndex = -1;
40             for j in range(k):
            41                 distJI = distMeans($centroids[j,:], dataSet[i,:])
42                 if distJI < minDist:
            43                     minDist = distJI; minIndex = j  # 如果第i个数据点到第j个中心点更近，则将i归属为j
44             if $clusterAssment[i,0] != minIndex: $clusterChanged = True;  # 如果分配发生变化，则需
46         print $centroids
47         for cent in range(k):   # 重新计算中心点
            48             ptsInClust = dataSet[nonzero($clusterAssment[:,0].A == cent)[0]]   # 去第一列等于cent的所有列
49             $centroids[cent,:] = mean(ptsInClust, axis = 0)  # 算出这些数据的中心点
50     return $centroids, $clusterAssment
    }
}



