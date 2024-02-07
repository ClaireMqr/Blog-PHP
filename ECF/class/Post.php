<?php

include_once 'User.php';

class Post
{

    public int $id;
    public string $title;
    public string $body;
    public string $createdAt;
    


    public function card($post)
    {
        $date = substr($post->createdAt, 0, 10);
        $extrait = substr($post->body, 0, 50).'...';
        return <<<HTML
            <div class="card col-3 p-0 m-3" >
                <img src="img/img{$post->id}.jpg" class="card-img-top img-fluid" alt="...">
                <div class="card-body d-flex flex-column justify-content-between">
                <h5 class="card-title">$post->title</h5>
                <p class="card-text"> $extrait</p>
                <a href="article.php?nom= $post->id" class="btn btn-primary">Voir le post entier</a>
    
                </div>
                <div class="card-footer d-flex flex-row">
                    <p class="text-capitalize me-1"> $post->username  </p>
                    <p>
                        le $date </p>
                </div>
            </div>
        HTML;
    }

    public function dashboard($post) {
        $date = substr($post->createdAt, 0, 10);
        $extrait = substr($post->body, 0, 20).'...';
        $titre = substr($post->title, 0, 30).'...';
        return <<<HTML
            <tr>
                <td>$post->id</td>
                <td>$titre</td>
                <td>$extrait</td>
                <td>$post->username</td>
                <td>$date</td>
                <td><a href="modification.php?nom= $post->id"><svg class="text-muted" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                </svg></a>
                <a href="suppression.php?nom= $post->id"><svg class="text-danger" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                </svg></a>

        HTML;
    }
}
