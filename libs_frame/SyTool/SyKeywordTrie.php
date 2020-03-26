<?php
/**
 * 关键词匹配字典树类
 * User: 姜伟
 * Date: 2017/8/1 0001
 * Time: 12:18
 */
namespace SyTool;

class SyKeywordTrie
{
    /**
     * node structure
     *
     * node = [
     *     'val' => word,
     *     'next' => array(node)/null,
     *     'depth' => int,
     * ]
     * @var array
     */
    private $root = [];
    /**
     * 匹配关键词列表
     * @var array
     */
    private $matched = [];

    public function __construct()
    {
        $this->root = [
            'depth' => 0,
            'next' => [],
        ];
    }

    private function __clone()
    {
    }

    /**
     * @return array
     */
    public function getNodes()
    {
        return $this->root;
    }

    /**
     * 添加关键词
     * @param string $keyword
     */
    public function append(string $keyword)
    {
        $words = preg_split('/(?<!^)(?!$)/u', $keyword);
        array_push($words, '`');
        $this->insert($this->root, $words);
    }

    /**
     * 匹配关键词
     * @param string $str
     * @return array
     */
    public function match(string $str) : array
    {
        $this->matched = [];
        $words = preg_split('/(?<!^)(?!$)/u', $str);
        while (count($words) > 0) {
            $matched = [];
            $res = $this->query($this->root, $words, $matched);
            if ($res) {
                $this->matched[] = implode('', $matched);
            }
            array_shift($words);
        }

        return $this->matched;
    }

    /**
     * 添加字典
     * @param array $node
     * @param array $words
     */
    private function insert(array &$node, array $words)
    {
        if (empty($words)) {
            return;
        }

        $word = array_shift($words);
        if (isset($node['next'][$word])) {
            $this->insert($node['next'][$word], $words);
        } else {
            $tmp_node = [
                'depth' => $node['depth'] + 1,
                'next' => [],
            ];

            $node['next'][$word] = $tmp_node;
            $this->insert($node['next'][$word], $words);
        }
    }

    /**
     * 查询关键词
     * @param array $node
     * @param array $words
     * @param array $matched
     * @return bool
     */
    private function query(array $node, array $words, array &$matched) : bool
    {
        $word = array_shift($words);
        if (isset($node['next'][$word])) {
            array_push($matched, $word);
            if (isset($node['next'][$word]['next']['`'])) {
                return true;
            }

            return $this->query($node['next'][$word], $words, $matched);
        } else {
            $matched = [];
            return false;
        }
    }
}
