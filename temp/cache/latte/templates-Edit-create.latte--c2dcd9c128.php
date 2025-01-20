<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /home/ejdy/blog_project/app/Presenters/templates/Edit/create.latte */
final class Template_c2dcd9c128 extends Latte\Runtime\Template
{
	public const Source = '/home/ejdy/blog_project/app/Presenters/templates/Edit/create.latte';

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

		$this->renderBlock('content', get_defined_vars()) /* line 1 */;
	}


	/** {block content} on line 1 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '<style>
    .form-container {
        max-width: 700px;
        margin: 40px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.1);
    }

    a.back-link {
        display: block;
        margin-bottom: 20px;
        color: #0275d8;
        text-decoration: none;
        font-size: 16px;
    }

    a.back-link:hover {
        text-decoration: underline;
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }
    
    form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    label {
        font-weight: bold;
        color: #444;
        margin-bottom: 5px;
    }
    
    input[type="text"],
    input[type="email"],
    input[type="password"],
    textarea,
    select {
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 100%;
        box-sizing: border-box;
    }

    textarea {
        height: 150px; /* Provides a larger text area for content */
        resize: vertical; /* Allows the user to resize the textarea vertically */
    }

    input[type="submit"] {
        background-color: #007bff;
        color: white;
        padding: 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    .error-message {
        color: #ff0000;
        font-size: 14px;
        margin-top: 2px;
    }
</style>

<div class="form-container">
    <p><a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Home:default')) /* line 82 */;
		echo '" class="back-link">← zpět na výpis příspěvků</a></p>
    <h1>Nový příspěvek</h1>
';
		$ʟ_tmp = $this->global->uiControl->getComponent('postForm');
		if ($ʟ_tmp instanceof Nette\Application\UI\Renderable) $ʟ_tmp->redrawControl(null, false);
		$ʟ_tmp->render() /* line 84 */;

		echo '</div>
';
	}
}
