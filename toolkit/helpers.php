<?php

/**
 * 转换 Git log 的 File changes 为中文
 *
 * @param string $stat
 * @return string
 */
function translate_file_changes($stat)
{
    $map = [
        'files' => '个文件',
        'file' => '个文件',
        ' changed' => '被改变',
        'insertions' => '行代码新增',
        'insertion' => '行代码新增',
        'deletions' => '行代码删除',
        'deletion' => '行代码删除',
        '(+)' => '',
        '(-)' => '',
    ];
    $stat = trim($stat);
    $stat = str_ireplace(array_keys($map), array_values($map), $stat);

    return $stat;
}

/**
 * 格式化一行表格
 *
 * @param array $cols
 * @param array $widths
 * @param string $tab
 * @param string $separator
 * @return string
 */
function table_format_row($cols, $widths, $tab = '  ', $separator = ' | ')
{
    $rowContent = $tab . ltrim($separator);
    foreach ($cols as $index => $col) {
        $rowContent .= ($index == 0) ? '' : $separator;
        $spaces = $widths[$index] - mb_strwidth($col);
        $rowContent .= str_repeat(' ', $spaces) . $col;
    }
    $rowContent .= rtrim($separator);
    return $rowContent;
}

/**
 * 使用 Git 获取全局提交者名字
 *
 * @return string
 */
function git_get_author()
{
    return trim(
        (new GitWrapper\GitWrapper())->git('config --global user.name')
    );
}

/**
 * 使用正则匹配计算总代码行数
 *
 * @param string $file
 * @return int
 */
function stat_code_lines($file)
{
    $content = file_get_contents($file);
    preg_match_all('/(\d+)\s*行代码新增/', $content, $matches);
    $sum = array_sum($matches[1]);
    return $sum;
}

/**
 * 通过 remote origin url 获取仓库的远程地址
 *
 * @param string $path
 * @return string|null
 */
function get_remote_url($path)
{
    $url = trim(
        (new GitWrapper\GitWrapper())->git('ls-remote --get-url origin', $path)
    );
    $url = preg_replace('/^git@(.*?):(.*?).git$/i', 'http://$1/$2', $url);
    if (starts_with($url, ['http', 'https'])) {
        return $url;
    }
    return null;
}

/**
 * 判断某字符串是否为某子字符串开头
 *
 * @param string $haystack
 * @param string|array $needles
 * @return bool
 */
function starts_with($haystack, $needles)
{
    foreach ((array) $needles as $needle) {
        if ($needle !== '' && substr($haystack, 0, strlen($needle)) === (string) $needle) {
            return true;
        }
    }
    return false;
}
