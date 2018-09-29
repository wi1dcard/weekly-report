# Write Weekly Reports Coders' Way!

⬆️ That's my idea. [GitHub](https://github.com/wi1dcard/weekly-report) / [Gitee](https://gitee.com/wi1dcard/weekly-report).

🔧 提取 Git 提交记录快速生成 Markdown 格式的日报 / 周报，旨在帮助像我这样健忘的程序员们快速编排工作记录。

⚠️ 这不是个规范的项目，但是个实用的小玩意。

## 效果

![](https://i.loli.net/2018/08/30/5b8785c0471bc.png)

## 简明指南

0. 首先你需要安装本工具，参考 [如何安装](#如何安装)。

1. 写周报从何写起？先来个模板吧。

    ```bash
    php toolkit/new
    ```

    查看 `posts` 目录，本周模板已经生成好了，文件名为 `年份W周数.md`。

    ![](https://i.loli.net/2018/09/29/5baf20a866dc2.png)

    此文件名可以直接被 PHP [`strtotime`](http://php.net/manual/zh/function.strtotime.php) 由字符串转换为时间，你可以修改 `toolkit/config.php` 的配置实现自定义。

2. 接下来打开此配置文件，找到最下方 `projects`，配置你的项目。

    ```php
    // ...
    'projects' => [
        '一个惊世骇俗的项目' => [ // 按需修改
            'path' => realpath('Git 仓库本地目录'), // 按需修改
        ],
    ]
    ```

3. 好了，想想你今天在这个项目提交了啥。今天没有提交？那昨天也行。

    ```bash
    php toolkit/today # 生成今天日报
    php toolkit/today -1 # 生成昨天日报
    php toolkit/today -2 # 生成前天日报
    # ... 以此类推
    ```

    生成的表格已被格式化，如下所示。直接复制粘贴进周报模板即可。

    ![](https://i.loli.net/2018/08/30/5b8785bf604a7.png)

4. 随着时间越来越久，你需要一个规范易读的目录，而不是盯着 `****W**` 脑补这是几月份的来着？

    ```bash
    php toc
    ```

    它会扫描配置项指定的周报文件夹，自动生成目录。

![](https://i.loli.net/2018/08/30/5b8785be4cfe6.png)

5. 如果你还有任何问题 / 想法，欢迎 Issue。

    同样欢迎 PR，感谢。

## 如何安装

1. 需求
    - PHP >= 7.0
    - Composer
    - Git
    - Git Bash（Only Windows）

2. 使用 Git 克隆本项目或下载 Zip Archive。

3. 安装依赖

    ```bash
    cd toolkit
    composer install
    ```

4. 所有代码均位于 `toolkit` 目录下，可阅读 [toolkit/README.md](toolkit/README.md) 查看详细说明。

## 常见问题

### 字体

建议使用中英文等宽字体，谷歌一下在知乎和 V 站都有不少推荐，像 `M+ 1M`、`Courier New 12` 等都是不错的选择。

我目前使用 [Inconsolata](http://levien.com/type/myfonts/inconsolata.html)。

### Markdown 转 PDF

- macOS 用户可使用 [MacDown](https://github.com/MacDownApp/macdown)。
- VS Code 用户可使用 [Markdown PDF](https://github.com/yzane/vscode-markdown-pdf)，此工具目前缺少维护，存在一定问题。

我目前使用后者，VS Code 项目配置参见 [这里](https://wi1dcard.cn/projects/weekly-report-toolkit)。

建议选择能够自定义 CSS 的转换工具，便于调整样式，不然渲染出来的表格可能会很难看。

关于 CSS，你可以直接使用 `css/gitee.css`，和码云网页显示效果一致。实际上就是扒的😂，版权归码云官方。

### 周报内容直接复制到剪贴板

列出 macOS 命令，Windows / Linux 同理。

输出到剪贴板：

```bash
php toolkit/today | pbcopy
```

输出到剪贴板且在终端展示：

```bash
php toolkit/today | tee >(pbcopy)
```

## 开源协议

MIT