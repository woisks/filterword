<?php
declare(strict_types=1);


namespace Woisks\FilterWord;


/**
 * Class Build
 *
 * @package Woisks\FilterWord
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/3 20:47
 */
class Build
{
    public function buildTree(array $words): array
    {
        $wordsTree = [];
        foreach ($words as $word) {
            $wordChars = Helper::stringToArray($word);
            $currentWordsTree = $this->buildSingleTree($wordChars);

            //多维数组合并
            //不能使用array_merge_recursive函数，因为合并后会出现bug
            //数组A为[3=>"test"],数组B为[7=>"test2"]，合并后会成为[3=>"test",4=>"test2"]
            $wordsTree = $this->combineWordTree($wordsTree, $currentWordsTree);
        }

        return $wordsTree;
    }

    /**
     * 递归的合并数组
     *
     * array_merge_recursive改版
     *
     * @param array $wordsTree
     * @param       $currentWordsTree
     * @return mixed
     */
    private function combineWordTree(array $wordsTree, $currentWordsTree): array
    {
        if (is_array($currentWordsTree)) {
            //获取key
            foreach ($currentWordsTree as $key => $currentWords) {
                $wordKey = $key;
                break;
            }

            if (isset($wordsTree[$wordKey]) && is_array($wordsTree[$wordKey])) {
                $wordsTree[$wordKey] = $this->combineWordTree($wordsTree[$wordKey], $currentWordsTree[$wordKey]);

                return $wordsTree;
            } else {
                //不存在就直接赋值整个结果
                $wordsTree[$wordKey] = $currentWordsTree[$wordKey];

                return $wordsTree;
            }
        } else {
            return $wordsTree;
        }
    }


    /**
     * 建立单个前缀树
     *
     * @param array $wordChars
     * @return array
     */
    private function buildSingleTree(array $wordChars): array
    {
        //将数组反转，反向处理
        $newWordChars = array_reverse($wordChars);
        $wordsSingleTree = ['end' => 1];

        foreach ($newWordChars as $wordChar) {
            $current = [];
            $current[$wordChar] = $wordsSingleTree;
            $wordsSingleTree = $current;
        }

        return $wordsSingleTree;
    }
}