<?php

return [
    /**
     * 提交者
     * 可以在本地通过 `git config --global user.name` 命令查看
     */
    'author' => git_get_author(),

    /**
     * 储存周报的文件夹
     */
    'directory' => realpath(__DIR__ . '/../posts'),

    /**
     * 周报目录文件
     */
    'toc_file' => realpath(__DIR__ . '/../posts') . '/README.md',

    /**
     * 周报文件名命名规则，不包含后缀
     * 此配置将被用作 `DateTime::format()` 的参数，请注意转义
     */
    'file_name' => 'Y\WW',

    /**
     * 周报文件扩展名
     */
    'file_extension' => '.md',

    /**
     * 生成周报目录时使用的回调函数，将文件名转换为实际日期
     * 若修改过 `file_name` 配置，则此处可能需要一同修改
     */
    'file_to_datetime' => function ($file) {
        $pi = pathinfo($file);
        try {
            return new DateTime($pi['filename']);
        } catch (Exception $ex) {
            return null;
        }
    },

    /**
     * 项目列表
     */
    'projects' => [
        '周报工具箱' => [                     ## 项目名称，随意起名
            'path' => dirname(__DIR__),     ## [必填] Git 仓库本地目录；请填绝对路径。
            'url' => 'get_remote_url',      ## [可选] Git 仓库在线地址；若不填则周报提交记录将是纯文本，不带超链接；使用 `get_remote_url` 将会根据 remote origin 自动检测，实际上这是个 callable function，你可以在 helpers.php 找到它。
            'pathspec' => '',               ## [可选] 可用于排除 / 包含指定目录，参见 https://kgrz.io/git-intro-to-pathspec.html。
        ],
        // ... 你可以添加更多项目
    ]
];
