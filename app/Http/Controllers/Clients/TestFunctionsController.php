<?php

namespace App\Http\Controllers\Clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Chumper\Zipper\Zipper;

class TestFunctionsController extends Controller {

    // In this Controller, we mainly discuss a bunch of functions that we never
    // try before. Good luck!
    public function __construct() {
        // name of the guard
        $this->middleware('auth:clients');
    }

    public function zipDownloadPage() {
        return view('clients.pages.zipDownloadPage');
    }

    public function donwloadPDF(Request $request) {
        // Adding files into the Zipper
        $zipper = new Zipper();
        $files = [
            'pdf_folder/f_1/2061-20180718.pdf',
            'pdf_folder/f_2/2061-20180723.pdf',
            'pdf_folder/f_3/2061-20180724.pdf',
        ];
        $zipname = date('Ymd') . 'CompressFile.zip';
        $zipper->make(public_path('zipDownloads/' . $zipname))->add($files)->close();
        return response()->download(public_path('zipDownloads/' . $zipname));
    }

    public function simpleDownloadZip(Request $request) {
        // 把所需下载的文件，连同路径，压进{$files}这个数组中，你也可以直接在Request
        // 里直接做一个files[]，直接赋值给函数内部接收，不管那种，路径都要确保正确
//        $files = $request->files;
        // 例子中先把路径写死
        $files = [
            'pdf_folder/f_1/2061-20180718.pdf',
            'pdf_folder/f_2/2061-20180723.pdf',
            'pdf_folder/f_3/2061-20180724.pdf',
        ];
        $zip = new \ZipArchive();
        $zip_name = date('Ymd') . 'ZipFile.zip';
        $zip->open(public_path('zipDownloads/' . $zip_name), \ZipArchive::CREATE);
        foreach ($files as $f) {
            if (file_exists(public_path($f))) {
                $f_arr = explode('/', $f);
                $new_filename = $f_arr[(count($f_arr) - 1)];
                $zip->addFile($f, $new_filename);
            }
        }
        $zip->close();
        return response()->download(public_path('zipDownloads/' . $zip_name));
    }

    public function rankArray() {

        $values = [-27, 5, 12, 19, 9, 5, -27];

        $ordered_values = array_unique($values);
        rsort($ordered_values);

        $arr_res = [];
        foreach ($values as $key => $value) {
            foreach ($ordered_values as $ordered_key => $ordered_value) {
                if ($value === $ordered_value) {
                    $key = $ordered_key;
                    break;
                }
            }
            echo $value . '- Rank: ' . ((int) $key + 1) . '<br/>';
            $ind = (int) $key + 1;
            $arr_res["$ind"] = $value;
        }
        print_r($arr_res);
    }

    public function webSocketClient(Request $request) {
        if($request->filled('msg')){
            $msgToSend = $request->msg;
        }else{
            $msgToSend = "This is a message sent from the Client!";
        }
        $loop = \React\EventLoop\Factory::create();
        $reactConnector = new \React\Socket\Connector($loop, [
            'dns' => '202.96.128.166',
            'timeout' => 10
        ]);
        $connector = new \Ratchet\Client\Connector($loop, $reactConnector);
        $connector('ws://localhost:8090', [], ['Origin' => 'http://localhost'])
                ->then(function(\Ratchet\Client\WebSocket $conn) use ($msgToSend) {
                    $conn->on('message', function(\Ratchet\RFC6455\Messaging\MessageInterface $msg) use ($conn) {
                        echo "Received: {$msg}\n";
                        $conn->close();
                    });
                    $conn->on('close', function($code = null, $reason = null) {
                        echo "Connection closed ({$code} - {$reason})\n";
                    });
                    $conn->send($msgToSend);
                }, function(\Exception $e) use ($loop) {
                    echo "Connection fail: {$e->getMessage()}\n";
                    $loop->stop();
                });
        $loop->run();
        echo "Connection ends!";
    }

}
