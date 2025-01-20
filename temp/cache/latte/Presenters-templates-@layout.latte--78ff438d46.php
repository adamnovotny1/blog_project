<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /home/ejdy/blog_project/app/Presenters/templates/@layout.latte */
final class Template_78ff438d46 extends Latte\Runtime\Template
{
	public const Source = '/home/ejdy/blog_project/app/Presenters/templates/@layout.latte';


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>';
		if ($this->hasBlock('title')) /* line 6 */ {
			$this->renderBlock('title', [], function ($s, $type) {
				$ʟ_fi = new LR\FilterInfo($type);
				return LR\Filters::convertTo($ʟ_fi, 'html', $this->filters->filterContent('stripHtml', $ʟ_fi, $s));
			}) /* line 6 */;
			echo ' | ';
		}
		echo 'F1 web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 10px;
        }
        .navig {
            background-color: #333;
            color: white;
            list-style: none;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .navig li {
            display: inline-block;
        }
        .navig li a {
            color: white;
            padding: 14px 20px;
            display: block;
            text-decoration: none;
        }
        .navig li a:hover {
            background-color: #555;
        }
        .flash {
            padding: 10px;
            color: white;
            background-color: #007BFF;
            margin-bottom: 10px;
        }
        .flash.alert {
            background-color: #f44336;
        }
        .flash.success {
            background-color: #4CAF50;
        }
    </style>
</head>
<body>

';
		foreach ($flashes as $flash) /* line 51 */ {
			echo '<div';
			echo ($ʟ_tmp = array_filter(['flash, ' . $flash->type])) ? ' class="' . LR\Filters::escapeHtmlAttr(implode(" ", array_unique($ʟ_tmp))) . '"' : "" /* line 51 */;
			echo '>';
			echo LR\Filters::escapeHtmlText($flash->message) /* line 51 */;
			echo '</div>
';

		}

		echo '
<ul class="navig">
    <li><a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Home:')) /* line 54 */;
		echo '">Články</a></li>
</ul>

';
		$this->renderBlock('content', [], 'html') /* line 57 */;
		echo '
<script src="https://nette.github.io/resources/js/3/netteForms.min.js"></script>
<script src="https://unpkg.com/nette-forms@3.3.6/src/assets/netteForms.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>

</body>
</html>
';
	}


	public function prepare(): array
	{
		extract($this->params);

		if (!$this->getReferringTemplate() || $this->getReferenceType() === 'extends') {
			foreach (array_intersect_key(['flash' => '51'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		return get_defined_vars();
	}
}
