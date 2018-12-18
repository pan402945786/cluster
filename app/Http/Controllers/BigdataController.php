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
//    const SERVER = 'http://cluster.com:8080/';
//    const SERVER = 'http://127.0.0.1/';
    const SERVER = 'http://62.234.201.250/';
    public function index() {
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
        $site = self::SERVER;
        return view("hello",compact('arrRes', 'labels', "url", 'site'));
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
            $url = self::SERVER . "storage/img/" . $newName;
        } elseif(!empty($request->input('upload_img'))) {
            $url = $request->input('upload_img');
        } else {
            return redirect('/');
        }

        // 调用接口
        $arrRes = [];
        $client = new Client();
        try {
//            $response = $client->request('POST','http://101.6.54.213:5000/get_image_url',[
            $response = $client->request('post','http://62.234.180.193:8050/get_image_url',[
                    'json' => ['url' => $url],
                    'headers' => ['content-type' => 'application/json']
                ]
            );

            Log::info('返回');
            $statusCode = $response->getStatusCode();
            $rsp = $response->getBody()->getContents();
            $arrRes = json_decode($rsp, true);
            Log::info($statusCode);
            Log::info($rsp);
        } catch (\Exception $e) {
            Log::error('error:  ' . $e->getMessage());
            return redirect('/');
        }

        // 处理返回参数
        if(isset($arrRes['status']) && ($arrRes['status'] == 0)) {
            $arrRes = $arrRes['data'];
            $labels = [];
            foreach ($arrRes as &$item) {
                $item['url'] = 'http://' . $item['url'];
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
            $url[] = self::SERVER . "images/dress/" . $value;
        }
        // 封装格式返回
        $site = self::SERVER;

        return view('hello', compact('arrRes', 'labels', 'url', 'site'));
    }
}
