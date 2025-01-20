<?php

declare(strict_types=1);

namespace App\Model;

use Nette;
use Nette\Security\Passwords;
use Nette\Database\Explorer;
use Nette\Security\AuthenticationException;
use Nette\Security\SimpleIdentity;
use Nette\Utils\DateTime;

class UserFacade implements Nette\Security\Authenticator
{
    public const PasswordMinLength = 7;

    private const
        TableName = 'users',
        ColumnId = 'id',
        ColumnName = 'username',
        ColumnPasswordHash = 'password',
        ColumnEmail = 'email',
        ColumnRole = 'role',
        ColumnCreatedAt = 'created_at'; // Nová konstanta pro sloupec 'created_at'

    private Explorer $database;
    private Passwords $passwords;

    public function __construct(Explorer $database, Passwords $passwords) {
        $this->database = $database;
        $this->passwords = $passwords;
    }

    public function authenticate(string $username, string $password): SimpleIdentity
    {
        $row = $this->database->table(self::TableName)
            ->where(self::ColumnName, $username)
            ->fetch();

        if (!$row) {
            throw new AuthenticationException('The username is incorrect.');
        } elseif (!$this->passwords->verify($password, $row[self::ColumnPasswordHash])) {
            throw new AuthenticationException('The password is incorrect.');
        }

        if ($this->passwords->needsRehash($row[self::ColumnPasswordHash])) {
            $row->update([
                self::ColumnPasswordHash => $this->passwords->hash($password),
            ]);
        }

        $arr = $row->toArray();
        $arr['roles'] = [$row[self::ColumnRole]]; // Předpokládáme, že role jsou nyní jednoduchým řetězcem

        unset($arr[self::ColumnPasswordHash]);

        return new SimpleIdentity($row[self::ColumnId], $arr['roles'], $arr);
    }

    public function add(string $username, string $email, string $password, string $role = 'user'): void
    {
        Nette\Utils\Validators::assert($email, 'email');
        $hashedPassword = $this->passwords->hash($password);

        // Přidání pole 'created_at' do pole vkládaných dat s aktuálním datem a časem
        $this->database->table(self::TableName)->insert([
            self::ColumnName => $username,
            self::ColumnEmail => $email,
            self::ColumnPasswordHash => $hashedPassword,
            self::ColumnRole => $role,
            self::ColumnCreatedAt => new DateTime() // Nastaví aktuální datetime
        ]);
    }

    public function getAllUsers(): array {
        return $this->database->table(self::TableName)
                              ->select('id, username, email, role, created_at')
                              ->fetchAll();
    }

    public function changeUserRole($userId, $newRole): void {
        $this->database->table(self::TableName)
                       ->where(self::ColumnId, $userId)
                       ->update([self::ColumnRole => $newRole]);
    }

    public function deleteUser($userId): void {
        $this->database->table(self::TableName)
                       ->where(self::ColumnId, $userId)
                       ->delete();
    }

    public function getUserById(int $userId): ?Nette\Database\Table\ActiveRow {
        return $this->database->table(self::TableName)
                              ->where(self::ColumnId, $userId)
                              ->fetch();
    }
    
    public function changePassword(int $userId, string $newPassword): void {
        $user = $this->getUserById($userId);
    
        if ($user === null) {
            throw new \InvalidArgumentException("User with ID $userId not found.");
        }
    
        $hashedPassword = $this->passwords->hash($newPassword);
    
        $user->update([
            self::ColumnPasswordHash => $hashedPassword,
        ]);
    }
    
}