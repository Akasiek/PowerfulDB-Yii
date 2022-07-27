<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'About';

?>
<div class="w-full max-w-4xl mx-auto p-4 md:p-10 prose prose-invert prose-sm md:prose-base lg:prose-lg ">
    <h1>About Page</h1>
    <p>
        PowerfulDB is a website that aims to provide as much information about music as possible. Website is a
        community-driven database. Every logged-in user can add, create and send edit submission about
        albums, artists and bands. Everyone can see contributions made by specific users on their profile.
        We really appreciate all the contributions.
    </p>
    <h2>F.A.Q.</h2>
    <p>
        Q. <i>Who can add a new album, artist or band?</i><br>
        A. Only logged-in users can add new albums, artists or bands.
    </p>
    <p>
        Q. <i>How do I add a new album, artist or band?</i><br>
        A. First, you need to <?= Html::a('log in', ['site/login']) ?>. Then go to the main page of the database element
        you want to add. For example: if
        you want to add album go <?= Html::a('here', ['album/index']) ?> and click on the "Plus" button next to the
        page title.
    </p>
    <p>
        Q. <i>How can I check my contributions?</i><br>
        A. Everyone can see other users' contributions. Just go to user profile (you can search for user) and all
        contributions will be shown on the
        left side of the screen.
    </p>
    <p>
        Q. <i>Can I add artists that are not consider as Rock or Metal?</i><br>
        A. Yes, you can. When creating PowerfulDB I was thinking only about Rock artists, but I don't think that's a
        good idea. Gatekeeping is stupid. Add anything you want!
    </p>
    <p>
        Q. <i>What is a difference between an artist and a band</i><br>
        A. An artist is a person who is a member of a band or a solo artist. A band is a group of artists. When creating
        band you don't have to add all members as artists.
    </p>
    <p>
        Q. <i>How can I edit album/artist/band</i><br>
        A. There are edit buttons at the bottom of all album/artist/band pages. After changing the data and submitting
        the edit, edit submission is created. Admins, who have the rights to edit the data,can approve or reject
        the submission. After the submission is approved, the data is updated.
    </p>

    <h2>About author</h2>
    <p>
        I'm Kamil and this page was created as a project to learn Yii Framework. I love music, so I try to combine my
        passions and make something great. I hope you'll enjoy this little website.
    </p>
    <p>
        You can find me here:
    </p>
    <ul>
        <li><?= Html::a('GitHub', 'https://github.com/Akasiek', ['target' => '_blank']) ?></li>
        <li><?= Html::a('LinkedIn', 'https://www.linkedin.com/in/kamil-pomykala/', ['target' => '_blank']) ?></li>
        <li><?= Html::a('Twitter', 'https://twitter.com/dziwnykamil', ['target' => '_blank']) ?></li>
        <li><?= Html::a('E-mail', 'mailto:kpomykala2002@gmail.com', ['target' => '_blank']) ?></li>
        <li><?= Html::a('Linktr.ee', 'https://linktr.ee/kamilpomykala', ['target' => '_blank']) ?></li>
    </ul>
</div>


