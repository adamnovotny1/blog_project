<?php

namespace App\Model;

use Nette;

final class PostFacade
{
    public function __construct(
        private Nette\Database\Explorer $database,
    ) {
    }

    public function findPublishedArticles(int $limit, int $offset): Nette\Database\ResultSet
	{
		return $this->database->query('
			SELECT * FROM posts
			WHERE created_at < ?
			ORDER BY created_at DESC
			LIMIT ?
			OFFSET ?',
			new \DateTime, $limit, $offset,
		);
	}

	/**
	 * Vrací celkový počet publikovaných článků
	 */
	public function getPublishedArticlesCount(): int
	{
		return $this->database->fetchField('SELECT COUNT(*) FROM posts WHERE created_at < ?', new \DateTime);
	}

    public function getPublicArticles()
    {
        return $this->database
            ->table('posts')
            ->where('created_at < ', new \DateTime)
            ->order('created_at DESC');
    }

    public function getPostById(int $postId)
    {
        return $this->database
            ->table('posts')
            ->get($postId);
    }
  
    public function editPost(int $postId, array $data)
    {
        return $this->database
            ->table('posts')
            ->where('id', $postId)
            ->update($data);
    }

    public function insertPost(array $data)
{
    // Set the created_at datetime from the provided data or use the current datetime if not provided
    $createdAt = isset($data['created_at']) ? $data['created_at'] : new \DateTime();
    
    $data['created_at'] = $createdAt;

    $this->database
        ->table('posts')
        ->insert($data);
}

    public function addView(int $postId)
    {
            $post = $this->database
            ->table('posts')
            ->get($postId);
            
        $post->update(['views' => $post->views + 1]);
    }

    public function deletePost(int $id)
    {
        return $this->getPostById($id)->delete();
    }

    public function getComments(int $postId)
    {
        return $this->database
            ->table('comments')
            ->where('post_id', $postId)
            ->order('created_at');
    }
    
    public function addComment(int $postId, $data, int $userId)
    {
            return 
            $this->database
            ->table('comments')
            ->insert([
            'post_id' => $postId,
            'user_id' => $userId,
            'name' => $data->name,
            'email' => $data->email,
            'content' => $data->content,
        ]);
    }
    
    public function deleteComment(int $commentId)
    {
        return $this->database
            ->table('comments')
            ->where('id', $commentId)
            ->delete();
    }

    public function editComment(int $commentId, array $data)
{
    return $this->database
        ->table('comments')
        ->where('id', $commentId)
        ->update($data);
}

public function getCommentById(int $commentId)
{
    return $this->database->table('comments')->get($commentId);
}
}