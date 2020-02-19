<?php

namespace App\Http\Controllers;

/* use Illuminate\Http\Request;  デフォルトのリクエストはこれ */
use Illuminate\Http\Request;
use App\Http\Requests\PostCodeRequest;/*コントローラーの中でバリデーションするのはキレイじゃないのでリクエストを作ってその中でやる*/
use App\Model\PostCode; /*使うモデルを書く */

class PostCodeController extends Controller
{
    /**
     * 呼び題したいviewファイルを指定してる。ドットがディレクトリセパレータ的なやつ
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('PostCode.index');
    }

    /**
     * 郵便番号検索
     *
     * @param PostCodeRequest $request
     * @return array
     */
    public function show(Request $request) {
        $PostCode = new PostCode;
        $searchPostCode = str_replace(['-', 'ー'], '', $request['post_code']);
        $address = $PostCode->search((int)$searchPostCode);

        /* DBから物が帰ってきてるか検査 */
        if (!$address->isNotEmpty()) {
            return [
                'status' => false,
                'msg' => 'にゃーん'
            ];
        }

        /* laravelはブーリアンをそのまま帰すと怒られるので配列とかにして返す */
        return [
            'status' => true,
            'addressData' => $address
        ];

    }
}
