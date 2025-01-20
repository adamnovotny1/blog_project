<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /home/ejdy/blog_project/app/Presenters/templates/Home/default.latte */
final class Template_ba12ced2a9 extends Latte\Runtime\Template
{
	public const Source = '/home/ejdy/blog_project/app/Presenters/templates/Home/default.latte';

	public const Blocks = [
		['content' => 'blockContent'],
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
		echo '






';
	}


	public function prepare(): array
	{
		extract($this->params);

		if (!$this->getReferringTemplate() || $this->getReferenceType() === 'extends') {
			foreach (array_intersect_key(['post' => '18'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
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
h1 {
    font-family: \'Roboto\', sans-serif; /* Change to your chosen font */
    margin-top: 7px;
}

h2 a {
    font-family: \'Roboto\', sans-serif; /* Change to your chosen font */
    text-decoration: none; 
}
</style>
    <h1>Reportáže Závodů F1</h1>
    <p><a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Edit:create')) /* line 16 */;
		echo '" class="btn btn-primary">Vytvořit příspěvek</a></p>

';
		foreach ($posts as $post) /* line 18 */ {
			echo '    <div class="post">
            <h2><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Post:show', [$post->id])) /* line 19 */;
			echo '">';
			echo LR\Filters::escapeHtmlText($post->title) /* line 19 */;
			echo '</a></h2>
            <div class="date"><b>Datum Vytvoření: </b>';
			echo LR\Filters::escapeHtmlText(($this->filters->date)($post->created_at, 'F j, Y')) /* line 20 */;
			echo '</div>
            <br>
';
			if ($post->image) /* line 22 */ {
				echo '                <img src="';
				echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 23 */;
				echo '/';
				echo LR\Filters::escapeHtmlAttr($post->image) /* line 23 */;
				echo '" alt="Obrázek k článku ';
				echo LR\Filters::escapeHtmlAttr($post->title) /* line 23 */;
				echo '" style="width: 400px; height: auto">
                <br><br>
';
			}
			echo '    </div>
';

		}

		echo '    <nav aria-label="Page navigation example">
        <ul class="pagination">
';
		if (!$paginator->isFirst()) /* line 29 */ {
			echo '                <li class="page-item"><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('default', [1])) /* line 30 */;
			echo '" class="page-link">První</a></li>
                <li class="page-item"><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('default', [$paginator->page - 1])) /* line 31 */;
			echo '" class="page-link">Předchozí</a></li>
';
		}
		echo '
            <li class="page-item disabled"><a class="page-link" href="#">Stránka ';
		echo LR\Filters::escapeHtmlText($paginator->getPage()) /* line 34 */;
		echo ' z ';
		echo LR\Filters::escapeHtmlText($paginator->getPageCount()) /* line 34 */;
		echo '</a></li>

';
		if (!$paginator->isLast()) /* line 36 */ {
			echo '                <li class="page-item"><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('default', [$paginator->getPage() + 1])) /* line 37 */;
			echo '" class="page-link">Další</a></li>
                <li class="page-item"><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('default', [$paginator->getPageCount()])) /* line 38 */;
			echo '" class="page-link">Poslední</a></li>
';
		}
		echo '        </ul>
    </nav>
';
	}
}
