<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $posts = $this->postRepository->getAll($search);

        return view('posts.index', compact('posts', 'search'));
    }



    // Hiển thị form tạo post mới
    public function create()
    {
        return view('posts.create');
    }

    // Xử lý lưu post mới vào database
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'name' => 'required|string|max:255',
        ]);

        $this->postRepository->create($data);
        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }

    // Hiển thị chi tiết bài post
    public function show($id)
    {
        $post = $this->postRepository->find($id);
        return view('posts.show', compact('post'));
    }

    // Hiển thị form sửa post
    public function edit($id)
    {
        $post = $this->postRepository->find($id);
        return view('posts.edit', compact('post'));
    }

    // Xử lý cập nhật post
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'sometimes|string|max:255',
            'body' => 'sometimes',
        ]);

        $this->postRepository->update($id, $data);
        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    // Xóa post
    public function destroy($id)
    {
        $this->postRepository->delete($id);
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}