<?php

include_once 'Post.php';

class Comment extends Post {

    public int $id;
    public string $name;
    public string $email;
    public string $body;
    public string $createdAt;
    public Post $postId;

    public function post($post, $numPost) {
        $numPost = intval($numPost);
        return <<<HTML
            <div class="m-5 text-center">
                <h1 class=""> $post->title </h1>
                <p>Ecrit par $post->username le $post->createdAt </p>
            </div>
            <div class="d-flex row mb-5">
                <img src="img/img{$numPost}.jpg" alt="" class="col-2">
                <p class="fs-4 col-7 justify-text-center my-auto"> $post->body
                </p>
            </div>
        HTML;
    }

    public function comment($commentaire) {
        $date = substr($commentaire->createdAt, 0, 10);
        return <<<HTML
            <div class="card m-4">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-muted"> $commentaire->email le $date</li>
                    <li class="list-group-item fw-bold text-capitalize"> $commentaire->name </li>
                    <li class="list-group-item"> $commentaire->body </li>
                </ul>
            </div>
        HTML;
    }
}

?>