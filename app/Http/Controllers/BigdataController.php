<?php
/**
 * Created by PhpStorm.
 * User: Hainan
 * Date: 2018/12/13
 * Time: 20:09
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;

class BigdataController extends Controller
{
    public function index() {
//        $aa = [
//            "status" => 0,
//            'msg' => "success",
//            'data' => [
//                [
//                    'url' => 'http://xyz1.jpg',
//                    'label' => [
//                        '蓝色','长袖','长裙','束腰','斑点'
//                    ]
//                ],
//                [
//                    'url' => 'http://xyz2.jpg',
//                    'label' => [
//                        '黑色','短袖','短裙','不束腰','波点'
//                    ]
//                ]
//            ]
//        ];
//        echo json_encode($aa);
//        exit;
        $pic = [
            '01.jpg','02.jpg','03.jpg','04.jpg','05.jpg','06.jpg','07.jpg','08.jpg'
        ];

        $except = ['02.jpg'];

        $url = [];
        foreach ($pic as $value) {
            if(in_array($value, $except)) continue;
            $url[] = "images/dress/" . $value;
        }

        $arrRes = [];
        $labels = [];

        return view("hello",compact('arrRes', 'labels', "url"));
    }

    public function query(Request $request) {
        dd($request);
        return "hello world";
    }

    public function upload(Request $request) {
        $file = $request->file('upload');

        //保存图片begin
        $rule = ['jpg', 'png', 'gif'];
        if ($request->hasFile('upload')) {//验证是否上传图片
            $clientName = $file->getClientOriginalName();// 文件原名
            $tmpName = $file->getFileName();
            $realPath = $file->getRealPath();//临时文件的绝对路径
            $entension = $file->getClientOriginalExtension();// 扩展名
            if (!in_array($entension, $rule)) {
                return '图片格式为jpg,png,gif';
            }
            $newName = md5(date("Y-m-d H:i:s") . $clientName) . "." . $entension;//图片重命名
            $bool = Storage::disk('uploadimg')->put($newName, file_get_contents($realPath));//保存图片
            $url = "http://localhost:8080/storage/img/" . $newName;
        } elseif(!empty($request->input('upload_img'))) {
            $url = $request->input('upload_img');
        } else {
            return redirect('/');
        }

        // 调用接口
        $arrRes = [];
//        $client = new Client();
//        try {
//            $response = $client->request('POST','http://101.6.54.213:5000/get_image_url',[
//                    'body' => json_encode(['url' => $url])
//                ]
//            );
//
//            Log::info('返回');
//            $statusCode = $response->getStatusCode();
//            $rsp = $response->getBody()->getContents();
//            $arrRes = json_decode($rsp, true);
//            Log::info($statusCode);
//            Log::info($rsp);
//        } catch (\Exception $e) {
//            Log::error('error:  ' . $e->getMessage());
//            return redirect('/');
//        }

        $arrRes = [
            "status" => 0,
            'msg' => "success",
            'data' => [
                [
                    'url' => 'http://localhost:8080/storage/img/986d52bc605d63fbf025e937a54a1da8.png',
                    'label' => [
                        '蓝色','长袖','长裙','束腰','斑点'
                    ]
                ],
                [
                    'url' => 'http://localhost:8080/storage/img/a5c93e5ca6a4ba254d7c39edd1a8faaa.png',
                    'label' => [
                        '黑色','短袖','短裙','不束腰','波点'
                    ]
                ]
            ]
        ];

        // 处理返回参数
        if(isset($arrRes['status']) && ($arrRes['status'] == 0)) {
            $arrRes = $arrRes['data'];
            $labels = [];
            foreach ($arrRes as &$item) {
                $labels = array_merge($labels, $item['label']);
                foreach($item['label'] as $labelItem) {
                    $item['md5'][$labelItem] = md5($labelItem);
                }
                $item['label_str'] = join(' ', $item['md5']);
            }
            unset($item);
            $labels = array_unique(array_filter($labels));
        }

        $pic = [
            '01.jpg','02.jpg','03.jpg','04.jpg','05.jpg','06.jpg','07.jpg','08.jpg'
        ];

        $except = ['02.jpg'];

        $url = [];
        foreach ($pic as $value) {
            if(in_array($value, $except)) continue;
            $url[] = "images/dress/" . $value;
        }
        // 封装格式返回

        return view('hello', compact('arrRes', 'labels', 'url'));
    }
}
