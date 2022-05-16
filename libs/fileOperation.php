<?php

namespace Libs;

class fileOperation
{
    public function fileUpload($file)
    {
        if (is_uploaded_file($file['image_file']['tmp_name'])) {
            // $error = 'file brank';
            // set_message('file brank');
            // return $error;
            $extension = pathinfo($file['image_file']['name'], PATHINFO_EXTENSION); //拡張子取得
            //拡張子判定
            if ($extension != 'jpg' && $extension != 'jpeg' && $extension != 'png') {
                $error = 'extension invalid';
                set_message('extension invalid');
                return $error;
            }
            //ファイル移動
            $file_path = "../../img/";
            $file_name = '_' . $file['image_file']['name'];
            move_uploaded_file($file['image_file']['tmp_name'], $file_path . $file_name);
        }
    }
}