<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function getAll($search = null)
    {
        $query = Post::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        return $query->get();
    }


    public function find($id)
    {
        return $this->post->find($id);
    }

    public function create(array $data)
    {
        return $this->post->create($data);
    }

    public function update($id, array $data)
    {
        $post = $this->find($id);
        if ($post) {
            $post->update($data);
            return $post;
        }
        return null;
    }

    public function delete($id)
    {
        $post = $this->find($id);
        if ($post) {
            return $post->delete();
        }
        return false;
    }
}