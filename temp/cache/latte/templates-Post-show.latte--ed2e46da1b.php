<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /home/ejdy/blog_project/app/Presenters/templates/Post/show.latte */
final class Template_ed2e46da1b extends Latte\Runtime\Template
{
	public const Source = '/home/ejdy/blog_project/app/Presenters/templates/Post/show.latte';

	public const Blocks = [
		['content' => 'blockContent', 'title' => 'blockTitle'],
	];


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		echo "\n";
		$this->renderBlock('content', get_defined_vars()) /* line 3 */;
	}


	public function prepare(): array
	{
		extract($this->params);

		$this->parentName = '../@layout.latte';
		return get_defined_vars();
	}


	/** {block content} on line 3 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '<style>
    /* General body styling */
    body {
        font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f4f4; /* Light grey background for the page */
        color: #333; /* Dark grey text color */
        margin: 0;
        padding: 10px;
    }

    /* Styling for the post header */
    h1 {
        color: #0275d8; /* Blue color for headers */
        font-size: 32px; /* Font size for headers */
        font-family: \'Roboto\', sans-serif; /* Change to your chosen font */
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .post, .comments {
        background-color: #fff; /* White background for sections */
        border: 1px solid #ddd; /* Light gray border */
        padding: 20px; /* Increased padding inside sections for more space */
        margin-top: 10px; /* Space between sections */
        line-height: 1.6; /* Improved line spacing for better readability */
    }

    .post {
        margin-bottom: 14px;
    }

    .comments {
        margin-top:20px;
    }

    .comments a {
        margin-bottom: 10px;
    }

    img {
        margin-bottom: 10px;
    }

    p b a {
        text-decoration: none;
    }

    p a {
        margin-top: 7px;
    }



</style>

<p><a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Home:default')) /* line 59 */;
		echo '" class="btn btn-outline-primary">← zpět na výpis příspěvků</a></p>


';
		$this->renderBlock('title', get_defined_vars()) /* line 62 */;
		echo "\n";
		if ($post->image) /* line 64 */ {
			echo '    <img src="';
			echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 65 */;
			echo '/';
			echo LR\Filters::escapeHtmlAttr($post->image) /* line 65 */;
			echo '" alt="Obrázek k článku ';
			echo LR\Filters::escapeHtmlAttr($post->title) /* line 65 */;
			echo '" style="height: 400px; width: auto;">
    <br>
';
		}
		echo '<br>
<br>
<div class="post">';
		echo LR\Filters::escapeHtmlText($post->content) /* line 70 */;
		echo '</div>





';
	}


	/** n:block="title" on line 62 */
	public function blockTitle(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '<h1>';
		echo LR\Filters::escapeHtmlText($post->title) /* line 62 */;
		echo '</h1>
';
	}
}
