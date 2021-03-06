<?php

/**
 * Quantum PHP Framework
 *
 * An open source software development framework for PHP
 *
 * @package Quantum
 * @author Arman Ag. <arman.ag@softberg.org>
 * @copyright Copyright (c) 2018 Softberg LLC (https://softberg.org)
 * @link http://quantum.softberg.org/
 * @since 1.9.9
 */

namespace Modules\Api\Controllers;

use Quantum\Factory\ServiceFactory;
use Base\Services\PostService;
use Quantum\Http\Response;
use Quantum\Http\Request;

/**
 * Class PostController
 * @package Modules\Api\Controllers
 */
class PostController extends ApiController
{
    /**
     * Post service
     * @var PostService
     */
    public $postService;

    /**
     * Magic __before
     * @param ServiceFactory $serviceFactory
     * @throws \Exception
     */
    public function __before(ServiceFactory $serviceFactory)
    {
        $this->postService = $serviceFactory->get(PostService::class);
    }

    /**
     * Get posts
     * @param Response $response
     */
    public function getPosts(Response $response)
    {
        $posts = $this->postService->getPosts();
        $response->json([
            'status' => 'success',
            'data' => $posts
        ]);
    }

    /**
     * Get post
     * @param string $lang
     * @param int $id
     * @param Response $response
     */
    public function getPost($lang, $id, Response $response)
    {
        if (!$id && $lang) {
            $id = $lang;
        }

        $post = $this->postService->getPost($id);

        if ($post) {
            $response->json([
                'status' => 'success',
                'data' => $post
            ]);
        } else {
            $response->json([
                'status' => 'error',
                'message' => t('common.post_not_found')
            ]);
        }
    }

    /**
     * Amend post
     * @param Request $request
     * @param Response $response
     * @param int|null $id
     * @throws \Exception
     */
    public function amendPost(Request $request, Response $response, $id = null)
    {
        $post = [
            'title' => $request->get('title'),
            'content' => $request->get('content'),
        ];

        if ($id) {
            if($this->postService->updatePost($id, $post)) {
                $response->json([
                    'status' => 'success',
                    'message' => t('common.updated_successfully')
                ]);
            } else {
                $response->json([
                    'status' => 'error',
                    'message' => t('common.post_not_found')
                ]);
            }
        } else {
            $this->postService->addPost($post);
            $response->json([
                'status' => 'success',
                'message' => t('common.created_successfully')
            ]);
        }
    }

    /**
     * Delete post
     * @param Response $response
     * @param int $id
     * @throws \Exception
     */
    public function deletePost(Response $response, $id)
    {
        if($this->postService->deletePost($id)) {
            $response->json([
                'status' => 'success',
                'message' => t('common.deleted_successfully')
            ]);
        } else {
            $response->json([
                'status' => 'error',
                'message' => t('common.post_not_found')
            ]);
        }
    }

}
