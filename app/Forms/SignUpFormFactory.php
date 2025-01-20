<?php

declare(strict_types=1);

namespace App\Forms;

use App\Model;
use Nette\Application\UI\Form;


/**
 * Factory for creating user sign-up forms with registration logic.
 */
final class SignUpFormFactory
{
	// Dependency injection of form factory and user management facade
	public function __construct(
		private FormFactory $factory,
		private Model\UserFacade $facade,
	) {
	}


	/**
	 * Create a sign-up form with fields for username, email, and password.
	 * Contains logic to handle successful form submissions.
	 */
	public function create(callable $onSuccess): Form
	{
		$form = $this->factory->create();
		$form->addText('username', 'Uživatelské jméno:')
			->setRequired('Prosím vyberte si uživatelské jméno');

		$form->addEmail('email', 'E-mail:')
			->setRequired('Prosím zadejte e-mail');

		$form->addPassword('password', 'Vytvořte heslo:')
			->setOption('description', sprintf('minimálně %d znaků', $this->facade::PasswordMinLength))
			->setRequired('Prosím vytvořte heslo')
			->addRule($form::MIN_LENGTH, null, $this->facade::PasswordMinLength);

		$form->addSubmit('send', 'Registrovat uživatele');

		// Handle form submission
		$form->onSuccess[] = function (Form $form, \stdClass $data) use ($onSuccess): void {
			try {
				// Attempt to register a new user
				$this->facade->add($data->username, $data->email, $data->password);
			} catch (Model\DuplicateNameException $e) {
				// Handle the case where the username is already taken
				$form['username']->addError('Uživatelské jméno už je zabrané');
				return;
			}
			$onSuccess();
		};

		return $form;
	}
}
