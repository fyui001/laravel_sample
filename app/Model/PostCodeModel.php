<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostCode extends Model
{
    protected $table = 'post_code';
    /*
    protected $primaryKey = 'hoge';
    プライマリーキーがid以外のときは明示しないとダメ
    */

    /**
     * 郵便番号で住所を検索
     *
     * @param int $postCode
     * @return mixed
     */
    public function search(int $postCode) {
        return $this->select('prefecture', 'city', 'town')->where('post_code', $postCode)->get();
    }
}
