<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class EditENVController extends Controller
{
    public function getContent()
    {
        $keys = DotenvEditor::getKeys();
        $env_arr = [];
        foreach ($keys as $k =>$v) {
            $env_arr[$k]=$v["value"];
        }
        return $env_arr;
    }

    public function store(Request $request)
    {
        $key = $request->key;
        $val = $request->val;
        $file = DotenvEditor::setKey($key, $val)->save();
        return response(['new_key'=>$request->key,'new_value'=>$request->val]);
    }

    public function getKeys(Request $request)
    {
        $key = $request->key;
        $file = DotenvEditor::getKeys([$key]);
        return response()->json($file);
    }

    public function getValue(Request $request)
    {
        $key = $request->key;
        $file = DotenvEditor::getValue($key);
        return response()->json($file);
    }

    public function update(Request $request)
    {
        $key = $request->key;
        $val = $request->val;
        $file = DotenvEditor::setKey($key, $val)->save();
        return response(['update_key'=>$request->key,'update_value'=>$request->val]);
    }

    public function delete(Request $request)
    {
        $key = $request->key;
        $file = DotenvEditor::deleteKey($key)->save();
        return response(['delete_key'=>$request->key]);
    }

    /***備份相關****/

    //備份
    public function backup(Request $request)
    {
        DotenvEditor::backup();
    }
    //取得全部備份
    public function getBackups(Request $request)
    {
        $backups = DotenvEditor::getBackups();
        return $backups;
    }
    //取得最後一次備份
    public function getLatestBackup(Request $request)
    {
        $latestBackup = DotenvEditor::getLatestBackup();
        return $latestBackup;
    }
    //刪除指定備份
    public function deleteBackup(Request $request)
    {
        $file = DotenvEditor::deleteBackup(storage_path('dotenv-editor/backups/.env.backup_2017_04_10_152709'));
    }
    //刪除全部備份
    public function deleteBackups(Request $request)
    {
        $file = DotenvEditor::deleteBackups();
    }
    //開啟/關閉 自動更新
    public function autoBackup(Request $request)
    {
        $input = $request->input;
        DotenvEditor::autoBackup($input);
    }
    //還原最後一次備份
    public function restore(Request $request)
    {
        DotenvEditor::restore();
    }
}