<?php
namespace App\Presenters;

use App\Model\PostFacade;
use Nette;

final class HomePresenter extends Nette\Application\UI\Presenter
{
	public function __construct(
		private PostFacade $postFacade,
	) {
	}

	public function renderDefault(int $page = 1): void
	{
		// Zjistíme si celkový počet publikovaných článků
		$articlesCount = $this->postFacade->getPublishedArticlesCount();

		// Vyrobíme si instanci Paginatoru a nastavíme jej
		$paginator = new Nette\Utils\Paginator;
		$paginator->setItemCount($articlesCount); // celkový počet článků
		$paginator->setItemsPerPage(10); // počet položek na stránce
		$paginator->setPage($page); // číslo aktuální stránky

		// Z databáze si vytáhneme omezenou množinu článků podle výpočtu Paginatoru
		$posts = $this->postFacade->findPublishedArticles($paginator->getLength(), $paginator->getOffset());

		// kterou předáme do šablony
		$this->template->posts = $posts;
		// a také samotný Paginator pro zobrazení možností stránkování
		$this->template->paginator = $paginator;
	}
    
}